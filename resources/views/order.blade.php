@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					<div class="text-dark font-weight-bold text-uppercase">{{ Breadcrumbs::render('page.order') }}</div>
					@if(count($orderedProducts))
						@foreach($orderedProducts as $orderedProduct)
							<div class="row m-3 border-bottom p-1">
								<div class="col-md-2 pb-2 text-center">
									<img class="img-fluid img-thumbnail" style="max-height: 100px;" src="{{$orderedProduct->attributes['main_photo'] ? asset($orderedProduct->attributes['main_photo']) : asset('img/common/default.png')}}" alt="{{ $orderedProduct->name }}">
								</div>
								<div class="col-md-3 text-dark font-weight-bold text-uppercase pb-2">
									<p>Название:</p>
									{{$orderedProduct->name}}
								</div>
								<div class="col-md-2 text-dark font-weight-bold text-uppercase pb-2">
									<p>Цена:</p>
									{{$orderedProduct->price}}
								</div>
								<div class="col-md-2 text-dark font-weight-bold text-uppercase pb-2">
									<p>Количество:</p>
									{{$orderedProduct->quantity}}
								</div>
								<div class="col-md-3 text-dark font-weight-bold text-uppercase pb-2">
									<p>Всего:</p>
									{{$orderedProduct->getPriceSum()}}
								</div>
							</div>
						@endforeach
						<div class="m-3 text-dark font-weight-bold text-uppercase">
							<h3 class="text-right">Всего: {{$totalPrice}}</h3>
						</div>
						{!! Form::open(['route'=> 'make-order']) !!}
							<div class="col-12 p-4">
	                            <div class="form-group">
	                                {!! Form::label('name', 'Имя:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                {!! Form::text('name', isset($user->name) ? $user->name : old('name'), ['placeholder'=>'Имя'] + ($errors->has('name') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                <span class="text-danger">{{ $errors->first('name') }}</span>
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('email', 'Email:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                {!! Form::email('email', isset($user->email) ? $user->email : old('email'), ['placeholder'=>'Email'] + ($errors->has('email') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                <span class="text-danger">{{ $errors->first('email') }}</span>
	                            </div>
	                            <div class="form-group">
	                                {!! Form::label('phone', 'Телефон:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                {!! Form::number('phone', isset($user->phone) ? $user->phone : old('phone'), ['placeholder'=>'Телефон'] + ($errors->has('phone') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                <span class="text-danger">{{ $errors->first('phone') }}</span>
	                            </div>
	                            <div class="form-group row">
	                            	{!! Form::label('', 'Доставка:', ['class' => 'text-uppercase font-weight-bold col-12']) !!}
	                            	<div class="col-12 col-md-6">
	                            		{!! Form::radio('delivery', '1', true, ['id' => 'delivery1', 'onclick' => 'showNewPost(false)']) !!}
	                            		{!! Form::label('delivery1', 'Самовывоз', ['class' => 'text-uppercase font-weight-bold mr-4']) !!}
	                            	</div>
	                            	<div class="col-12 col-md-6">
										{!! Form::radio('delivery', '2', false, ['id' => 'delivery2', 'onclick' => 'showNewPost(true)']) !!}
	                            		{!! Form::label('delivery2', 'Новая почта', ['class' => 'text-uppercase font-weight-bold']) !!}
	                            	</div>
	                            </div>
	                            @if(count($output))
								<div id="newPostBlock" class="form-group" style="display: none;">
									{!! Form::label('newPost', 'Виберите отделение новой почты:', ['class' => 'text-uppercase font-weight-bold']) !!}
									{!! Form::select('newPost', $output, isset($user->newPost) ? $user->newPost : old('newPost'), ['placeholder' => 'Виберите отделение новой почты'] + ($errors->has('newPost') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
									<span class="text-danger">{{ $errors->first('newPost') }}</span>
								</div>
								@else
									<div id="newPostBlock" class="form-group" style="display: none;">
		                                {!! Form::label('newPost', 'Введите отделение новой почты:', ['class' => 'text-uppercase font-weight-bold']) !!}
		                                {!! Form::text('newPost', isset($user->newPost) ? $user->newPost : old('newPost'), ['placeholder'=>'Введите отделение новой почты'] + ($errors->has('newPost') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
		                                <span class="text-danger">{{ $errors->first('newPost') }}</span>
		                            </div>
								@endif
	                            <div class="form-group row">
	                            	{!! Form::label('', 'Оплата:', ['class' => 'text-uppercase font-weight-bold col-12']) !!}
	                            	<div class="col-12 col-md-4">
		                            	{!! Form::radio('payment', '1', true, ['id' => 'payment1']) !!}
		                            	{!! Form::label('payment1', 'Предоплата на карту', ['class' => 'text-uppercase font-weight-bold']) !!}
	                            	</div>
	                            	<div class="col-12 col-md-4">
										{!! Form::radio('payment', '2', false, ['id' => 'payment2']) !!}
		                            	{!! Form::label('payment2', 'Наложеный платеж', ['class' => 'text-uppercase font-weight-bold']) !!}
	                            	</div>
	                            	<div class="col-12 col-md-4">
		                            	{!! Form::radio('payment', '3', false, ['id' => 'payment3']) !!}
		                            	{!! Form::label('payment3', 'Безналичный', ['class' => 'text-uppercase font-weight-bold']) !!}
	                            	</div>
	                            </div>
	                            <div class="form-group">
	                                {!! Form::submit('Заказать', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
	                            </div>
	                        </div>
	                    {!! Form::close() !!}
					@else
						<h4 class="text-dark font-weight-bold text-uppercase text-center p-4">В корзине отсутсвуют товары</h4>
					@endif
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
	<script src="{{ asset('js/order-page-new-post.js') }}"></script>
@endsection