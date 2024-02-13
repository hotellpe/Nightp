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

namespace App\Http\Controllers\Web\Public\Search;

use Larapen\LaravelMetaTags\Facades\MetaTag;

use App\Models\Seo;

class CityController extends BaseController
{
	/**
	 * City URL
	 * Pattern: (countryCode/)free-ads/city-slug/ID
	 *
	 * @param $countryCode
	 * @param $citySlug
	 * @param $cityId
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index($countryCode, $citySlug, $cityId = null)
	{
		// Check if the multi-country site option is enabled
		if (!config('settings.seo.multi_country_urls')) {
			$cityId = $citySlug;
		}
		
		// Call API endpoint
		$endpoint = '/posts';
		$queryParams = [
			'op' => 'search',
			'l'  => $cityId,
		];
		$queryParams = array_merge(request()->all(), $queryParams);
		$headers = [
			'X-WEB-CONTROLLER' => class_basename(get_class($this)),
		];
		$data = makeApiRequest('get', $endpoint, $queryParams, $headers);
		
		//echo '<pre>'; print_r($data); die;
		
		$apiMessage = $this->handleHttpError($data);
		$apiResult = data_get($data, 'result');
		$apiExtra = data_get($data, 'extra');
		$preSearch = data_get($apiExtra, 'preSearch');
		
		// Sidebar
		$this->bindSidebarVariables((array)data_get($apiExtra, 'sidebar'));
		
		// Get Titles
		$this->getBreadcrumb($preSearch);
		$this->getHtmlTitle($preSearch);
		
		// Meta Tags
		[$title, $description, $keywords] = $this->getMetaTag($preSearch);
		
		$contentExtra = null;
		
		if($cityId){
		    
		    $getSeoCity = Seo::where('city_id',$cityId)->where('active',1)->first();
		    if(isset($getSeoCity->meta_title) && $getSeoCity->meta_title){
		        $title = $getSeoCity->meta_title;
		    }
		    if(isset($getSeoCity->meta_keywords) && $getSeoCity->meta_keywords){
		        $keywords = $getSeoCity->meta_keywords;
		    }
		    if(isset($getSeoCity->meta_des) && $getSeoCity->meta_des){
		        $description = $getSeoCity->meta_des;
		    }
		    if(isset($getSeoCity->content) && $getSeoCity->content){
		        $contentExtra = $getSeoCity->content;
		    }
		    
		}
		
		
		MetaTag::set('title', $title);
		MetaTag::set('description', $description);
		MetaTag::set('keywords', $keywords);
		
		// Open Graph
		$this->og->title($title)->description($description)->type('website');
		view()->share('og', $this->og);
		
		// SEO: noindex
		$noIndexCitiesPermalinkPages = (
			config('settings.seo.no_index_cities')
			&& str_contains(currentRouteAction(), 'Search\CityController')
		);
		// Filters (and Orders) on Listings Pages (Except Pagination)
		$noIndexFiltersOnEntriesPages = (
			config('settings.seo.no_index_filters_orders')
			&& str_contains(currentRouteAction(), 'Search\\')
			&& !empty(request()->except(['page']))
		);
		// "No result" Pages (Empty Searches Results Pages)
		$noIndexNoResultPages = (
			config('settings.seo.no_index_no_result')
			&& str_contains(currentRouteAction(), 'Search\\')
			&& empty(data_get($apiResult, 'data'))
		);
		
		return appView(
			'search.results',
			compact(
				'apiMessage',
				'apiResult',
				'apiExtra',
				'noIndexCitiesPermalinkPages',
				'noIndexFiltersOnEntriesPages',
				'noIndexNoResultPages',
				'contentExtra',
				'keywords',
			)
		);
	}
	

}
