<header>
	<div class="container-fluid">
	  	<div class="row">
	    	<div class="col-12 col-md-3 text-center">
				<a class="card-link text-dark" href="{{route('page.index')}}">
					<img class="img-fluid front-logo" src="{{asset('img/common/logo.png')}}" alt="Garazo">
					<h6 class="text-center m-2 text-uppercase d-inline-block">Мойки самообслуживания</h6>
				</a>
	    	</div>
	    	<div class="col-12 col-md-9">
	    		<div class="row">
	    			<div class="col-12 col-md-6">
						
	    			</div>
	    			<div class="col-12 col-md-6">
	    				{!! Form::open(['route' => 'page.search', 'class' => 'form-inline p-3 input-group-btn search-panel row']) !!}
							{!! Form::text('searchPhrase', '', ['class' => 'form-control col-12 col-sm-11 col-md-10 rounded-0', 'placeholder' => 'Поиск']) !!}
							{!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-default col-12 col-sm-1 col-md-2 rounded-0']) !!}
    					{!! Form::close() !!}
    					{{-- <form class="form-inline" action="/action_page.php">
							<input class="form-control mr-sm-2" type="text" placeholder="Search">
							<button class="btn btn-success" type="submit">Search</button>
						</form> --}}
	    			</div>
	    		</div>
	    		<nav class="navbar navbar-expand-lg navbar-light py-2 px-0">
				  	<button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>

				  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
				  		{{-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  							<ul class="navbar-nav">
							    <li class="nav-item">
							      <a class="nav-link" href="#">Link 1</a>
							    </li>
							    <li class="nav-item">
							      <a class="nav-link" href="#">Link 2</a>
							    </li>
							    <li class="nav-item">
							      <a class="nav-link" href="#">Link 3</a>
							    </li>
							</ul>
						</nav> --}}
					    <ul class="navbar-nav m-auto">
					      	<li class="nav-item active">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Главная</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Товары и услуги</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">О нас</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Контакты</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Доставка и оплата</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Новости</a>
					      	</li>
					      	<li class="nav-item">
					        	<a class="nav-link font-weight-bold text-uppercase" href="#">Акции</a>
					      	</li>
					    </ul>
				  	</div>
				</nav>
	    	</div>
	    </div>
	</div>
</header>