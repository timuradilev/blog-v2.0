<div class="container">
	<div class="d-flex mt-3 mb-3">
		<div class="mr-auto">
			<a class="h4" href="/">Блог</a>
		</div>
		@if (Auth::check())
                    <a class="btn btn-secondary mr-3" href="{!! action('ArticlesController@makeRandomArticle') !!}">Random</a>
                    <a class="btn btn-secondary mr-3" href="{!! action('ArticlesController@create') !!}">Написать</a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{!! route('user.profile', [Auth::id()]) !!}">Статьи</a>
                        <a class="dropdown-item" href="{!! action('CommentsController@showUsersComments', [Auth::id()]) !!}">Комментарии</a>
                        <div class="dropdown-divider"></div>
                        <form action="{!! action('Auth\LoginController@logout') !!}" method="post" class="d-inline">
                            @csrf
                            <button class="dropdown-item btn btn-link">Выйти</button>
                        </form>
                    </div>
                </div>
		@else
                <a class="btn btn-warning float-right" href="{!! action('Auth\RegisterController@showRegistrationForm') !!}">Регистрация</a>
                <a class="btn btn-info float-right ml-3" href="{!! action('Auth\LoginController@showLoginForm') !!}">Войти</a>
		@endif
	</div>
</div>
<hr>