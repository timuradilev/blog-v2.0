@foreach ($articles as $art)
<h4><a class="article_title_link" href='{{ action('ArticlesController@show', [$art->id]) }}'>{{ $art->title }}</a></h4>

<h6 class="text-secondary">Автор статьи <a href="{{ action('ArticlesController@showUsersArticles', [$art->authoruid]) }}">{{ $art->author }}</a>. Создал в {{ $art->created_at }}</h6>

<br>
<p>{{ $art->content }}</p>
<hr> <br />
@endforeach