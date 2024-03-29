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

namespace App\Http\Controllers\Api\Base;

use App\Helpers\Localization\Country as CountryHelper;
use App\Helpers\Localization\Language as LanguageHelper;
use App\Models\Currency;
use Illuminate\Support\Collection;

trait LocalizationTrait
{
	/**
	 * Get Localization
	 * Get Locale from User's Account or from Country spoken Language
	 * and get Country by user IP
	 */
	private function loadLocalizationData(): void
	{
		// Language
		$langObj = new LanguageHelper();
		$lang = $langObj->find();
		
		// Country
		$countryObj = new CountryHelper();
		$countryObj->find();
		
		// Get selected country & the user's IP country
		$country   = $countryObj->country;
		$ipCountry = $countryObj->ipCountry;
		
		// Config: Country
		if (!$country->isEmpty() && $country->has('code')) {
			config()->set('country.locale', config('app.locale'));
			config()->set('country.lang', []);
			
			if ($country->has('lang')) {
				$countryLang = $country->get('lang');
				if ($countryLang instanceof Collection) {
					if ($countryLang->has('abbr')) {
						config()->set('country.locale', $countryLang->get('abbr'));
					}
					config()->set('country.lang', $countryLang->toArray());
				}
			}
			
			config()->set('country.code', $country->get('code'));
			config()->set('country.icode', $country->get('icode'));
			config()->set('country.iso3', $country->get('iso3'));
			config()->set('country.name', $country->get('name'));
			config()->set('country.currency', $country->get('currency_code'));
			config()->set('country.phone', $country->get('phone'));
			config()->set('country.time_zone', ($country->has('time_zone')) ? $country->get('time_zone') : config('app.timezone'));
			config()->set('country.date_format', ($country->has('date_format')) ? $country->get('date_format') : null);
			config()->set('country.datetime_format', ($country->has('datetime_format')) ? $country->get('datetime_format') : null);
			config()->set('country.admin_type', $country->get('admin_type'));
			config()->set('country.background_image_url', $country->get('background_image_url'));
		}
		// Config: IP Country
		if (!$ipCountry->isEmpty() && $ipCountry->has('code')) {
			config()->set('ipCountry.code', $ipCountry->get('code'));
			config()->set('ipCountry.name', $ipCountry->get('name'));
			config()->set('ipCountry.time_zone', ($ipCountry->has('time_zone')) ? $ipCountry->get('time_zone') : null);
		}
		// Config: Currency
		if (!$country->isEmpty() && $country->has('currency')) {
			$currency = $country->get('currency');
			if ($currency instanceof Currency || $currency instanceof Collection) {
				config()->set('currency', $currency->toArray());
			}
		}
		// Config: Language
		if (!$lang->isEmpty()) {
			config()->set('lang.abbr', $lang->get('abbr'));
			config()->set('lang.locale', $lang->get('locale'));
			config()->set('lang.direction', $lang->get('direction'));
			config()->set('lang.russian_pluralization', $lang->get('russian_pluralization'));
			config()->set('lang.date_format', $lang->get('date_format') ?? null);
			config()->set('lang.datetime_format', $lang->get('datetime_format') ?? null);
			
			// Apply the Language
			app()->setLocale(config('lang.abbr'));
		}
	}
}
