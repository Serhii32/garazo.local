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
                    <h2 class="text-center font-weight-bold text-uppercase">Список пользователей</h2>
                    @if(count($users))
                        <div class="container">
                            @foreach($users as $user)
                                <div class="row my-3 h-100 shadow p-2 bg-white">
                                    <div class="col-12 col-md-3">
                                        <div class="text-center">
                                            <img class="img-fluid img-thumbnail my-2" src="{{$user->avatar ? asset($user->avatar) : asset('img/common/avatars/default.png')}}" alt="{{$user->name}}">
                                        </div>
                                        {!! Form::open(['route'=> ['admin.users.destroy', $user->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0', 'method' => 'delete', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <h4 class="text-left text-uppercase">Имя: {{$user->name}}</h4>
                                        <h4 class="text-left" style="word-break: break-word;"><span class="text-uppercase">Email:</span> {{$user->email}}</h4>
                                        <h4 class="text-left text-uppercase">Телефон: {{$user->phone}}</h4>
                                        <a class="btn btn-primary mt-auto mx-auto text-uppercase font-weight-bold" href="{{route('admin.users.show', $user->id)}}">Показать заказы</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$users->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Пользователи отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
