@extends('layouts.app')

@section('content')
<link href="{{ asset('css/categories-index-backend.css') }}" rel="stylesheet">
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-2">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase pb-4">Категории новостей</h2>     
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 py-2">
                                    <h3>Список категорий</h3>
                                    <ul class="list-group" id="tree1">
                                        @foreach($parentCategories as $category)
                                            <li class="list-group-item">
                                                <a href="{{route('admin.recordsCategories.edit', $category->id)}}">{{ $category->title }}</a>
                                                @if(count($category->childs))
                                                    @include('admin.records-categories.shared.categories-index-childs',['childs' => $category->childs])
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6 py-2">
                                    <h3>Добавить новую категорию</h3>
                                    {!! Form::open(['route'=>'admin.recordsCategories.store', 'files' => true]) !!}
                                        <div class="form-group">
                                            {!! Form::label('title', 'Название категории:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('title', old('title'), ['placeholder'=>'Название категории'] + ($errors->has('title') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('parent_id', 'Родительськая категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::select('parent_id',$allCategories, old('parent_id'), ['placeholder'=>'Выбрать категорию'] + ($errors->has('parent_id') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('short_description', 'Краткое описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('short_description', old('short_description'), ['placeholder'=>'Краткое описание'] + ($errors->has('short_description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('photo', 'Вибрать фото категории:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::file('photo', ($errors->has('photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('titleSEO', 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('titleSEO', old('titleSEO'), ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('titleSEO') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('descriptionSEO', 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('descriptionSEO', old('descriptionSEO'), ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('descriptionSEO') }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('keywordsSEO', 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('keywordsSEO', old('keywordsSEO'), ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('keywordsSEO') }}</span>
                                        </div>
                                        {!! Form::submit('Добавить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('js/categories-index-backend.js') }}"></script>
@endsection