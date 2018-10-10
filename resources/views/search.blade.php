@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		{{ $searchPhrase }}
	</main>
	@include('shared.front-footer')
@endsection