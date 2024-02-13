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

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class SeoRequest extends Request
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'meta_title'    => ['required', 'max:255'],
			'meta_des'      => ['required', 'max:10000'],
			'meta_keywords' => ['required','max:10000'],
			'content'       => ['required','max:10000'],
		];
		
		if (in_array($this->method(), ['POST', 'CREATE'])) {
			$rules['city_id'][] = 'required';
			
			// Unique with additional Where Clauses
			$uniquePage = Rule::unique('seo_cities')->where(function ($query) {
				return $query->where('city_id', $this->city_id);
			});
			
			$rules['city_id'][] = $uniquePage;
		}
		
		return $rules;
	}
	
	/**
	 * @return array
	 */
	public function messages()
	{
		$messages = [];
		
		$messages['city_id.unique'] = trans('admin.A seo entry already exists for this city');
		
		return $messages;
	}
}
