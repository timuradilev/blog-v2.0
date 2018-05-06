@extends('app')

@section('title')
Редактировать статью
@stop

@section('content')
@include('components.full_header')
<div class="container">
    <h4>Редактировать статью</h4>
    <form action="{!! action('ArticlesController@update', [$article->id]) !!}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" autofocus autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea name="content" class="form-control" id="content" rows="15" required>{{ $article->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
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