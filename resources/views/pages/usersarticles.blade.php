@extends('user')

@section('title')
Статьи пользователя
@stop

@section('u_content')
    @include('components.showarticles')
    {{ $articles->links('components.pagination', ['prefix' => 'user/'.$userId.'/', 'postfix' => '']) }}
@endsection