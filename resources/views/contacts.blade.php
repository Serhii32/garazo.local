@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">Контакты</h3>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-4">
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Адрес: г. Винница, ул. Пирогова 151,е</h5>
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Телефон: 067 430 69 18</h5>
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Email: garazo@i.ua</h5>
						</div>
						<div class="col-12 col-md-6 col-lg-8">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2606.3943349011242!2d28.42218981568689!3d49.212048179323716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472d5c0ca762e777%3A0x7baf90746b964ee2!2z0LLRg9C70LjRhtGPINCf0LjRgNC-0LPQvtCy0LAsIDE1MSwg0JLRltC90L3QuNGG0Y8sINCS0ZbQvdC90LjRhtGM0LrQsCDQvtCx0LvQsNGB0YLRjCwgMjEwMDA!5e0!3m2!1suk!2sua!4v1541415500746" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection