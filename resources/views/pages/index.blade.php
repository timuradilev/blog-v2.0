@extends('app')

@section('title')
Блог
@stop

@section('content')

@include('components.full_header')
<div class="container">
    @include('components.showarticles')
    {{ $articles->links('components.pagination', ['prefix' => '']) }}
</div>
{{--@include('components.pagination') --}}
@stop
