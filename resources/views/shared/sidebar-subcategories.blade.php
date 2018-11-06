<ul class="list-group list-group-flush collapse" id="c{{$idNumber}}">
	@foreach($childs as $child)
		<li class="list-group-item pl-3 p-2 border-0">
		    <a class="card-link text-dark font-weight-bold" href="{{route('page.products-category', $child->id)}}">{{ $child->title }}</a>
		    @if(count($child->childs))
			    <a class="float-right" data-toggle="collapse" href="#c{{$child->id}}"><i data-toggle="collapse" class="fas fa-angle-down"></i></a>
				@include('shared.sidebar-subcategories',['childs' => $child->childs, 'idNumber' => $child->id])
		    @endif
		</li>
	@endforeach
</ul>