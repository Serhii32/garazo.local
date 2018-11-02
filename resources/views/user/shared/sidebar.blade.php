<div class="col-12 col-md-3 ">
    <div class="m-2 bg-white border border-light shadow rounded">
        <a href="{{route('page.index')}}">
            <img class="img-fluid py-3 px-5" src="{{asset('img/common/logo.png')}}" alt="Garazo">
        </a>
    </div>
    <div class="m-2 bg-white border border-light shadow rounded">
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('user.home.index')}}">Страница пользователя</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('user.home.edit')}}">Настройни профиля</a>
            </li>
        </ul>
    </div>
</div>