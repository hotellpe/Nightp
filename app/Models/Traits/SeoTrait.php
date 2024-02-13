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

namespace App\Models\Traits;
use App\Models\City;

trait SeoTrait
{
	// ===| ADMIN PANEL METHODS |===
	
	public function getPageHtml()
	{
		$entries = self::getDefaultCity();
		
		// Get Page Name
		$out = $this->page;
		if (isset($entries[$this->page])) {
			$url = admin_url('seo/' . $this->id . '/edit');
			$out = '<a href="' . $url . '">' . $entries[$this->page] . '</a>';
		}
		
		return $out;
	}
	
	public function getCityName()
	{
		$entries = self::getDefaultCity();
		
		// Get Page Name
		$out = $this->city_id;
		if (isset($entries[$this->city_id])) {
			$url = admin_url('seo/' . $this->id . '/edit');
			$out = $entries[$this->city_id];
		}
		
		return $out;
	}
	
	// ===| OTHER METHODS |===
	
	public static function getDefaultCity(): array
	{
		$cities = City::where('active',1)->orderBy('name', 'ASC')->get();
		
		$returnCity = [];
		if($cities){
		    foreach($cities as $city){
		       $returnCity[$city->id] = $city->name; 
		    }
		}
		return $returnCity;
	}
}
