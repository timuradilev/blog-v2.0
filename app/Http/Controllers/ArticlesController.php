<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Article;
use App\Http\Requests\CreateArticleRequest;
use App\User;
use App\Tag;
use App\Articletag;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'showUsersArticles']);
        $this->middleware('author')->only(['edit', 'update', 'destroy']);
        $this->middleware('recaptcha')->only(['store']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param int $pageNumber
     * @return \Illuminate\Http\Response
     */
    public function index($pageNumber = 1)
    {
        $pageNumber = (int)$pageNumber; // make sure the pageNumber is integer
        $articles = Article::latest()->paginate(10, ['*'], 'page', $pageNumber); // second and third arguments is just to fill the parameters
        if($pageNumber > $articles->lastPage())
            abort(404);
            
        return view("pages.index")->with('articles', $articles);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateArticleRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $req)
    {
        //save article
        $article = $req->all();
        $article['authoruid'] = Auth::id();
        $article['author'] = Auth::user()->name;
        $newArticle = Article::create($article);
        //save tags
        Tag::saveTags($req->input('tags'), $newArticle->id);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $tags = $article->tags()->get();
        return view("pages.article")->with(['article' => $article, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = $article->tags()->get();
        $tagsTitles = [];
        foreach($tags as $tag)
            $tagsTitles[] = $tag->title;
        
        return view("pages.edit")->with(['article' => $article, 'tags' => implode(', ', $tagsTitles)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        DB::transaction(function() use($article) {
            $article->comments()->delete();
            $article->tagsBonds()->delete();
            $article->delete();
        });
        
        return redirect('/');
    }
    
    /**
     * Generate and store a article with a random title and a content.
     * 
     * @return \Illuminate\Http\Response
     */
    public function makeRandomArticle()
    {
        $loremIpsum = array_map("strip_tags", file("http://loripsum.net/api/1/long/headers", FILE_IGNORE_NEW_LINES));
        
        $article['title'] = $loremIpsum[0];
        $article['content'] = $loremIpsum[2];
        $article['authoruid'] = Auth::id();
        $article['author'] = Auth::user()->name;
        
        $newArticle = Article::create($article);
        $newTag = Tag::firstOrCreate(['title' => 'random']);
        Articletag::create(['article_id' => $newArticle->id, 'tag_id' => $newTag->id]);
        
        return redirect('/');
    }
    
    /**
     * Show the user's articles
     * 
     * @param int $userId
     * @param int $pageNumber
     * @return Illuminate\Http\Response
     */
    public function showUsersArticles($userId, $pageNumber = 1)
    {
        $user = User::findOrFail($userId);
        
        $pageNumber = (int)$pageNumber; // make sure the pageNumber is integer
        $articles = $user->articles()->latest()->paginate(10, ['*'], 'page', $pageNumber); // second and third arguments is just to fill the parameters
        if($pageNumber > $articles->lastPage())
            abort(404);
        
        return view('pages.usersarticles')
            ->with(['articles' => $articles, 'userId' => $userId, 'userName' => $user->name, 'action' => 'showArticles']);
    }
}
