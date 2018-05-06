@extends('app')
@section('title')
Восстановление пароля
@endsection
@section('content')
@include('components.full_header')
<div class="container login-register-form">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <h5>Восстановление пароля</h5>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{!! route('password.email') !!}">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="" name="email" value="{{ old('email') }}" autofocus required>
                        @if($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection
