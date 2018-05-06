@extends('app')

@section('title')
Блог
@stop

@section('content')

@include('components.full_header')
<div class="container">
    
    @foreach ($articles as $art)
    <h4><a class="article_title_link" href='{{ action('ArticlesController@show', [$art->id]) }}'>{{ $art->title }}</a></h4>

    <h6 class="text-secondary">Автор статьи {{ $art->author }}. Создал {{ $art->created_at }}</h6>

    <br>
    <p>{{ $art->content }}</p>
    <hr> <br />
    @endforeach

</div>
@stop
