@extends('user')

@section('title')
Статьи пользователя
@stop

@section('u_content')
    @include('components.showarticles')
    {{ $articles->links('components.pagination', ['route' => route('user.profile', [$userId]), 'postfix' => '']) }}
@endsection