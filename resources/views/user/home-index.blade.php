@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('user.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container py-4">
                    <h2 class="text-center font-weight-bold text-uppercase">Мои заказы</h2>
                    @if(count($orders))
                        <div class="container">
                            @foreach($orders as $order)
                                <div class="my-3 h-100 shadow p-2 bg-white">
                                    <h4 class="text-left text-uppercase text-danger">@if($order->status == 1)Новый заказ @elseif($order->status == 2)Выполняется @elseif($order->status == 3)Выполнен @elseif($order->status == 4)Отменен @else @endif</h4>
                                    <h4 class="text-left text-uppercase">Доставка: @if($order->delivery == 1)Самовывоз @elseif($order->delivery == 2)Новая почта @else @endif </h4>
                                    @if($order->delivery == 2 && $order->newPost)<h4 class="text-left text-uppercase">Адрес: {{$order->newPost}} </h4> @endif
                                    <h4 class="text-left text-uppercase">Оплата: @if($order->payment == 1)Предоплата на карту @elseif($order->payment == 2)Наложеный платеж @elseif($order->payment == 3)Безналичный @else @endif </h4>
                                    <div>
                                        @foreach($order->products()->get() as $product)
                                            <div class="row border-bottom p-1">
                                                <div class="col-12 col-lg-2 pb-2 text-center">
                                                    <img class="img-fluid img-thumbnail" style="max-height: 100px;" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->title }}">
                                                </div>
                                                <div class="col-6 col-lg-3 text-dark font-weight-bold text-uppercase pb-2">
                                                    <p>Название:</p>
                                                    <a href="{{route('page.product', $product->id)}}">{{$product->title}}</a>
                                                </div>
                                                <div class="col-6 col-lg-2 text-dark font-weight-bold text-uppercase pb-2">
                                                    <p>Цена:</p>
                                                    {{$product->pivot->price}}
                                                </div>
                                                <div class="col-6 col-lg-2 text-dark font-weight-bold text-uppercase pb-2">
                                                    <p>Количество:</p>
                                                    {{$product->pivot->quantity}}
                                                </div>
                                                <div class="col-6 col-lg-2 text-dark font-weight-bold text-uppercase pb-2">
                                                    <p>Всего:</p>
                                                    {{$product->pivot->price * $product->pivot->quantity}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h4 class="text-left text-uppercase">Всего: {{$order->totalSum}}</h4>

                                    @if($order->status != 4)
                                        {!! Form::open(['route'=> ['user.home.cancel-order', $order->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0 mb-3', 'method' => 'put', 'onsubmit' => 'return confirm("Подтвердить отмену?")']) !!}
                                            {!! Form::hidden('status', 4) !!}
                                            {!! Form::submit('Отменить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    @elseif($order->status == 4)
                                        {!! Form::open(['route'=> ['user.home.cancel-order', $order->id], 'class'=>'btn btn-primary mb-0 mt-auto mx-auto w-100 p-0 mb-3', 'method' => 'put', 'onsubmit' => 'return confirm("Подтвердить возобновление?")']) !!}
                                            {!! Form::hidden('status', 1) !!}
                                            {!! Form::submit('Возобновить', ['class'=>'btn btn-primary mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    @else

                                    @endif
                                
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$orders->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Заказы отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
