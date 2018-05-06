@extends('app')
@section('title')
Изменение пароля
@endsection
@section('content')
@include('components.full_header')
<div class="container login-register-form">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <h4>Изменение пароля</h4>
            <form method="POST" action="{!! route('password.request') !!}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="" name="email" value="{{ $email ?? old('email') }}" autofocus required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                        </div>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
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
                        <input type="password" class="form-control" id="password-confirm" placeholder="" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Поменять пароль</button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection
