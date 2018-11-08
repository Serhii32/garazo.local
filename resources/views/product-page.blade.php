@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">

                    <div class="text-dark font-weight-bold text-uppercase">{{ Breadcrumbs::render('page.product', $product) }}</div>

					<div class="container">
						<div class="row justify-content-center px-4">
                            <div class="col-12 col-md-4 my-3 card h-100 shadow p-2">
                                <img class="img-fluid img-thumbnail" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->title }}">
                                @if($product->most_saled !== 0 && $product->most_saled >= $most_saled_last)
                            		<span style="position: absolute; top: 0px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url({{asset('img/common/ribbon.png')}}) 0 -105px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Топ продаж</span>
                            	@endif
                            	@if($product->novelty)
                            		<span style="position: absolute; top: 40px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url({{asset('img/common/ribbon.png')}}) 0 -165px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Новинка</span>
                            	@endif
                            	@if($product->promo_action)
                            		<span style="position: absolute; top: 80px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url({{asset('img/common/ribbon.png')}}) 0 -222px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Акция</span>
                            	@endif
                            </div>
                            <div class="col-12 col-md-8 my-3">
	                            <h4 class="text-center">{{$product->title}}</h4>
	                            <h5 class="text-left text-secondary">Цена: {{$product->price}} грн.</h5>
	                            {!! Form::open(['route'=> ['add-to-cart', $product->id], 'class'=>'mb-0 mt-auto mx-auto w-100 p-0']) !!}
                                    {!! Form::submit('Купить', ['class'=>'btn btn-warning mb-0 mt-auto mx-auto text-uppercase font-weight-bold']) !!}
                                {!! Form::close() !!}
                                <p class="text-justify text-secondary" style="font-size: 20px;">{{$product->short_description}}</p>
	                        </div>
                        </div>
                        @if(!empty($product->attributesNames()->first()))
                        	<h4 class="text-center">Характеристики товара</h4>

                            @php $k = 0; $previous = ''; $attributesNamesOrderedArray = $product->attributesNames()->orderBy('name')->get(); @endphp
                            @for($i=0; $i < count($attributesNamesOrderedArray); $i++)

                                @if($previous == $attributesNamesOrderedArray[$i]->name)
                                    @php $k++; @endphp
                                @else
                                    @php $k=0; @endphp
                                @endif
                                @php $previous = $attributesNamesOrderedArray[$i]->name @endphp

                                <div class="row mx-2">
                                    <div class="col-12 col-sm-6 py-2 border">
                                        <p class="text-uppercase font-weight-bold col-12">{{$attributesNamesOrderedArray[$i]->name}}</p>
                                    </div>
                                    <div class="col-12 col-sm-6 py-2 border">
                                        <p class="text-uppercase font-weight-bold col-12">{{$attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->value}}</p>
                                    </div>
                                </div>
                            @endfor
                        @endif
                        <div class="text-secondary item-description m-2" style="font-size: 20px;">
                        	{!! $product->description !!}
                        </div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection