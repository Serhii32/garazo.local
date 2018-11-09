@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">

					<div class="text-dark font-weight-bold text-uppercase">{{ Breadcrumbs::render('page.thank-you') }}</div>

					<div class="text-left"><a href="{{route('page.products-services')}}" class="btn btn-primary text-light font-weight-bold text-uppercase">Вернутся к покупкам</a></div>
					<br>
					<h4 class="container text-dark text-center">Благодарим вас за то что сделали заказ на нашем сайте.<br><br>
						Ваш заказ отправлен в обработку, наши менеджеры скоро свяжутся с вами для уточнения деталей.
					</h4>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection