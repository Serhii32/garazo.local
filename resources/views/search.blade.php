@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container-fluid">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">
					{{ $searchPhrase }}
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection