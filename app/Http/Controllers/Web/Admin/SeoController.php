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

namespace App\Http\Controllers\Web\Admin;

use App\Models\Seo;
use App\Http\Controllers\Web\Admin\Panel\PanelController;
use App\Http\Requests\Admin\SeoRequest as StoreRequest;
use App\Http\Requests\Admin\SeoRequest as UpdateRequest;

class SeoController extends PanelController
{
	public function setup()
	{
		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
		$this->xPanel->setModel('App\Models\Seo');
		$this->xPanel->setRoute(admin_uri('seo'));
		$this->xPanel->setEntityNameStrings(trans('admin.seo'), trans('admin.seoes'));
		
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_activation_button', 'bulkActivationButton', 'end');
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_deactivation_button', 'bulkDeactivationButton', 'end');
		$this->xPanel->addButtonFromModelFunction('top', 'bulk_deletion_button', 'bulkDeletionButton', 'end');
		
		// Filters
		// -----------------------
		$this->xPanel->disableSearchBar();
		// -----------------------
		$this->xPanel->addFilter(
			[
				'name'  => 'name',
				'type'  => 'text',
				'label' => mb_ucfirst(trans('admin.Name')),
			],
			false,
			function ($value) {
				$this->xPanel->addClause('where', function ($query) use ($value) {
					$query->where('meta_title', 'LIKE', "%$value%")
						->orWhere('meta_des', 'LIKE', "%$value%")
						->orWhere('meta_keywords', 'LIKE', "%$value%")
						->orWhere('content', 'LIKE', "%$value%");
				});
			}
		);
		// -----------------------
		$this->xPanel->addFilter(
			[
				'name'  => 'status',
				'type'  => 'dropdown',
				'label' => trans('admin.Status'),
			],
			[
				1 => trans('admin.Activated'),
				2 => trans('admin.Unactivated'),
			],
			function ($value) {
				if ($value == 1) {
					$this->xPanel->addClause('where', 'active', '=', 1);
				}
				if ($value == 2) {
					$this->xPanel->addClause('where', fn ($query) => $query->columnIsEmpty('active'));
				}
			}
		);
		
		/*
		|--------------------------------------------------------------------------
		| COLUMNS AND FIELDS
		|--------------------------------------------------------------------------
		*/
		// COLUMNS
		$this->xPanel->addColumn([
			'name'      => 'id',
			'label'     => '',
			'type'      => 'checkbox',
			'orderable' => false,
		]);
		
		$this->xPanel->addColumn([
			'name'          => 'city_id',
			'label'         => trans('admin.City'),
			'type'          => 'model_function',
			'function_name' => 'getCityName',
		]);
		
		$this->xPanel->addColumn([
			'name'  => 'meta_title',
			'label' => mb_ucfirst(trans('admin.title')),
		]);
		
		$this->xPanel->addColumn([
			'name'  => 'meta_des',
			'label' => trans('admin.Description'),
		]);
		
		$this->xPanel->addColumn([
			'name'  => 'meta_keywords',
			'label' => trans('admin.Keywords'),
		]);
		
		$this->xPanel->addColumn([
			'name'          => 'active',
			'label'         => trans('admin.Active'),
			'type'          => 'model_function',
			'function_name' => 'getActiveHtml',
			'on_display'    => 'checkbox',
		]);
		
		
		// FIELDS
		$this->xPanel->addField([
			'name'        => 'city_id',
			'label'       => trans('admin.city'),
			'type'        => 'select2_from_array',
			'options'     => Seo::getDefaultCity(),
			'allows_null' => false,
		], 'create');
		
		$this->xPanel->addField([
			'name'        => 'city_id',
			'label'       => trans('admin.city'),
			'type'        => 'select2_from_array',
			'options'     => Seo::getDefaultCity(),
			'allows_null' => false,
			'attributes'  => [ 'disabled' => true,],
		], 'update');
		
		$this->xPanel->addField([
			'name'       => 'meta_title',
			'label'      => mb_ucfirst(trans('admin.title')),
			'type'       => 'text',
			'attributes' => ['placeholder' => mb_ucfirst(trans('admin.title')),],
			'hint'       => trans('admin.seo_title_hint'),
		]);
		
		$this->xPanel->addField([
			'name'       => 'meta_des',
			'label'      => trans('admin.Description'),
			'type'       => 'textarea',
			'attributes' => [ 'placeholder' => trans('admin.Description'),],
			'hint'       => trans('admin.seo_description_hint'),
		]);
		
		$this->xPanel->addField([
			'name'       => 'meta_keywords',
			'label'      => trans('admin.Keywords'),
			'type'       => 'textarea',
			'attributes' => ['placeholder' => trans('admin.Keywords'),],
			'hint'       => trans('admin.comma_separated_hint') . ' ' . trans('admin.seo_keywords_hint'),
		]);
		
		$this->xPanel->addField([
			'name'       => 'content',
			'label'      => trans('admin.content'),
			'type'       => 'ckeditor',
			'attributes' => ['placeholder' => trans('admin.Content'),],
			'hint'       => trans('admin.comma_separated_hint') . ' ' . trans('admin.seo_contents_hint'),
		]);
		
		
		$this->xPanel->addField([
			'name'  => 'active',
			'label' => trans('admin.Active'),
			'type'  => 'checkbox_switch',
		]);  
	}
	
	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}
	
	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
