@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container py-4">
                    <h2 class="text-center font-weight-bold text-uppercase">Список товаров</h2>
                    @if(count($products))
                        <div class="row justify-content-center">
                            @foreach($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                                    <div class="card h-100 shadow p-2">
                                        <a class="card-link text-secondary p-1" href="{{route('admin.products.edit', $product->id)}}">
                                            <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->title }}"></div>
                                            <h4 class="text-center text-uppercase">{{$product->title}}</h4>
                                        </a>
                                        <h5 class="text-center text-uppercase text-secondary">Цена: {{$product->price}}</h5>
                                        <div class="p-3">
                                            @if($product->novelty)
                                                <span class="badge badge-pill badge-success w-100">Новинка</span>
                                            @endif
                                            @if($product->most_saled !== 0 && $product->most_saled >= $most_saled_last)
                                                <span class="badge badge-pill badge-secondary w-100">Топ продаж</span>
                                            @endif
                                            @if($product->promo_action)
                                                <span class="badge badge-pill badge-danger w-100">Акция</span>
                                            @endif
                                            @if($product->best)
                                                <span class="badge badge-pill badge-primary w-100">Лучшее</span>
                                            @endif
                                        </div>
                                        {!! Form::open(['route'=> ['admin.products.destroy', $product->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0', 'method' => 'delete', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$products->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Товары отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
