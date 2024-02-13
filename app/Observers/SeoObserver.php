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

namespace App\Observers;

use App\Models\Seo;

class SeoObserver
{
	/**
	 * Listen to the Entry saved event.
	 *
	 * @param Seo $seo
	 * @return void
	 */
	public function saved(Seo $seo)
	{
		// Removing Entries from the Cache
		$this->clearCache($seo);
	}
	
	/**
	 * Listen to the Entry deleted event.
	 *
	 * @param Seo $seo
	 * @return void
	 */
	public function deleted(Seo $seo)
	{
		// Removing Entries from the Cache
		$this->clearCache($seo);
	}
	
	/**
	 * Removing the Entity's Entries from the Cache
	 *
	 * @param $seo
	 * @return void
	 */
	private function clearCache($seo)
	{
		try {
			cache()->flush();
		} catch (\Exception $e) {}
	}
}
