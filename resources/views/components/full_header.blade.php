<div class="container">
	<div class="row align-items-center mt-3 mb-3">
		<div class="col-sm-4">
			<a class="h4" href="/">Блог</a>
		</div>
		@if (Auth::check())
		<div class="col-sm-5">
			<!--<a class="btn btn-info" href="newarticle.php?action=random">Random</a> -->
			<a class="btn btn-dark" href="{!! action('ArticlesController@create') !!}">Написать</a>
		</div>
		<div class="col-sm-3">
			<span class="h4 btn">{{ Auth::user()->name }}</span>
                        <form action="{!! action('Auth\LoginController@logout') !!}" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-warning float-right">Выйти</button>
                        </form>
		</div>
		@else
		<div class="col-sm-8">
			<a class="btn btn-dark float-right" href="{!! action('Auth\RegisterController@showRegistrationForm') !!}">Регистрация</a>
			<a class="btn btn-info float-right mr-2" href="{!! action('Auth\LoginController@showLoginForm') !!}">Войти</a>
		</div>
		@endif
	</div>
</div>
<hr>