@extends('layouts.app')

@section('content')
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
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.records.update', $record->id], 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">SEO характеристика страниц</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    {!! Form::label('titleSEO', 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::text('titleSEO', $record->titleSEO, ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                    <span class="text-danger">{{ $errors->first('titleSEO') }}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('descriptionSEO', 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::textarea('descriptionSEO', $record->descriptionSEO, ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                    <span class="text-danger">{{ $errors->first('descriptionSEO') }}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('keywordsSEO', 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::text('keywordsSEO', $record->keywordsSEO, ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                    <span class="text-danger">{{ $errors->first('keywordsSEO') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Основная часть:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('description', $record->description, ['id'=>'editor'] + ($errors->has('description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection