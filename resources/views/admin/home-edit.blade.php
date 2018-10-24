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
                    {!! Form::open(['route'=>'admin.home.update', 'method' => 'put', 'class' => 'py-4', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Настройки профиля</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="text-center">
                                        <img class="img-thumbnail img-fluid" src="{{$admin->avatar ? asset($admin->avatar) : asset('img/common/avatars/default.png')}}" alt="{{ $admin->name }}">
                                    </div>
                                    <div class="form-group py-4">
                                        {!! Form::label('avatar', 'Выбрать фото администратора:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('avatar', ($errors->has('avatar') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Имя:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('name', old('name') ? :$admin->name, ['placeholder'=>'Имя'] + ($errors->has('name') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::email('email', old('email') ? old('email') :$admin->email, ['placeholder'=>'Email'] + ($errors->has('email') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Телефон:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::number('phone', old('phone') ? old('phone') :$admin->phone, ['placeholder'=>'Телефон'] + ($errors->has('phone') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('current_password', 'Пароль:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::password('current_password', ['placeholder'=>'Пароль'] + ($errors->has('current_password') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password', 'Новый пароль:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::password('password', ['placeholder'=>'Новый пароль'] + ($errors->has('password') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('password_confirmation', 'Подтвердить пароль:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::password('password_confirmation', ['placeholder'=>'Подтвердить пароль'] + ($errors->has('password_confirmation') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection