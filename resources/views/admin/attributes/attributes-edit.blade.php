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
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase pb-4">Характеристика</h2>
                    <div class="container-fluid">
                        <div class="row">
                            {!! Form::open(['route'=>['admin.attributes.update', $attributesName->id], 'method'=>'put', 'class'=>'w-100 mb-3']) !!}
                                <div class="form-group">
                                    {!! Form::label('name', 'Название характеристики:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::text('name', $attributesName->name, ['placeholder'=>'Название характеристики', 'autofocus' => 'autofocus'] + ($errors->has('name') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                
                                {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route'=>['admin.attributes.destroy', $attributesName->id], 'method' => 'delete', 'class'=>'w-100', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection