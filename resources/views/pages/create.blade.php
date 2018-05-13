@extends('app')

@section('title')
Создать статью
@stop
@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop
@section('content')
@include('components.full_header')
<div class="container">
    <h4>Разместить статью</h4>
    <form action="{!! action('ArticlesController@store') !!}" method="POST" id="form">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Название статьи" value="{{ old('title') }}" autofocus autocomplete="off" required>
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
            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" rows="15" required>{{ old('content') }}</textarea>
            @if($errors->has('content'))
            <ul class="invalid-feedback">
                @foreach ($errors->get('content') as $message)
                    <li><strong>{{ $message }}</strong></li>
                @endforeach
            </ul>
            @endif
        </div>
        <button type="submit" class="btn btn-success g-recaptcha" data-sitekey="{{ env('SETTINGS_GOOGLE_RECAPTCHA_SITE_KEY') }}" data-callback='reCAPTCHASubmitButton'>Опубликовать</button>
        @if ($errors->has('recaptcha'))
            <div class="text-danger d-inline">{{ $errors->first('recaptcha') }}</div>
        @endif
    </form>
</div>
@stop