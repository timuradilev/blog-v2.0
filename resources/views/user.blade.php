@extends('app')

@section('content')
    @include('components.full_header')
    <div class="container">

        <h3>Пользователь <a class="user-name" href="{!! action('ArticlesController@showUsersArticles', [$userId]) !!}">{{ $userName }}</a></h3>

        <div class="h4 d-inline">
            <a class="menu-link text-uppercase font-weight-bold
                @if ($action == 'showArticles')
                    menu-link-active
                @endif
               " href="{!! action('ArticlesController@showUsersArticles', [$userId]) !!}">Статьи</a>
        </div> 
        <div class="h4 d-inline">
            <a class="menu-link text-uppercase font-weight-bold
               @if ($action == 'showComments')
                    menu-link-active
                @endif
               " href="{!! action('CommentsController@showUsersComments', [$userId]) !!}">Комментарии</a>
        </div>

        <hr class="mb-4">
        @yield('u_content')
    </div>
@endsection