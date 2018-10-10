@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                <h2 class="text-center font-weight-bold text-uppercase">Страница администратора</h2>
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
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-clipboard-list"></i></h1>
                                    <h4 class="text-center text-uppercase">Список товаров</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-cart-plus"></i></h1>
                                    <h4 class="text-center text-uppercase">Добавить товар</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="{{route('admin.productsCategories.index')}}">
                                    <h1 class="display-1 text-center"><i class="fas fa-th-list"></i></i></h1>
                                    <h4 class="text-center text-uppercase">Категории товаров</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-newspaper"></i></h1>
                                    <h4 class="text-center text-uppercase">Список новостей</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="far fa-plus-square"></i></h1>
                                    <h4 class="text-center text-uppercase">Добавить новость</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-list"></i></h1>
                                    <h4 class="text-center text-uppercase">Категории новостей</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-shipping-fast"></i></h1>
                                    <h4 class="text-center text-uppercase">Список заказов</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                            <div class="card h-100 shadow">
                                <a class="card-link text-secondary p-1" href="#">
                                    <h1 class="display-1 text-center"><i class="fas fa-users"></i></h1>
                                    <h4 class="text-center text-uppercase">Список клиентов</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
