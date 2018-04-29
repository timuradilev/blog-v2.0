@extends('app')

@section('title')
Создать статью
@stop

@section('content')
@include('components.full_header')
<div class="container">
    <h4>Разместить статью</h4>
    <form action="{!! action('ArticlesController@store') !!}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Название статьи" autofocus autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea name="content" class="form-control" id="content" rows="15" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Опубликровть</button>
    </form>
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>
@stop