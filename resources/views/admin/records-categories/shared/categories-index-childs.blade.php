<ul>
	@foreach($childs as $child)
		<li>
		    <a href="{{route('admin.productsCategories.edit', $child->id)}}">{{ $child->title }}</a>
		@if(count($child->childs))
	            @include('admin.products-categories.shared.categories-index-childs',['childs' => $child->childs])
	        @endif
		</li>
	@endforeach
</ul>