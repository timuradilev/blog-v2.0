@extends('app')
@section('title')
Регистрация аккаунта
@endsection
@section('content')
@include('components.full_header')
<div class="container login-register-form">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <h4>Регистрация</h4>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Имя</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-user"></i></div>
                        </div>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="" name="name" required autofocus autocomplete="off" value="{{ old('name') }}">
                        @if($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>Некорректное имя</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="" name="email" autocomplete="off" required value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>Некорректный адрес почты</strong>
                        </span>
                        @endif
                        <small><em>Упрощенная регистрация. Почта не проверяется на принадлежность вам.</em></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                        </div>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="" name="password" autocomplete="off" required>
                        @if($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>Некорретный пароль</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Подтвердите пароль</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                        </div>
                        <input type="password" class="form-control" id="password-confirm" placeholder="" name="password_confirmation" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>	
@endsection
