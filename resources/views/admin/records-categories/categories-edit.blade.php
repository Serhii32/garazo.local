@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                <h2 class="text-center font-weight-bold text-uppercase">Редактировать {{ $category->title }}</h2>
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.productsCategories.update', $category->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$category->photo ? asset($category->photo) : asset('img/common/default.png')}}" alt="{{ $category->title }}">
                                    <div class="form-group">
                                        {!! Form::label('photo', 'Вибрать фото категории:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('photo', ($errors->has('photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Название категории:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('title', $category->title, ['placeholder'=>'Название категории'] + ($errors->has('title') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('parent_id', 'Родительськая категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::select('parent_id',$allCategories, $category->parent_id, ['placeholder'=>'Вибрать категорию'] + ($errors->has('parent_id') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.productsCategories.destroy', $category->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    @if(count($products))
                        <h3 class="text-center p-2 m-5">Товары в данной категории</h3>
                        <div class="container">
                            <div class="row">
                                @foreach($products as $product)
                                    {!! Form::open(['route'=> ['admin.productsCategories.removeProductFromCategory', $product->id, 'blog'], 'method' => 'delete', 'class' => 'col-12 mb-3 border-bottom', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                        <h4 class="d-inline-block">{{$product->title}}</h4>
                                        {!! Form::submit('Удалить', ['class'=>'btn btn-danger float-right text-uppercase font-weight-bold']) !!}
                                    {!! Form::close() !!}
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection