@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">Корзина</h3>
					@if(count($orderedProducts))
						<script>
							function countItemResult(itemId, itemPrice, itemQuantity){
								var itemResult = document.getElementById('itemQuantity'+itemId).value;
								document.getElementById("itemResult"+itemId).innerHTML = (itemPrice * itemQuantity).toFixed(2);
							}

							function allgemeine(){
								var items = document.getElementsByClassName("itemResult");
								var itemsResult = 0;
								for(i=0; i<items.length; i++){
									
									itemsResult += parseFloat(items[i].innerHTML);
									
								}
								document.getElementById('allgemeine').innerHTML = itemsResult.toFixed(2);
							}
						</script>
						{!! Form::open(['route'=> 'page.order', 'autocomplete' => 'off', 'method' => 'put']) !!}
							@foreach($orderedProducts as $orderedProduct)
								<div class="row m-3 border-bottom p-1">
									<div class="col-12 col-md-2 pb-2 text-center">
										<img class="img-fluid img-thumbnail" style="max-height: 100px;" src="{{$orderedProduct->main_photo ? asset($orderedProduct->main_photo) : asset('img/common/default.png')}}" alt="{{ $orderedProduct->name }}">
									</div>
									<div class="col-6 col-md-3 text-dark font-weight-bold text-uppercase pb-2">
										<p>Название:</p>
										{{$orderedProduct->name}}
									</div>
									<div class="col-6 col-md-2 text-dark font-weight-bold text-uppercase pb-2">
										<p>Цена:</p>
										{{$orderedProduct->price}}
									</div>
									<div class="col-6 col-md-2 text-dark font-weight-bold text-uppercase pb-2">
										<p>Количество:</p>
										{!! Form::number('itemQuantity'.$orderedProduct->id, old('itemQuantity'.$orderedProduct->id) ? old('itemQuantity'.$orderedProduct->id) :$orderedProduct->quantity, ['id'=>"itemQuantity$orderedProduct->id", 'placeholder'=>'Количество', 'min'=>'1', 'oninput'=>"countItemResult($orderedProduct->id, $orderedProduct->price, Math.abs(this.value));allgemeine();"] + ($errors->has('itemQuantity'.$orderedProduct->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
									</div>
									<div class="col-6 col-md-2 text-dark font-weight-bold text-uppercase pb-2">
										<p>Всего:</p>
										<p class="itemResult" id="itemResult{{$orderedProduct->id}}"></p>
									</div>
									<div class="m-auto col-md-1 text-dark font-weight-bold text-uppercase pb-2 text-center">
										<a href="{{route('delete-from-cart', $orderedProduct->id)}}"><i class="fas fa-times-circle text-dark" style="font-size: 20px;"></i></a>
									</div>
								</div>
								<script>
									countItemResult({{$orderedProduct->id}}, {{$orderedProduct->price}}, {{$orderedProduct->quantity}});
								</script>
							@endforeach
							<div class="m-3 text-dark font-weight-bold text-uppercase">
								<h3 class="text-right">Всего: <span id="allgemeine"></span></h3>
							</div>
							@auth
								<div class="text-center">
									{!! Form::submit('Заказать', ['class'=>'btn btn-success w-75 text-uppercase font-weight-bold']) !!}								
								</div>
							@endauth
							@guest
								<div class="text-center">
									{!! Form::submit('Заказать быстро', ['class'=>'btn btn-success w-75 text-uppercase font-weight-bold']) !!}								
								</div>
							@endguest
						{!! Form::close() !!}
						@guest
							<div class="row my-2">
								<div class="col-md-6 text-right mb-2">
									<a href="{{route('register')}}" class="btn btn-primary text-light font-weight-bold text-uppercase w-100">Зарегистрироваться</a>
								</div>
								<div class="col-md-6 text-left mb-2">
									<a href="{{route('login')}}" class="btn btn-primary text-light font-weight-bold text-uppercase w-100">Войти</a>
								</div>
							</div>
						@endguest
						<script>
							allgemeine();
						</script>
					@else
						<h4 class="text-dark font-weight-bold text-uppercase text-center p-4">В корзине отсутсвуют товары</h4>
					@endif
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection