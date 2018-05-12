@extends('app')

@section('title')
Статья
@stop

@section('content')
@include('components.full_header')
<div class="container">
    <h4 class="article_title">{{ $article->title }}</h4>
    <h6 class="text-secondary">Автор статьи <a href="{{ route('user.profile', [$article->authoruid]) }}">{{ $article->author }}</a>. Создал в {{ $article->created_at }}</h6>
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
    <div class="comments_section" id="comments">
        <header class="comments_header">
            <span class="h5 comments_header_title">Комментарии <span class="comments_header_count" id="comments_count"></span></span>
        </header>
        <input type="hidden" id="article_id" value="{{ $article->id }}">
    </div>
    @if(Auth::check())
    <div class="comment_form" id="comment_form_section">
        <div class="comment_form_title">
            <span class="comment_form_title_text" onclick="resetCommentForm()">Написать комментарий</span>
        </div>
        <form class="comment_form_content" id="comment_form">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="form-group">
                <textarea type="text" name="content" id="comment_content" class="form-control" cols="30" rows="5" required></textarea>
                <input type="hidden" id="comment_form_article_id" value="{{ $article->id }}">
                <input type="hidden" id="comment_form_parent_id" value="0">
            </div>
            <button type="submit" id="comment_submit" class="btn btn-secondary" disabled>Отправить</button>
            <div class="comment_form_error text-danger" id="comment_form_error">Не удалось создать комментарий</div>
        </form>
    </div>
    @endif
</div>
<script>
    $(function (){
        //track 'content' input in comment form
        $("#comment_content").on('input', function(event){
            var content = $.trim(event.target.value);
            if( content !== "" && content.length <= 1000)
                $("#comment_submit").prop('disabled', false);
            else
                $("#comment_submit").prop('disabled', true);
        });
        //submit comment
        $("#comment_submit").click(function(event){
            event.preventDefault();
            $(".comment_form_send_error").css('display', 'none');
            var content = $.trim($("#comment_content").val());
            var articleId = $("#comment_form_article_id").val();
            var url = "/article/" + articleId + "/comment";
            var parent_id = $("#comment_form_parent_id").val();
            $("#comment_submit").prop('disabled', true);
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                url: url,
                method: 'post',
                dataType: 'json',
                data: { content: content,
                        parent_id: parent_id
                }
            }).done(function(comment){
                showNewComment(comment);
                resetCommentForm();
                $("#comments_count").text(parseInt($("#comments_count").text()) + 1);
            }).fail(function(){
                $("#comment_form_error").css('display', 'block');
            });
        });
        //get and show all comments
        var articleId = $("#article_id").val();
        $.get("/article/" + articleId + "/comments", function(comments) {
            $("#comments_count").html(comments.length);
            showComments(comments);
        });
    });
    function convertCommentToHtml(comment)
    {
        return '<div class="comment"' +
                        'id="comment_' + comment.id + '">' +
                    '<div class="comment_head">' +
                        '<span>Написал </span><a class="comment_user_link" href="/user/' + comment.user_id + '">' + 
                        comment.author + '</a><span> в </span><time>' + comment.created_at + '</time>' +
                    '</div>' +
                    '<div class="comment_content">' +
                        escapeHtml(comment.content) + 
                    '</div>' +
                    '<div class="comment_footer">' +
                        '<a class="comment_reply_link" href="#reply" onclick="showReplyForm(' + comment.id + ')">Ответить</a>' +
                    '</div>' +
                    '<div class="comment_reply_form comment_js_placeholder"></div>' +
                   '</div>';
    }
    function showReplyForm(commentIdToReply)
    {
        $("#comment_form_parent_id").val(commentIdToReply);
        $("#comment_form").detach().appendTo("#comment_" + commentIdToReply + " > .comment_js_placeholder");
        $("#comment_form_section > .comment_form_title > .comment_form_title_text")
                .removeClass('comment_form_title_text').addClass('comment_form_title_text_link');
    }
    function showComments(comments)
    {
        var htmlComments = '<ul class="comments_list list-unstyled" id="comments_list_parent_0" data-nested-level="0">';
        htmlComments += convertRepliesToHtml(comments, 0, 0);
        htmlComments += '</ul>';
        $("#comments").append(htmlComments);
    }
    function convertRepliesToHtml(source, parentId, nestedLevel)
    {
        var result = "";
        var replies = source.filter(com => com.parent_id === parentId);
        var comment_nestedClass = nestedLevel <= 10 ? "comments_nested" : "";
        $.each(replies, function(index, comment) {
            result += convertCommentToHtml(comment);
            result += '<ul class="comments_list list-unstyled ' + comment_nestedClass + '" ' +
                'id="comments_list_parent_' + comment.id + '" ' +
                'data-nested-level="' + (nestedLevel + 1) + '">';
            result += convertRepliesToHtml(source, comment.id, nestedLevel + 1);
            result += '</ul>';
        });
        return result;
    }
    function showNewComment(comment)
    {
        var htmlComment = convertCommentToHtml(comment);
        var nestedLevel = parseInt($("#comments_list_parent_" + comment.parent_id).attr('data-nested-level'));
        var comment_nestedClass = nestedLevel <= 10 ? "comments_nested" : "";
        $("#comments_list_parent_" + comment.parent_id).append(htmlComment);
        var repliesList = '<ul class="comments_list list-unstyled ' + comment_nestedClass +  '" ' +
        'id="comments_list_parent_' + comment.id + '" ' +
        'data-nested-level="' + 
        ( nestedLevel + 1) + 
        '"></ul>';
        $("#comments_list_parent_" + comment.parent_id).append(repliesList);
    }
    function resetCommentForm()
    {
        $("#comment_form_parent_id").val("0");
        $("#comment_content").val("");
        $("#comment_form").detach().appendTo("#comment_form_section");
        $("#comment_form_section > .comment_form_title > .comment_form_title_text_link")
                .removeClass('comment_form_title_text_link').addClass('comment_form_title_text');
    }
</script>
@stop