@extends('layouts.app')
@section('content')
	<link href="{{ asset('css/frontend-index-slider.css') }}" rel="stylesheet">
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">

					<div class="customSlideshow">
						
						<div class="slideshow-container">

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">1 / 3</div>
							  	<img src="{{asset('img/index-page-slider/1.png')}}" alt="Все для автомоек">
							  	<div class="customSlidesText"></div>
							</div>

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">2 / 3</div>
							  	<img src="{{asset('img/index-page-slider/2.png')}}" alt="Откройте свою автомойку самообслуживания уже сейчас!">
							  	<div class="customSlidesText"></div>
							</div>

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">3 / 3</div>
							  	<img src="{{asset('img/index-page-slider/3.png')}}" alt="Чистка авто профессиональной химией изменит его до неузнаваемости">
							  	<div class="customSlidesText"></div>
							</div>

							<a class="customSlidesPrev" onclick="plusSlides(-1)">&#10094;</a>
							<a class="customSlidesNext" onclick="plusSlides(1)">&#10095;</a>

						</div>

						<div class="customSlidesDots">
							<span class="customSlidesDot" onclick="currentSlide(1)"></span> 
							<span class="customSlidesDot" onclick="currentSlide(2)"></span> 
							<span class="customSlidesDot" onclick="currentSlide(3)"></span> 
						</div>

					</div>
					@if(count($productsCategories))
						<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">Категории товаров</h3>
						<div class="container">
							<div class="row justify-content-center">
	                            @foreach($productsCategories as $productsCategory)
	                                <div class="col-12 col-sm-6 my-3">
	                                    <div class="card h-100 shadow p-2">
	                                    	<div class="row">
	                                    		<div class="col-12 col-sm-6">
	                                    			<a class="card-link text-secondary p-1" href="#">
			                                            <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$productsCategory->photo ? asset($productsCategory->photo) : asset('img/common/default.png')}}" alt="{{ $productsCategory->title }}"></div>
			                                        </a>
	                                    		</div>
	                                    		<div class="col-12 col-sm-6">
	                                    			<a class="card-link text-secondary p-1" href="#">
			                                            <h5 class="text-center text-uppercase">{{$productsCategory->title}}</h5>
			                                        </a>
			                                        <p class="text-center text-secondary p-1">
			                                        	{{$productsCategory->short_description}}
			                                        </p>
	                                    		</div>
	                                    	</div>
	                                    </div>
	                                </div>
	                            @endforeach
	                        </div>
						</div>
					@endif
					
					@if(count($products))
						<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">Товары</h3>
						<div class="container">
							<div class="row justify-content-center">
	                            @foreach($products as $product)
	                                <div class="col-12 col-sm-6 col-md-4 my-3">
	                                    <div class="card h-100 shadow p-2">
	                                        <a class="card-link text-secondary p-1" href="#">
	                                            <div class="text-center">
	                                            	<img class="img-fluid img-thumbnail" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->title }}">
	                                            	@if($product->most_saled !== 0 && $product->most_saled >= $most_saled_last)
	                                            		<span style="position: absolute; top: 0px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url(https://uaprom-uc.prom.st/production/design_template/849/images/ribbon.png) 0 -105px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Топ продаж</span>
	                                            	@endif
	                                            	@if($product->novelty)
	                                            		<span style="position: absolute; top: 40px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url(https://uaprom-uc.prom.st/production/design_template/849/images/ribbon.png) 0 -165px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Новинка</span>
	                                            	@endif
	                                            	@if($product->promo_action)
	                                            		<span style="position: absolute; top: 80px; right: 0px; z-index: 1; width: 131px; height: 39px; background: url(https://uaprom-uc.prom.st/production/design_template/849/images/ribbon.png) 0 -222px no-repeat; color: #fff; text-align: center; font-size: 13px; line-height: 37px;">Акция</span>
	                                            	@endif
	                                            </div>
	                                            <h4 class="text-center text-uppercase">{{$product->title}}</h4>
	                                        </a>
	                                        <h5 class="text-center text-uppercase text-secondary">Цена: {{$product->price}}</h5>

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
	<script src="{{ asset('js/frontend-index-slider.js') }}"></script>
@endsection