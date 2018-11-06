<div class="col-12 col-md-3 ">
    <div class="m-2 bg-white border border-light shadow rounded">
        <a href="{{route('page.index')}}">
            <img class="img-fluid py-3 px-5" src="{{asset('img/common/logo.png')}}" alt="Garazo">
        </a>
    </div>
    <div class="m-2 bg-white border border-light shadow rounded">
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.products.index')}}">Список товаров</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.products.create')}}">Добавить товар</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.attributes.index')}}">Характеристики товаров</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.productsCategories.index')}}">Категории товаров</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.records.index')}}">Список новостей</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.records.create')}}">Добавить новость</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.recordsCategories.index')}}">Категории новостей</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.orders.index')}}">Список заказов</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.users.index')}}">Список клиентов</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.pagesSEO.index')}}">SEO теги страниц</a>
            </li>
            <li class="list-group-item list-group-item-action p-0">
                <a class="nav-link text-dark font-weight-bold text-uppercase text-center" href="{{route('admin.uploaded-images.index')}}">Загруженные изображения</a>
            </li>
        </ul>
    </div>
</div>