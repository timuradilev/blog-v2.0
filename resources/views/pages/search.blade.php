@extends('app')
@section('title')
Результаты поиска по запросу "{{ $q }}"
@stop
@section('content')
@include('components.full_header')
<div class="container">
    <form action="{{ route('search') }}" method="GET">
        <div class="form-group">
            <div class="input-group">
                <input value="{{ $q }}" class="form-control" type="text" name="q" placeholder="Поиск" aria-label="Поиск">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    @include('components.showarticles')
    @if (!empty($q))
        @if ($articles->isEmpty())
            <div class="text-secondary">
                К сожалению, ничего не нашлось.
            </div>
        @else
            {{ $articles->links('components.pagination', ['route' => route('search'), 'postfix' => "?q=$q"]) }}
        @endif
    @endif
</div>
@stop