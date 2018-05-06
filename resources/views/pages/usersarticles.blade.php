@extends('user')

@section('title')
Статьи пользователя
@stop

@section('u_content')
    @include('components.showarticles')
@endsection