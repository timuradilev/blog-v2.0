<div class="container bg-dark">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Adilev</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form action="{{ route('search') }}" class="mr-3 search-form" id="search-form">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="btn btn-info btn-disabled"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Поиск" name="q">
                    <div class="input-group-append">
                        <span class="btn btn-info" id="search-button-close"><i class="fas fa-times"></i></span>
                    </div>
                    <button type="submit" class="btn btn-info d-none">Поиск</button>
                </div>
            </form>
            <ul class="navbar-nav ml-auto" id="full_header-navbar-items">
                <li class="nav-item" id="search-button">
                    <button type="button" class="btn btn-link btn-search"><i class="fas fa-search" id=""></i></button>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="btn btn-outline-info mr-3" href="{!! action('ArticlesController@makeRandomArticle') !!}">Random</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-info mr-3" href="{!! action('ArticlesController@create') !!}">Написать</a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" style="" href="{!! route('user.profile', [Auth::id()]) !!}">Статьи</a>
                            <a class="dropdown-item" href="{!! action('CommentsController@showUsersComments', [Auth::id()]) !!}">Комментарии</a>
                            <div class="dropdown-divider"></div>
                            <form action="{!! action('Auth\LoginController@logout') !!}" method="post" class="d-inline">
                                @csrf
                                <button class="dropdown-item btn btn-link">Выйти</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-warning mr-3" href="{!! action('Auth\RegisterController@showRegistrationForm') !!}">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info" href="{!! action('Auth\LoginController@showLoginForm') !!}">Войти</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<hr>

