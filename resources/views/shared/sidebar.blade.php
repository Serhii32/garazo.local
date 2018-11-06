<div class="col-12 col-md-4 col-lg-3">
    <div class="m-2 bg-white border border-light shadow rounded">
    	<h5 class="text-dark font-weight-bold text-uppercase text-center p-4">Товары и услуги</h5>

        <ul class="list-group list-group-flush">

        	@foreach($productsCategories as $productsCategory)
				<li class="list-group-item p-2">
	                <a class="card-link text-dark font-weight-bold" href="{{route('page.products-category', $productsCategory->id)}}">{{$productsCategory->title}} </a>
	                @if(count($productsCategory->childs))
		                <a class="float-right" data-toggle="collapse" href="#c{{$productsCategory->id}}"><i data-toggle="collapse" class="fas fa-angle-down"></i></a>
		                @include('shared.sidebar-subcategories', ['childs' => $productsCategory->childs, 'idNumber' => $productsCategory->id])
	                @endif
	            </li>
        	@endforeach

        </ul>
    </div>
</div>