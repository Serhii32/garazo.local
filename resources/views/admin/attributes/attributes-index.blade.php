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
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase pb-4">Характеристики товаров</h2>     
                    <div>
                        @if(count($attributesNames))
                            <div class="container-fluid">
                                <div class="row border">
                                    <div class="col-md-4 py-2 border-right">
                                        <h4 class="font-weight-bold">Название</h4>
                                    </div>
                                    <div class="col-md-8 py-2">
                                        <h4 class="font-weight-bold">Значения</h4>
                                    </div>
                                </div>
                                @foreach($attributesNames as $attributesName)
                                    <div class="row border">
                                        <div class="col-md-4 py-2 border-right">
                                            <h4><a class="card-link text-dark" href="{{route('admin.attributes.edit', $attributesName->id)}}">{{$attributesName->name}}</a></h4>
                                        </div>
                                        <div class="col-md-8 py-2">
                                            @foreach($attributesName->values()->get() as $attributesValue)
                                                <h4 class="text-dark">{{$attributesValue->value}}</h4>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection