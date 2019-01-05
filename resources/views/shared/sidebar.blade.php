<div class="col-12 col-md-4 col-lg-3">
    <div class="m-2 mb-4 bg-white border border-light shadow rounded">
    	<h5 class="text-dark font-weight-bold text-uppercase text-center p-4 mb-0 styled-background">Товары и услуги</h5>

        <ul class="list-group list-group-flush">
            <h4 class="text-dark text-uppercase px-4 mb-0 text-center styled-background">067-430-69-18</h4>
        	@foreach($productsCategories as $productsCategory)
				<li class="list-group-item p-2 styled-background">
	                <a class="card-link text-dark font-weight-bold" href="{{route('page.products-category', $productsCategory->id)}}">{{$productsCategory->title}} </a>
	                @if(count($productsCategory->childs))
		                <a class="float-right" data-toggle="collapse" href="#c{{$productsCategory->id}}"><i data-toggle="collapse" class="fas fa-angle-down"></i></a>
		                @include('shared.sidebar-subcategories', ['childs' => $productsCategory->childs, 'idNumber' => $productsCategory->id])
	                @endif
	            </li>
        	@endforeach

        </ul>
    </div>
    <div class="m-2 my-4 bg-white border border-light shadow rounded">
    	<h5 class="text-dark font-weight-bold text-uppercase text-center p-4 mb-0 styled-background">Контакты</h5>
    	<h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background"><i class="fas fa-home"></i> Компания</h6>
    	<h6 class="text-dark text-uppercase px-4 mb-0 styled-background">Garazo - Мойки самообслуживания</h6>
    	<h6 class="text-dark font-weight-bold text-uppercase px-4 pt-4 mb-0 styled-background"><i class="fas fa-map-marker-alt"></i> Адрес</h6>
    	<h6 class="text-dark text-uppercase px-4 mb-0 styled-background">Украина г. Винница, ул. Пирогова 151,е</h6>
    	<h6 class="text-dark font-weight-bold text-uppercase px-4 pt-4 mb-0 styled-background"><i class="fas fa-phone"></i> Телефон</h6>
    	<h6 class="text-dark text-uppercase px-4 mb-0 styled-background">067-430-69-18</h6>
    	<h6 class="text-dark font-weight-bold text-uppercase px-4 pt-4 mb-0 styled-background"><i class="fas fa-envelope"></i> Email</h6>
    	<h6 class="text-dark text-uppercase px-4 mb-0 styled-background pb-4">garazo@i.ua</h6>
    </div>
    <div class="m-2 my-4 bg-white border border-light shadow rounded">
        <h5 class="text-dark font-weight-bold text-uppercase text-center p-4 mb-0 styled-background">График работы</h5>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Понедельник <span class="float-right">09:00-17:00</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Вторник <span class="float-right">09:00-17:00</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Среда <span class="float-right">09:00-17:00</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Четверг <span class="float-right">09:00-17:00</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Пятница <span class="float-right">09:00-17:00</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background">Суббота <span class="float-right">Выходной</span></h6>
        <h6 class="text-dark font-weight-bold text-uppercase px-4 mb-0 styled-background pb-4">Воскресенье <span class="float-right">Выходной</span></h6>
    </div>
</div>