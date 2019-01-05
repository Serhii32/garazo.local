@extends('layouts.app')
@section('content')
	@include('shared.front-header')
	<main class="py-4">
		<div class="container">
			<div class="row">
				@include('shared.sidebar')
				<div class="col-12 col-md-8 col-lg-9">

					<div class="text-dark font-weight-bold text-uppercase">{{ Breadcrumbs::render('page.contacts') }}</div>

					<div class="row">
						<div class="col-12 col-md-6 col-lg-4">
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Адрес: г. Винница, ул. Пирогова 151,е</h5>
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Телефон: 067&nbsp;430&nbsp;69&nbsp;18</h5>
							<h5 class="text-dark font-weight-bold text-uppercase p-4">Email: garazo@i.ua</h5>
						</div>
						<div class="col-12 col-md-6 col-lg-8">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d651.6276493261981!2d28.427332829271926!3d49.20984299870771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDnCsDEyJzM1LjQiTiAyOMKwMjUnNDAuNCJF!5e0!3m2!1suk!2sua!4v1543582865845" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	@include('shared.front-footer')
@endsection