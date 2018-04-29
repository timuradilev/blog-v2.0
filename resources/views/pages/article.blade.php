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
    <br>
</div>
@stop