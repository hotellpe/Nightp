@php
    use App\Models\Post;

	$posts ??= [];
	$totalPosts ??= 0;
@endphp
@if (!empty($posts) && $totalPosts > 0)
	@foreach($posts as $key => $post)
		<div class="item-list">
			@if (data_get($post, 'featured') == 1)
				@if (!empty(data_get($post, 'payment.package')))
					@if (data_get($post, 'payment.package.ribbon') != '')
						<div class="ribbon-horizontal {{ data_get($post, 'payment.package.ribbon') }}">
							<span>{{ data_get($post, 'payment.package.short_name') }}</span>
						</div>
					@endif
				@endif
			@endif
			
			<div class="row">
				<div class="col-sm-2 col-12 no-padding photobox">
					<div class="add-image">
						<span class="photo-count">
							<i class="fa fa-camera"></i> {{ data_get($post, 'count_pictures') }}
						</span>
						<a href="{{ \App\Helpers\UrlGen::post($post) }}">
							{!! imgTag(data_get($post, 'picture.filename'), 'medium', ['class' => 'lazyload thumbnail no-margin', 'alt' => data_get($post, 'title')]) !!}
						</a>
					</div>
				</div>
		
				<div class="col-sm-7 col-12 add-desc-box">
					<div class="items-details">
						<h5 class="add-title" style="font-size:1rem !important ;">
							<a href="{{ \App\Helpers\UrlGen::post($post) }}">{{ str(data_get($post, 'title'))->limit(70) }}</a>
						</h5>
						
					    @php
                            $postDetail = Post::where('id',data_get($post, 'id'))->first();
                            $this_description = $postDetail->description;
                        @endphp
						
						<div class="show-description" style="margin-left:5px;margin-top:3px">{!! str($this_description)->limit(160) !!}</div>
						
						<span class="info-row">
							@if (config('settings.single.show_listing_types'))
								@if (!empty(data_get($post, 'postType')))
									<span class="add-type business-posts"
										  data-bs-toggle="tooltip"
										  data-bs-placement="bottom"
										  title="{{ data_get($post, 'postType.name') }}"
									>
										{{ strtoupper(mb_substr(data_get($post, 'postType.name'), 0, 1)) }}
									</span>&nbsp;
								@endif
							@endif
							
							@if (!config('settings.list.hide_dates'))
								<span class="date"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
									<i class="far fa-clock"></i> {!! data_get($post, 'created_at_formatted') !!}
								</span>
							@endif
							<span class="category"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
								<i class="bi bi-folder"></i>&nbsp;
								@if (!empty(data_get($post, 'category.parent')))
									<a href="{!! \App\Helpers\UrlGen::category(data_get($post, 'category.parent'), null, $city ?? null) !!}" class="info-link">
										{{ data_get($post, 'category.parent.name') }}
									</a>&nbsp;&raquo;&nbsp;
								@endif
								<a href="{!! \App\Helpers\UrlGen::category(data_get($post, 'category'), null, $city ?? null) !!}" class="info-link">
									{{ data_get($post, 'category.name') }}
								</a>
							</span>
							<span class="item-location"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
								<i class="bi bi-geo-alt"></i>&nbsp;
								<a href="{!! \App\Helpers\UrlGen::city(data_get($post, 'city'), null, $cat ?? null) !!}" class="info-link">
									{{ data_get($post, 'city.name') }}
								</a> {{ (!empty(data_get($post, 'distance'))) ? '- ' . round(data_get($post, 'distance'), 2) . getDistanceUnit() : '' }}
							</span>
						</span>
						
						@if (config('plugins.reviews.installed'))
							@if (view()->exists('reviews::ratings-list'))
								@include('reviews::ratings-list')
							@endif
						@endif
					</div>
				</div>
				
				<div class="col-sm-3 col-12 text-end price-box" style="white-space: nowrap;">
					<h2 class="item-price">
						{!! data_get($post, 'price_formatted') !!}
					</h2>
					@if (!empty(data_get($post, 'payment.package')))
						@if (data_get($post, 'payment.package.has_badge') == 1)
							<a class="btn btn-danger btn-sm make-favorite">
								<i class="fa fa-certificate"></i> <span>{{ data_get($post, 'payment.package.short_name') }}</span>
							</a>&nbsp;
						@endif
					@endif
					@if (!empty(data_get($post, 'savedByLoggedUser')))
						<a class="btn btn-success btn-sm make-favorite" id="{{ data_get($post, 'id') }}">
							<i class="fas fa-bookmark"></i> <span>{{ t('Saved') }}</span>
						</a>
					@else
						<a class="btn btn-default btn-sm make-favorite" id="{{ data_get($post, 'id') }}">
							<i class="fas fa-bookmark"></i> <span>{{ t('Save') }}</span>
						</a>
					@endif
				</div>
			</div>
		</div>
	@endforeach
@else
	<div class="p-4" style="width: 100%;">
		{{ t('no_result_refine_your_search') }}
	</div>
@endif

@section('after_scripts')
	@parent
	<script>
		{{-- Favorites Translation --}}
		var lang = {
			labelSavePostSave: "{!! t('Save listing') !!}",
			labelSavePostRemove: "{!! t('Remove favorite') !!}",
			loginToSavePost: "{!! t('Please log in to save the Listings') !!}",
			loginToSaveSearch: "{!! t('Please log in to save your search') !!}"
		};
	</script>
@endsection