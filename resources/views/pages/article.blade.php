@extends('app')

@section('title')
Статья
@stop

@section('content')
@include('components.full_header')
<div class="container">
    <h4>{{ $article->title }}</h4>
    <h6 class="text-secondary">Автор статьи {{ $article->authoruid }}. Создал {{ $article->created_at }}</h6>
    <br>
    <p>{{ $article->content }}</p>
    <hr>
    @if($article->authoruid == Auth::id())
    <a class="btn btn-outline-secondary" href="{!! action('ArticlesController@edit', [$article->id]) !!}">Редактировать</a>
    <form action="{!! action('ArticlesController@destroy', [$article->id]) !!}" method="post" class="d-inline">
        @method('DELETE')
        @csrf
        <button class="btn btn-outline-danger">Удалить</button>
    </form>
    @endif
</div>
@stop