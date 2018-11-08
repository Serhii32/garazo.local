@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">

					<div class="text-dark font-weight-bold text-uppercase">{{ Breadcrumbs::render('page.about') }}</div>

					<h4 class="container text-dark text-justify">
						Компания Garazo предлагает широкий выбор автомоек самообслуживания, комплектующих и аксессуаров к ним, автохимии, автохимчистки, а также комплектующих и расходников для автомоек.<br><br>

						У нас самый широкий ассортимент товаров и конкурентоспособные цены.<br> 
						Мы всегда рады помочь и предоставить бесплатную консультацию, для того чтобы вы получили именно то, что вам необходимо. А если чего-то нет в наличии - вы всегда можете заказать нужный товар, и мы достанем его для вас.<br><br>

						Мы подбираем и укомплектовывает автомойки самообслуживания, в зависимости от желаемой комплектации - от минимальной и до полного фарша.<br><br>

						Обращаясь в Garazo вы можете быть уверенны в высоком качестве предлагаемых товаров и обслуживания.
					</h4>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection