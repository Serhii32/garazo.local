@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					<div class="container">
                        <div class="my-3 card h-100 shadow p-2">
                            <img class="img-fluid img-thumbnail" src="{{$record->main_photo ? asset($record->main_photo) : asset('img/common/default.png')}}" alt="{{ $record->title }}">
                        </div>
                        <div class="my-3">
                            <h4 class="text-center">{{$record->title}}</h4>
                            <p class="m-2 text-justify text-secondary" style="font-size: 20px;">{{$record->short_description}}</p>
                        </div>
                        <div class="text-secondary item-description m-2" style="font-size: 20px;">
                        	{!! $record->description !!}
                        </div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection