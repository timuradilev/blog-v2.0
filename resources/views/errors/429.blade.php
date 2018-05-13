@extends('app')
@section('title')
Ошибка 429
@stop
@include('components.static_header')
@section('content')
<div class="error_page">
    <h2>Слишком много запросов</h2>
    <h6>Попробуйте повторить через 60 секунд</h6>
    <a href="/" class="btn btn-light">Вернуться на главную</button>
</div>
@stop