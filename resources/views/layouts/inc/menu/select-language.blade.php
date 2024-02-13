<?php $supportedLanguages = getSupportedLanguages(); ?>
@if (is_array($supportedLanguages) && count($supportedLanguages) )
	{{-- Language Selector --}}
	<li class="nav-item dropdown lang-menu ">
		<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" id="langDropdown">
			<span><i class="flag-icon flag-icon-gb"></i> English </span>
			
		</a>
		<ul id="langDropdownItems"
			class="dropdown-menu dropdown-menu-end user-menu shadow-sm"
			role="menu"
			aria-labelledby="langDropdown"
		>
			@foreach($supportedLanguages as $langCode => $lang)
				<li class="dropdown-item{{ (strtolower($langCode) == strtolower(config('app.locale'))) ? ' active' : '' }}">
					<a href="{{ url('locale/' . $langCode) }}" tabindex="-1" rel="alternate" hreflang="{{ $langCode }}" title="{{ $lang['name'] }}">
						<?php
							$langFlag = (
								config('settings.app.show_languages_flags')
								&& isset($lang, $lang['flag'])
								&& is_string($lang['flag'])
								&& !empty(trim($lang['flag']))
							)
								? '<i class="flag-icon ' . $lang['flag'] . '"></i>&nbsp;'
								: '';
						?>
						{!! $langFlag. $lang['native'] !!}
					</a>
				</li>
			@endforeach
		</ul>
	</li>
@endif