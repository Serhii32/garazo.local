@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-2">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.recordsCategories.update', $category->id], 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $category->title }}</h2>
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
                                        {!! Form::label('short_description', 'Краткое описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::textarea('short_description', $category->short_description, ['placeholder'=>'Краткое описание'] + ($errors->has('short_description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('parent_id', 'Родительськая категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::select('parent_id',$allCategories, $category->parent_id, ['placeholder'=>'Вибрать категорию'] + ($errors->has('parent_id') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('titleSEO', 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('titleSEO', $category->titleSEO, ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('titleSEO') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('descriptionSEO', 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::textarea('descriptionSEO', $category->descriptionSEO, ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('descriptionSEO') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('keywordsSEO', 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('keywordsSEO', $category->keywordsSEO, ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('keywordsSEO') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.recordsCategories.destroy', $category->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    @if(count($records))
                        <h3 class="text-center font-weight-bold text-uppercase p-2 mt-5">Новости в данной категории</h3>
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                @foreach($records as $record)
                                    {!! Form::open(['route'=> ['admin.recordsCategories.removeRecordFromCategory', $record->id], 'method' => 'delete', 'class' => 'col-12 col-sm-6 col-md-4 col-lg-3 my-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}

                                        <div class="card h-100 shadow p-2">
                                            <a class="card-link text-secondary p-1" href="{{route('admin.records.edit', $record->id)}}">
                                                <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$record->main_photo ? asset($record->main_photo) : asset('img/common/default.png')}}" alt="{{ $record->title }}"></div>
                                                <h4 class="text-center text-uppercase">{{$record->title}}</h4>
                                            </a>
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-75 text-uppercase font-weight-bold']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                @endforeach
                            </div>
                            <div class="custom-links py-4">{{$records->links()}}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection