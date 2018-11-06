<header>
	<div class="container-fluid">
	  	<div class="row">
	    	<div class="col-12 col-md-3 text-center p-2">
				<a class="card-link text-dark" href="{{route('page.index')}}">
					<img class="img-fluid front-logo" src="{{asset('img/common/logo.png')}}" alt="Garazo">
				</a>
	    	</div>
	    	<div class="col-12 col-md-9">
	    		<div class="row">
	    			<div class="col-12 col-md-6 m-auto">
						<h4 class="text-center m-2 text-uppercase text-center">Мойки самообслуживания</h4>
	    			</div>
	    			<div class="col-12 col-md-6">
	    				{!! Form::open(['route' => 'page.search', 'method'=>'get', 'class' => 'form-inline p-3 input-group-btn search-panel row']) !!}
							{!! Form::text('searchPhrase', '', ['class' => 'form-control col-12 col-sm-11 col-md-10 rounded-0', 'placeholder' => 'Поиск']) !!}
							{!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-default col-12 col-sm-1 col-md-2 rounded-0']) !!}
    					{!! Form::close() !!}
	    			</div>
	    		</div>
	    		<nav class="navbar navbar-expand-lg navbar-light pt-5 pb-4 px-0">
				  	<button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>

				  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
					    <ul class="navbar-nav m-auto">
					      	<li class="nav-item @isset($homeActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.index')}}">Главная</a>
					      	</li>
					      	<li class="nav-item @isset($productsActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.products-services')}}">Товары и услуги</a>
					      	</li>
					      	<li class="nav-item @isset($aboutActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.about')}}">О нас</a>
					      	</li>
					      	<li class="nav-item @isset($contactsActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.contacts')}}">Контакты</a>
					      	</li>
					      	<li class="nav-item @isset($deliveryActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.delivery-payment')}}">Доставка и оплата</a>
					      	</li>
					      	<li class="nav-item dropdown @isset($recordsActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase d-inline-block pr-0" href="{{route('page.records')}}">Новости</a>
								@if(count($recordsCategories))
						        	<a class="nav-link dropdown-toggle font-weight-bold text-uppercase d-inline-block pl-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"></a>
						        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						        		@foreach($recordsCategories as $recordsCategory)
									        <a class="dropdown-item font-weight-bold text-uppercase border-bottom" href="{{route('page.records-category', $recordsCategory->id)}}">{{$recordsCategory->title}}</a>
								        @endforeach
							        </div>
						        @endif
					      	</li>

					      	<li class="nav-item @isset($promoActive) active @endisset">
					        	<a class="nav-link font-weight-bold text-uppercase" href="{{route('page.promo-action')}}">Акции</a>
					      	</li>
					    </ul>
				  	</div>
				  	<a class="card-link font-weight-bold text-uppercase text-dark" style="font-size: 25px;" href="{{route('page.cart')}}"><i class="fas fa-shopping-cart"></i> {{Cart::getContent()->count()?:''}}</a>
				</nav>
	    	</div>
	    </div>
	</div>
</header>