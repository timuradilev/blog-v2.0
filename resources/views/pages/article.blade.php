@extends('app')

@section('title')
Статья
@stop

@section('content')
@include('components.full_header')
<div class="container">
    <h4 class="article_title">{{ $article->title }}</h4>
    <h6 class="text-secondary">Автор статьи <a href="{{ action('ArticlesController@showUsersArticles', [$article->authoruid]) }}">{{ $article->author }}</a>. Создал в {{ $article->created_at }}</h6>
    <br>
    <p>{{ $article->content }}</p>
    @if($article->authoruid == Auth::id())
    <div>
        <a class="btn btn-outline-secondary" href="{!! action('ArticlesController@edit', [$article->id]) !!}">Редактировать</a>
        <form action="{!! action('ArticlesController@destroy', [$article->id]) !!}" method="post" class="d-inline">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-danger">Удалить</button>
        </form>
    </div>
    <br>
    @endif
    <hr>
    <header class="comments_header">
        <span class="h5 comments_header_title">Комментарии <span class="comments_header_count" id="comments_count"></span></span>
    </header>
    <ul class="comments_list list-unstyled" id="comments_list">
    </ul>
</div>
<script>
    $(function (){
        console.log("begin");
        var pathname = window.location.pathname.split('/');
        var action = pathname[1];
        var id = pathname[2];

        if(action !== 'article' || isNaN(id))
            return;

        $.get("/article/" + id + "/comments", function(comments) {
            console.log(comments);
            $("#comments_count").html(comments.length);
            $.each(comments, function(key, rawComment){
                var comment = '<div class="comment">' +
                                '<div class="comment_head">' +
                                    '<span>Написал </span><a href="/user/' + rawComment.user_id +  '">' + 
                                    rawComment.author + '</a><span> в </span><time>' + rawComment.created_at + '</time>' +
                                '</div>' +
                                '<div class="comment_content">' +
                                    escapeHtml(rawComment.content) + 
                                '</div>' +
                               '</div>';
                $("#comments_list").append(comment);
            });
        });
        console.log("end");
    });
</script>
@stop