@if (isset($keywords) && !empty($keywords))
    <div class="block-title has-arrow sidebar-header"> <h5> <span class="fw-bold">	{{ t('Tags') }} </span> </h5> </div>
    <div class="block-content list-filter locations-list">
    	<ul class="browse-list list-unstyled long-list">
	        @php
	            $listTags = explode(',',$keywords);
	        @endphp
	        @if (isset($listTags) && !empty($listTags))
    	        @foreach($listTags as $tag)
    	             @if($tag)
    	                <li><button class="jobs-s-tag">{{ $tag ? $tag : ''  }}</button> </li>
    	             @endif         
    	        @endforeach
	        @endif
    	</ul>
    </div>
    <div style="clear:both"></div>
@endif