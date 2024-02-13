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

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Front\ResetPasswordRequest;
use App\Http\Controllers\Api\Auth\Helpers\ResetsPasswordsForEmail;
use App\Http\Controllers\Api\Auth\Helpers\ResetsPasswordsForPhone;
use App\Http\Resources\UserResource;

/**
 * @group Authentication
 */
class ResetPasswordController extends BaseController
{
	use ResetsPasswordsForEmail, ResetsPasswordsForPhone;
	
	/**
	 * Reset password
	 *
	 * @bodyParam auth_field string required The user's auth field ('email' or 'phone'). Example: email
	 * @bodyParam email string The user's email address or username (Required when 'auth_field' value is 'email'). Example: john.doe@domain.tld
	 * @bodyParam phone string The user's mobile phone number (Required when 'auth_field' value is 'phone'). Example: null
	 * @bodyParam phone_country string required The user's phone number's country code (Required when the 'phone' field is filled). Example: null
	 * @bodyParam password string required The user's password. Example: js!X07$z61hLA
	 * @bodyParam password_confirmation string required The confirmation of the user's password. Example: js!X07$z61hLA
	 * @bodyParam captcha_key string Key generated by the CAPTCHA endpoint calling (Required when the CAPTCHA verification is enabled from the Admin panel).
	 *
	 * @param \App\Http\Requests\Front\ResetPasswordRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function reset(ResetPasswordRequest $request): \Illuminate\Http\JsonResponse
	{
		// Get the right auth field
		$authField = getAuthField();
		
		// Go to the custom process (Phone)
		if ($authField == 'phone') {
			return $this->resetForPhone($request);
		}
		
		// Go to the core process (Email)
		return $this->resetForEmail($request);
	}
	
	/**
	 * Create an API token for the User
	 *
	 * @param $user
	 * @param null $deviceName
	 * @param null $message
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function createUserApiToken($user, $deviceName = null, $message = null): \Illuminate\Http\JsonResponse
	{
		// Revoke previous tokens
		$user->tokens()->delete();
		
		// Create the API access token
		$deviceName = $deviceName ?? 'Desktop Web';
		$token = $user->createToken($deviceName);
		
		$data = [
			'success' => true,
			'message' => $message,
			'result'  => new UserResource($user),
			'extra'   => [
				'authToken' => $token->plainTextToken,
				'tokenType' => 'Bearer',
			],
		];
		
		return $this->apiResponse($data);
	}
}
