@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
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
                    <h2 class="text-center font-weight-bold text-uppercase">Список новостей</h2>
                    @if(count($records))
                        <div class="row justify-content-center">
                            @foreach($records as $record)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                                    <div class="card h-100 shadow p-2">
                                        <a class="card-link text-secondary p-1" href="{{route('admin.records.edit', $record->id)}}">
                                            <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$record->main_photo ? asset($record->main_photo) : asset('img/common/default.png')}}" alt="{{ $record->title }}"></div>
                                            <h4 class="text-center text-uppercase">{{$record->title}}</h4>
                                        </a>
                                        {!! Form::open(['route'=> ['admin.records.destroy', $record->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0', 'method' => 'delete', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$records->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Новости отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
