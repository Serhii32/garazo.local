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
                    <h2 class="text-center font-weight-bold text-uppercase">Список загруженных изображений</h2>
                    @if($images->total() != 0)
                        <div class="container">
                            <div class="row row-eq-height justify-content-center">
                                @foreach($images as $image)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                                        <div class="card h-100">
                                            <img class="card-img-top" style="height: 200px; object-fit: contain;" alt="{{$image}}" src="{{ asset($image) }}">
                                            <h5 class="text-center card-title">{{$image}}</h5>
                                            <div class="card-footer">
                                                {!! Form::open(['route'=> ['admin.uploaded-images.destroy', Crypt::encrypt($image)], 'method' => 'DELETE', 'class' => 'w-100', 'onsubmit' => "return confirm('Подтвердить удаление?')"]) !!}
                                                    {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="custom-links py-4">{{$images->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Изображения отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
