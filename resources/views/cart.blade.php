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
						{!! Form::open(['route'=> 'post-order', 'autocomplete' => 'off', 'method' => 'put']) !!}
							@foreach($orderedProducts as $orderedProduct)
								<div class="row m-3">
									<div class="col-md-2">
										<img class="img-fluid img-thumbnail" src="{{$orderedProduct->main_photo ? asset($orderedProduct->main_photo) : asset('img/common/default.png')}}" alt="{{ $orderedProduct->name }}">
									</div>
									<div class="col-md-3">
										<p>Название:</p>
										{{$orderedProduct->name}}
									</div>
									<div class="col-md-2">
										<p>Цена:</p>
										{{$orderedProduct->price}}
									</div>
									<div class="col-md-2">
										<p>Количество:</p>
										{!! Form::number('itemQuantity'.$orderedProduct->id, old('itemQuantity'.$orderedProduct->id) ? old('itemQuantity'.$orderedProduct->id) :$orderedProduct->quantity, ['id'=>"itemQuantity$orderedProduct->id", 'placeholder'=>'Количество', 'min'=>'1', 'oninput'=>"countItemResult($orderedProduct->id, $orderedProduct->price, Math.abs(this.value));allgemeine();"] + ($errors->has('itemQuantity'.$orderedProduct->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
										{!! Form::hidden('itemId', $orderedProduct->id)!!}
 										{{-- <input type="hidden" id="itemId" name="itemId" value="{{$orderedProduct->id}}"> --}}
										{{-- <input id="itemQuantity{{$orderedProduct->id}}" type="number" oninput="countItemResult({{$orderedProduct->id}}, {{$orderedProduct->price}}, Math.abs(this.value));allgemeine();" name="itemQuantity{{$orderedProduct->id}}" class="form-control" min="1" value="{{$orderedProduct->quantity}}"> --}}
									</div>
									<div class="col-md-3">
										<p>Всего:</p>
										<p class="itemResult" id="itemResult{{$orderedProduct->id}}"></p>
									</div>
								</div>
								<script>
									countItemResult({{$orderedProduct->id}}, {{$orderedProduct->price}}, {{$orderedProduct->quantity}});
								</script>
							@endforeach
							<div class="m-3">
								<h3 class="text-right">Всего: <span id="allgemeine"></span></h3>
							</div>
							Заказать быстро
						{!! Form::close() !!}
						Зарегистрироваться Войти 
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