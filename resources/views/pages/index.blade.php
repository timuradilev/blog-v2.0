@extends('app')

@section('title')
Блог
@stop

@section('content')

@include('components.full_header')
<div class="container">
    @include('components.showarticles')
    {{ $articles->links('components.pagination', ['route' => route('home'), 'postfix' => '']) }}
</div>
{{--@include('components.pagination') --}}
@stop
