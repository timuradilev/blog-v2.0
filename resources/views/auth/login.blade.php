@extends('app')
@section('title')
Вход
@endsection
@section('content')
@include('components.full_header')
<div class="container login-register-form">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <h4>Вход</h4>
            <form method="POST" action="{!! route('login') !!}">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                        </div>
                        <input type="password" class="form-control" id="password" placeholder="" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Войти</button>
                    <a class="btn btn-link" href="{!! route('password.request') !!}">Забыли пароль?</a>
                </div>
            </form>
            @if ($errors->has('email') || $errors->has('password'))
            <span class="invalid-feedback mb-3 d-block">
                <strong>@lang('auth.failed')</strong>
            </span>
            @endif
        </div>
    </div>
</div> 
@endsection
