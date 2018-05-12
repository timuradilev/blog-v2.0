@extends('app')
@section('title')
Ошибка 404
@stop
@include('components.static_header')
@section('content')
<div class="error_page">
    <h2>Страница не найдена</h2>
    <a href="/" class="btn btn-light">Вернуться на главную</button>
</div>
@stop