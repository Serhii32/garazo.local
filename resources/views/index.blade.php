@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-4 col-lg-3">
				    <div class="m-2 bg-white border border-light shadow rounded">
				    	<h5 class="text-dark font-weight-bold text-uppercase text-center p-4">Товары и услуги</h5>

				        <ul class="list-group list-group-flush">

				        	@foreach($productsCategories as $productsCategory)
								<li class="list-group-item p-2">
					                <a class="card-link text-dark font-weight-bold text-uppercase" href="#">― {{$productsCategory->title}} </a>
					                @if(count($productsCategory->childs))
						                <a class="float-right" data-toggle="collapse" href="#c{{$productsCategory->id}}"><i data-toggle="collapse" class="fas fa-angle-down"></i></a>
						                @include('shared.sidebar-subcategories', ['childs' => $productsCategory->childs, 'idNumber' => $productsCategory->id])
					                @endif
					            </li>
				        	@endforeach

				        </ul>
				    </div>
				</div>
				<div class="col-12 col-md-8 col-lg-9">

					<div class="customSlideshow">
						
						<div class="slideshow-container">

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">1 / 3</div>
							  	<img src="https://www.w3schools.com/howto/img_nature_wide.jpg">
							  	<div class="customSlidesText">Caption Text</div>
							</div>

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">2 / 3</div>
							  	<img src="https://www.w3schools.com/howto/img_snow_wide.jpg">
							  	<div class="customSlidesText">Caption Two</div>
							</div>

							<div class="customSlides customSlidesFade">
							  	<div class="numbertext">3 / 3</div>
							  	<img src="https://www.w3schools.com/howto/img_mountains_wide.jpg">
							  	<div class="customSlidesText">Caption Three</div>
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

					<style>
						.customSlideshow .customSlides {
							display: none;
						}

						.customSlideshow img {
							vertical-align: middle; 
							width:100%;
						}

						/* Slideshow container */
						.customSlideshow .slideshow-container {
						  position: relative;
						  margin: auto;
						}

						/* Caption text */
						.customSlideshow .customSlidesText {
						  color: #f2f2f2;
						  font-size: 15px;
						  padding: 8px 12px;
						  position: absolute;
						  bottom: 8px;
						  width: 100%;
						  text-align: center;
						}

						/* Number text (1/3 etc) */
						.customSlideshow .numbertext {
						  color: #f2f2f2;
						  font-size: 15px;
						  padding: 8px 12px;
						  position: absolute;
						  top: 8px;
						  width: 100%;
						}

						/* The dots/bullets/indicators */
						.customSlideshow .customSlidesDot {
						  cursor: pointer;
						  height: 15px;
						  width: 15px;
						  margin: 0 2px;
						  background-color: #bbb;
						  border-radius: 50%;
						  display: inline-block;
						  transition: background-color 0.6s ease;
						}

						.customSlideshow .customSlidesDots {
							text-align: center;
							padding: 10px;
						}

						.customSlideshow .customSlidesActive {
						  background-color: #717171;
						}

						/* Fading animation */
						.customSlideshow .customSlidesFade {
						  -webkit-animation-name: customSlidesFade;
						  -webkit-animation-duration: 1.5s;
						  animation-name: customSlidesFade;
						  animation-duration: 1.5s;
						}

						/* Next & previous buttons */
						.customSlideshow .customSlidesPrev, .customSlideshow .customSlidesNext {
						  cursor: pointer;
						  position: absolute;
						  top: 50%;
						  width: auto;
						  padding: 16px;
						  margin-top: -22px;
						  color: white;
						  font-weight: bold;
						  font-size: 18px;
						  transition: 0.6s ease;
						  border-radius: 0 3px 3px 0;
						}

						/* Position the "next button" to the right */
						.customSlideshow .customSlidesNext {
						  right: 0;
						  border-radius: 3px 0 0 3px;
						}

						/* On hover, add a black background color with a little bit see-through */
						.customSlideshow .customSlidesPrev:hover, .customSlideshow .customSlidesNext:hover {
						  background-color: rgba(0,0,0,0.8);
						}

						.customSlideshow .customSlidesActive, .customSlideshow .customSlidesDot:hover {
						  background-color: #717171;

						@-webkit-keyframes customSlidesFade {
						  from {opacity: .4} 
						  to {opacity: 1}
						}

						@keyframes customSlidesFade {
						  from {opacity: .4} 
						  to {opacity: 1}
						}

						/* On smaller screens, decrease text size */
						@media only screen and (max-width: 300px) {
						  .customSlideshow .customSlidesText {font-size: 11px}
						}
					</style>

					<script>
						var slideIndex = 0;
						showSlides(slideIndex);

						function plusSlides(n) {
						  showSlides(slideIndex += n);
						}

						function currentSlide(n) {
						  showSlides(slideIndex = n);
						}

						function showSlides(n) {
						  var i;
						  var slides = document.getElementsByClassName("customSlides");
						  var dots = document.getElementsByClassName("customSlidesDot");
						  if (n > slides.length) {slideIndex = 1}    
						  if (n < 1) {slideIndex = slides.length}
						  for (i = 0; i < slides.length; i++) {
						      slides[i].style.display = "none";  
						  }
						  for (i = 0; i < dots.length; i++) {
						      dots[i].className = dots[i].className.replace(" customSlidesActive", "");
						  }
						  slides[slideIndex-1].style.display = "block";  
						  dots[slideIndex-1].className += " customSlidesActive";
						}

						autoShowSlides(slideIndex);
						function autoShowSlides() {
						    var i;
						    var slides = document.getElementsByClassName("customSlides");
						    var dots = document.getElementsByClassName("customSlidesDot");
						    for (i = 0; i < slides.length; i++) {
						       slides[i].style.display = "none";  
						    }
						    slideIndex++;
						    if (slideIndex > slides.length) {slideIndex = 1}    
						    for (i = 0; i < dots.length; i++) {
						        dots[i].className = dots[i].className.replace(" customSlidesActive", "");
						    }
						    slides[slideIndex-1].style.display = "block";  
						    dots[slideIndex-1].className += " customSlidesActive";
						    setTimeout(autoShowSlides, 7000);
						}
					</script>
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
			                                            <h4 class="text-center text-uppercase">{{$productsCategory->title}}</h4>
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
@endsection