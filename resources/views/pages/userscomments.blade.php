@extends('user')
@section('title')
Комментарии пользователя
@endsection
@section('u_content')
<ul class="comments_list list-unstyled" id="comments_list">
    @foreach($comments as $comment)
        <div class="comment">
            <div class="comment_head">
                <strong>{{ $comment->author }}</strong> {{ $comment->created_at }}
            </div>
            <div class="comment_content">
                {{ $comment->content }}
            </div>
            <div class="comment_posted_where">
                <span>Опубликован: </span>
                <a href="{{ action('ArticlesController@show', [$comment->article_id]) }}">{{ $comment->title }}</a>
            </div>
        </div>
        <hr>
    @endforeach
</ul>
@endsection