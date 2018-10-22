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

					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris posuere dolor tortor, ut finibus odio ultricies molestie. Proin pulvinar tempor bibendum. Mauris sit amet efficitur neque. Mauris vehicula erat sit amet purus semper, a porta mi imperdiet. Sed interdum sagittis vulputate. Vestibulum massa ipsum, imperdiet id cursus at, tincidunt sit amet ante. Vivamus eget nulla sapien. Morbi aliquam dolor eget turpis varius ornare. Sed ut placerat est, ac congue arcu. Suspendisse potenti. Cras id iaculis risus, id rhoncus dolor. Quisque sed eros id urna hendrerit lacinia. Nunc sed diam ante.

Aenean eget porttitor orci. Cras sodales ut sapien eget placerat. Nulla tempor orci in ex ultrices, quis malesuada libero pellentesque. Mauris feugiat aliquet bibendum. Quisque vulputate eget ante id imperdiet. Nullam et metus eleifend, volutpat odio id, dapibus arcu. Integer volutpat, nibh eget congue pretium, nulla lorem cursus elit, vitae facilisis justo risus vitae lectus. Nullam tincidunt metus at massa lacinia, non interdum elit consequat. Donec a varius elit, vel condimentum lectus. Cras interdum lectus diam. Suspendisse mattis, nibh ut fringilla faucibus, ligula velit malesuada ligula, eu pretium mauris enim et arcu.

Suspendisse interdum ex ut orci pretium porta. Maecenas dapibus finibus lorem. In in dui ipsum. In eget odio eget erat placerat aliquam non eget eros. Cras dictum tortor in tempus condimentum. Praesent volutpat tincidunt eros, pulvinar tincidunt orci semper eget. Vivamus nec sapien ultricies, ultrices ipsum vitae, volutpat quam. In elit purus, bibendum eu felis fermentum, finibus pharetra augue. Praesent interdum quam vitae tortor molestie, in sagittis dui cursus. Sed blandit scelerisque posuere. Nulla vitae venenatis tellus, sed rhoncus tellus.

Aliquam commodo hendrerit enim, a eleifend neque sagittis ullamcorper. In in libero orci. Donec egestas nisi velit, pretium vestibulum est aliquam eget. Vestibulum sodales volutpat velit sed mollis. Ut porta, nisi vitae interdum efficitur, purus ex cursus ex, at porta massa massa sit amet purus. Sed non diam tincidunt, pellentesque eros non, laoreet turpis. Suspendisse commodo facilisis mattis.

Donec eu libero vel tortor ullamcorper convallis. Aenean bibendum felis sed ex laoreet interdum. Ut tincidunt metus pharetra est eleifend viverra. Maecenas in pharetra velit. Vestibulum sodales lectus nec porta pharetra. In at justo condimentum, vehicula quam scelerisque, pellentesque nibh. Maecenas porta id odio egestas dapibus.
				</div>
				
			</div>			
		
		
		</div>
	</main>
	@include('shared.front-footer')
@endsection