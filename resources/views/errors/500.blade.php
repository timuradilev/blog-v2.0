@extends('app')
@section('title')
Ошибка сервера
@stop
@include('components.static_header')
@section('content')
<div class="error_page">
	<h2>Упс... Что-то пошло не так.</h2>
	<a href="/" class="btn btn-light">Вернуться на главную</button>
</div>
@stop