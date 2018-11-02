@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					<div class="row">
						<div class="col-12 col-md-6">
							<h5 class="text-dark font-weight-bold text-uppercase text-center p-4">Способы доставки:</h5>
							<ul class="list-group list-group-flush">
								<li class="list-group-item p-2 font-weight-bold">Самовывоз</li>
								<li class="list-group-item p-2 font-weight-bold">Доставка почтой</li>
								<li class="list-group-item p-2 border-bottom font-weight-bold">Транспортная компания</li>
							</ul>
							<br>
							<h5 class="text-dark font-weight-bold text-uppercase text-center p-4">Способы оплаты:</h5>
							<ul class="list-group list-group-flush">
								<li class="list-group-item p-2 font-weight-bold">Наличными</li>
								<li class="list-group-item p-2 font-weight-bold">Наложенный платеж</li>
								<li class="list-group-item p-2 border-bottom font-weight-bold">Предоплата</li>
							</ul>
						</div>
						<div class="col-12 col-md-6">
							<h5 class="text-dark font-weight-bold text-uppercase text-center p-4">Регионы доставки:</h5>
							<ul class="list-group list-group-flush">
								<li class="list-group-item p-2 font-weight-bold">Винницкая область</li>
								<li class="list-group-item p-2 font-weight-bold">Волынская область</li>
								<li class="list-group-item p-2 font-weight-bold">Днепропетровская область</li>
								<li class="list-group-item p-2 font-weight-bold">Житомирская область</li>
								<li class="list-group-item p-2 font-weight-bold">Закарпатская область</li>
								<li class="list-group-item p-2 font-weight-bold">Запорожская область</li>
								<li class="list-group-item p-2 font-weight-bold">Ивано-Франковская область</li>
								<li class="list-group-item p-2 font-weight-bold">Киевская область</li>
								<li class="list-group-item p-2 font-weight-bold">Черновицкая область</li>
								<li class="list-group-item p-2 font-weight-bold">Кировоградская область</li>
								<li class="list-group-item p-2 font-weight-bold">Львовская область</li>
								<li class="list-group-item p-2 font-weight-bold">Николаевская область</li>
								<li class="list-group-item p-2 font-weight-bold">Одесская область</li>
								<li class="list-group-item p-2 font-weight-bold">Полтавская область</li>
								<li class="list-group-item p-2 font-weight-bold">Ровненская область</li>
								<li class="list-group-item p-2 font-weight-bold">Сумская область</li>
								<li class="list-group-item p-2 font-weight-bold">Тернопольская область</li>
								<li class="list-group-item p-2 font-weight-bold">Харьковская область</li>
								<li class="list-group-item p-2 font-weight-bold">Херсонская область</li>
								<li class="list-group-item p-2 font-weight-bold">Хмельницкая область</li>
								<li class="list-group-item p-2 font-weight-bold">Черкасская область</li>
								<li class="list-group-item p-2 font-weight-bold">Черниговская область</li>
								<li class="list-group-item p-2 border-bottom font-weight-bold">Киев</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection