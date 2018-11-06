@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					@if(count($records))
						<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">Новости</h3>
						<div class="container">
							<div class="row justify-content-center">
	                            @foreach($records as $record)
	                                <div class="my-3">
	                                    <div class="p-3 shadow row">
	                                    	<div class="col-12 col-sm-4 col-md-3">
	                                    		<a class="card-link text-secondary" href="{{route('page.record', $record->id)}}">
		                                            <div class="text-center">
		                                            	<img class="img-fluid img-thumbnail" src="{{$record->main_photo ? asset($record->main_photo) : asset('img/common/default.png')}}" alt="{{ $record->title }}">
		                                            </div>
		                                            
		                                        </a>
	                                    	</div>
	                                        <div class="col-12 col-sm-8 col-md-9">
	                                        	<a class="card-link text-secondary" href="{{route('page.record', $record->id)}}">
		                                        	<h4 class="text-center text-uppercase">{{$record->title}}</h4>
		                                        </a>
		                                        <p>
		                                        	{{$record->short_description}}
		                                        </p>
	                                        </div>
	                                    </div>
	                                </div>
	                            @endforeach
	                        </div>
	                        <div class="custom-links py-4">{{$records->links()}}</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection