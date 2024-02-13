<?php
/*
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 * Author: BeDigit | https://bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - https://codecanyon.net/licenses/standard
 */

use App\Helpers\Arr;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Prologue\Alerts\Facades\Alert;

/**
 * Check if the current request is from the API
 *
 * @return bool
 */
function isFromApi(): bool
{
	$isFromApi = false;
	
	if (
		request()->segment(1) == 'api'
		|| (request()->hasHeader('X-API-CALLED') && request()->header('X-API-CALLED'))
	) {
		$isFromApi = true;
	}
	
	return $isFromApi;
}

/**
 * Does the (current) request is from a Web Application?
 * Check if the current request is made from the official(s) web version(s) of the app
 *
 * Info: This function allows applying web features during API code execution
 * Note: This assumes the "X-AppType=web" header is sent from the web application
 *
 * @return bool
 */
function doesRequestIsFromWebApp(): bool
{
	return (request()->hasHeader('X-AppType') && request()->header('X-AppType') == 'web');
}

/**
 * Make an API HTTP request
 *
 * @param string $method
 * @param string $uri
 * @param array $data
 * @param array $headers
 * @param bool $asMultipart
 * @param bool $forInternalEndpoint
 * @return array
 */
function makeApiRequest(
	string $method,
	string $uri,
	array  $data = [],
	array  $headers = [],
	bool   $asMultipart = false,
	bool   $forInternalEndpoint = true
): array
{
	try {
		/*
		 * Check if the endpoint is an external one
		 * i.e.The endpoint is a valid URL starting with 'http', except the website's URL
		 */
		$isRemoteEndpoint = (str_starts_with($uri, 'http') && !str_starts_with($uri, url('/')));
		
		if (!$isRemoteEndpoint) {
			$nonCacheableRequestMethods = ['POST', 'PUT', 'DELETE', 'PATCH', 'CREATE', 'UPDATE'];
			
			// Apply persistent (required) inputs for API calls
			$defaultData = [
				'countryCode'  => config('country.code'),
				'languageCode' => config('app.locale'),
			];
			if (in_array(request()->method(), $nonCacheableRequestMethods)) {
				$defaultData['country_code'] = (!empty($data['country_code']))
					? $data['country_code']
					: config('country.code');
				$defaultData['language_code'] = (!empty($data['language_code']))
					? $data['language_code']
					: config('app.locale');
			}
			$data = array_merge($defaultData, $data);
			
			// HTTP Client default headers for API calls
			$defaultHeaders = [
				'Content-Language'  => $defaultData['languageCode'] ?? null,
				'Accept'            => 'application/json',
				'X-AppType'         => 'web',
				'X-CSRF-TOKEN'      => csrf_token(),
				'X-WEB-REQUEST-URL' => request()->url(),
			];
			$appApiToken = config('larapen.core.api.token');
			if (!empty($appApiToken)) {
				$defaultHeaders['X-AppApiToken'] = $appApiToken;
			}
			if (session()->has('authToken')) {
				$defaultHeaders['Authorization'] = 'Bearer ' . session('authToken');
			}
			
			// Prevent HTTP request caching for methods that can update the database
			if (in_array(strtoupper($method), $nonCacheableRequestMethods)) {
				$noCacheHeaders = config('larapen.core.noCacheHeaders');
				if (!empty($noCacheHeaders)) {
					foreach ($noCacheHeaders as $key => $value) {
						$defaultHeaders[$key] = $value;
					}
				}
			}
			$headers = array_merge($defaultHeaders, $headers);
		}
		
		$array = curlHttpRequest($method, $uri, $data, $headers, $asMultipart, $forInternalEndpoint);
	} catch (\Throwable $e) {
		$message = $e->getMessage();
		if (empty($message)) {
			$message = 'Error encountered during API request.';
		}
		$array = [
			'success'      => false,
			'message'      => $message,
			'result'       => null,
			'isSuccessful' => false,
			'status'       => 500,
		];
	}
	
	/*
	 * Check the API auth error to log out user in the browser
	 * ---
	 * 401 Unauthorized can be used when the user login credential is wrong; or auth token passed in header is invalid.
	 * 403 Forbidden can be used when the user does not have specific permission for requested resource.
	 */
	if (data_get($array, 'status') == 401) {
		$array['message'] = logoutOnClient();
	}
	
	return $array;
}

/**
 * Make an API HTTP request remotely (using CURL)
 *
 * @param string $method
 * @param string $uri
 * @param array $data
 * @param array $headers
 * @param bool $asMultipart
 * @param bool $forInternalEndpoint
 * @return array
 */
function curlHttpRequest(
	string $method,
	string $uri,
	array  $data = [],
	array  $headers = [],
	bool   $asMultipart = false,
	bool   $forInternalEndpoint = true
): array
{
	// Guzzle Options
	$options = ['debug' => false];
	
	$baseUrl = url('api');
	$endpoint = $forInternalEndpoint ? ($baseUrl . $uri) : $uri;
	
	try {
		
		$client = Http::withOptions($options)->withoutVerifying();
		
		if (!empty($headers)) {
			$client->withHeaders($headers);
		}
		if ($asMultipart) {
			$client->asMultipart();
			$data = multipartFormData($data);
			$method = 'post';
		}
		
		/*
		 * Make the request and wait for 60 seconds for response.
		 * If it does not receive one, wait 2000 milliseconds (2 seconds), and then try again.
		 * Keep trying up to 3 times, and finally give up and throw an exception.
		 */
		$timeout = config('larapen.core.api.timeout', 60);
		$times = config('larapen.core.api.retry.times', 3);
		$sleep = config('larapen.core.api.retry.sleep', 2000);
		$when = fn (Exception $e, PendingRequest $request) => shouldHttpRequestBeRetried($e, $request, $method);
		/*
		 * If all of the requests fail, an instance of Illuminate\Http\Client\RequestException will be thrown.
		 * If you would like to disable this behavior, you may provide a throw argument with a value of false.
		 * When disabled, the last response received by the client will be returned after all retries have been attempted
		 * More info: https://laravel.com/docs/master/http-client#retries
		 */
		$client->timeout($timeout)->retry($times, $sleep, $when, throw: false);
		
		if (strtolower($method) == 'get') {
			$response = $client->get($endpoint, $data);
		} else if (strtolower($method) == 'post') {
			$response = $client->post($endpoint, $data);
		} else if (strtolower($method) == 'put') {
			$response = $client->put($endpoint, $data);
		} else if (strtolower($method) == 'delete') {
			$response = $client->delete($endpoint, $data);
		} else {
			// Request Options (Not to be confused with the Guzzle options)
			$options = [];
			if (!empty($data)) {
				$options = ['multipart' => $data];
			}
			$response = $client->send($method, $endpoint, $options);
		}
		
		// Get the array formatted response
		// Note: Don't pass a key in argument to always expect an array
		$array = $response->json();
		
		// Throw an exception if the returned type is not an array
		if (!is_array($array)) {
			$message = 'The API response for "' . $endpoint . '" request failed. ';
			$message .= 'An array response is expected, ' . gettype($array) . ' is returned.';
			throw new Exception($message);
		}
		
		$array['isSuccessful'] = $response->successful();
		$array['status'] = $response->status();
		
	} catch (\Throwable $e) {
		$array = [
			'success'      => false,
			'message'      => $e->getMessage(),
			'result'       => null,
			'isSuccessful' => false,
			'status'       => 500,
		];
	}
	
	return $array;
}

/**
 * Convert POST request to Guzzle multipart array format
 *
 * @param $inputs
 * @return array
 */
function multipartFormData($inputs): array
{
	$formData = [];
	
	$inputs = Arr::flattenPost($inputs);
	if (empty($inputs)) {
		return $formData;
	}
	
	foreach ($inputs as $key => $value) {
		if ($value instanceof UploadedFile) {
			$formData[] = [
				'name'     => $key,
				'contents' => fopen($value->getPathname(), 'r'),
				'filename' => $value->getClientOriginalName(),
			];
		} else {
			$formData[] = [
				'name'     => $key,
				'contents' => $value,
			];
		}
	}
	
	return $formData;
}

/**
 * @return string|null
 */
function getApiAuthToken(): ?string
{
	$token = null;
	
	if (request()->hasHeader('Authorization')) {
		$authorization = request()->header('Authorization');
		if (str_contains($authorization, 'Bearer')) {
			$token = str_replace('Bearer ', '', $authorization);
		}
	}
	
	return is_string($token) ? $token : null;
}

/**
 * @param $paginatedCollection
 * @return mixed
 */
function setPaginationBaseUrl($paginatedCollection)
{
	// If the request is made from the app's Web environment,
	// use the Web URL as the pagination's base URL
	if (doesRequestIsFromWebApp()) {
		if (request()->hasHeader('X-WEB-REQUEST-URL')) {
			if (method_exists($paginatedCollection, 'setPath')) {
				$paginatedCollection->setPath(request()->header('X-WEB-REQUEST-URL'));
			}
		}
	}
	
	return $paginatedCollection;
}

/**
 * Log out the user on a web client (Browser)
 *
 * @param string|null $message
 * @return string|null
 */
function logoutOnClient(?string $message = null): ?string
{
	// Get the current Country
	if (session()->has('countryCode')) {
		$countryCode = session('countryCode');
	}
	if (session()->has('allowMeFromReferrer')) {
		$allowMeFromReferrer = session('allowMeFromReferrer');
	}
	
	// Remove all session vars
	auth()->logout();
	request()->session()->flush();
	request()->session()->regenerate();
	
	// Retrieve the current Country
	if (!empty($countryCode)) {
		session()->put('countryCode', $countryCode);
	}
	if (!empty($allowMeFromReferrer)) {
		session()->put('allowMeFromReferrer', $allowMeFromReferrer);
	}
	
	// Unintentional disconnection
	if (empty($message)) {
		$message = t('unintentional_logout');
		if (isAdminPanel()) {
			Alert::error($message)->flash();
		} else {
			flash($message)->error();
		}
		
		return $message;
	}
	
	// Intentional disconnection
	if (isAdminPanel()) {
		Alert::success($message)->flash();
	} else {
		flash($message)->success();
	}
	
	return $message;
}

/**
 * @return bool
 */
function isPostCreationRequest(): bool
{
	if (isFromApi()) {
		$isPostCreationRequest = (str_contains(currentRouteAction(), 'Api\PostController@store'));
	} else {
		$isMultiStepFormEnabled = (config('settings.single.publication_form_type') == '1');
		$isSingleStepFormEnabled = (config('settings.single.publication_form_type') == '2');
		
		$isNewEntryUri = (
			($isMultiStepFormEnabled && request()->segment(2) == 'create')
			|| ($isSingleStepFormEnabled && request()->segment(1) == 'create')
		);
		
		$isPostCreationRequest = (
			$isNewEntryUri
			|| str_contains(currentRouteAction(), 'Post\CreateOrEdit\MultiSteps\CreateController')
			|| str_contains(currentRouteAction(), 'Post\CreateOrEdit\SingleStep\CreateController')
		);
	}
	
	return $isPostCreationRequest;
}
