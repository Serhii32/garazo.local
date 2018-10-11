<ul>
	@foreach($childs as $child)
		<li>
		    <a href="{{route('admin.recordsCategories.edit', $child->id)}}">{{ $child->title }}</a>
		@if(count($child->childs))
	            @include('admin.records-categories.shared.categories-index-childs',['childs' => $child->childs])
	        @endif
		</li>
	@endforeach
</ul>