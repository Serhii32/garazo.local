<header>
	<div class="container-fluid">
	  	<div class="row">
	    	<div class="col-12 col-md-3 text-center">
				<a href="{{route('page.index')}}"><img class="img-fluid" src="{{asset('img/common/logo.png')}}" alt="Garazo"></a>
	    	</div>
	    	<div class="col-12 col-md-9">
	    		<div class="row">
	    			<div class="col-12 col-md-6">
						<h4 class="text-center p-4">Мойки самообслуживания</h4>
	    			</div>
	    			<div class="col-12 col-md-6">
	    				{!! Form::open(['route' => 'page.search', 'class' => 'form-inline p-3 input-group-btn search-panel row']) !!}
							{!! Form::text('searchPhrase', '', ['class' => 'form-control col-12 col-sm-11 col-md-10 rounded-0', 'placeholder' => 'Поиск']) !!}
							{!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-default col-12 col-sm-1 col-md-2 rounded-0']) !!}
    					{!! Form::close() !!}
	    			</div>
	    		</div>
	    		<nav class="navbar navbar-expand-lg navbar-light py-4">
				  	<button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>

				  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
					    <ul class="navbar-nav m-auto">
					      	<li class="nav-item active">
					        	<a class="nav-link" href="#">Главная</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">Товары и услуги</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">О нас</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">Контакты</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">Доставка и оплата</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">Новости</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link" href="#">Акции</a>
					      	</li>
					    </ul>
				  	</div>
				</nav>
	    	</div>
	    </div>
	</div>
</header>