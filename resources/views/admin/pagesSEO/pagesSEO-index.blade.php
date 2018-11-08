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
                    {!! Form::open(['route'=> 'admin.pagesSEO.update', 'method' => 'put']) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">SEO характеристика страниц</h2>
                        <div class="container-fluid">
                        	@foreach($pages as $page)
                        		<div class="card p-5 mb-3">
									<h4 class="text-uppercase font-weight-bold pt-2 text-center">{{$page->page}}</h4>
	                                <div class="form-group">
	                                    {!! Form::label('titleSEO_'.$page->id, 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                    {!! Form::text('titleSEO_'.$page->id, $page->titleSEO, ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                    <span class="text-danger">{{ $errors->first('titleSEO_'.$page->id) }}</span>
	                                </div>
	                                <div class="form-group">
	                                    {!! Form::label('descriptionSEO_'.$page->id, 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                    {!! Form::textarea('descriptionSEO_'.$page->id, $page->descriptionSEO, ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                    <span class="text-danger">{{ $errors->first('descriptionSEO_'.$page->id) }}</span>
	                                </div>
	                                <div class="form-group">
	                                    {!! Form::label('keywordsSEO_'.$page->id, 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
	                                    {!! Form::text('keywordsSEO_'.$page->id, $page->keywordsSEO, ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
	                                    <span class="text-danger">{{ $errors->first('keywordsSEO_'.$page->id) }}</span>
	                                </div>
                                </div>
                            @endforeach
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