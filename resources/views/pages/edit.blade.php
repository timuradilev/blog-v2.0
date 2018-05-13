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
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $article->title }}" autofocus autocomplete="off" required>
            @if($errors->has('title'))
            <ul class="invalid-feedback">
                @foreach ($errors->get('title') as $message)
                    @if ($message === 'The format is invalid.')
                        <li><strong>@lang('messages.title')</li></strong>
                    @else
                        <li><strong>{{ $message }}</strong></li>
                    @endif
                @endforeach
            </ul>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" rows="15" required>{{ $article->content }}</textarea>
            @if($errors->has('content'))
            <ul class="invalid-feedback">
                @foreach ($errors->get('content') as $message)
                    <li><strong>{{ $message }}</strong></li>
                @endforeach
            </ul>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>
@stop