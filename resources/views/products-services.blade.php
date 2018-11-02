@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					@if(count($products))
						<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{$pageTitle}}</h3>
						<div class="container">
							<div class="row justify-content-center">
	                            @foreach($products as $product)
	                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 my-3">
	                                    <div class="card h-100 shadow p-2">
	                                        <a class="card-link text-secondary p-1" href="{{route('page.product', $product->id)}}">
	                                            <div class="text-center">
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
	                                            <h5 class="text-center text-uppercase">{{$product->title}}</h5>
	                                        </a>
	                                        <h6 class="text-center text-uppercase text-secondary">Цена: {{$product->price}} грн.</h6>

	                                        {!! Form::open(['route'=> ['add-to-cart', $product->id], 'class'=>'mb-0 mt-auto mx-auto w-100 p-0']) !!}
	                                            {!! Form::submit('Купить', ['class'=>'btn btn-warning mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
	                                        {!! Form::close() !!}
	                                       
	                                    </div>
	                                </div>
	                            @endforeach
	                        </div>
	                        <div class="custom-links py-4">{{$products->links()}}</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection