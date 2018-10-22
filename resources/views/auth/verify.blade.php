@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center font-weight-bold text-uppercase">Подтвердите ваш E-mail адресс</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Новая ссылка для подтверждения была отправлена на ваш E-mail адресс
                            </div>
                        @endif
                        
                        <p class="text-justify">Перед тем, как продолжить работу на сайте, нужно пройти проверку E-mail адреса, пройдите по ссылке, которая была отправлена на указанный вами E-mail адресс.</p>

                        <p class="text-justify">Если письмо не пришло, проверьте папку спам или кликните <a href="{{ route('verification.resend') }}">здесь</a> для запроса нового письма.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
