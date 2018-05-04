<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Http\Requests\CreateArticleRequest;
use App\User;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->get();
        //get all articles
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
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $req)
    {
        $article = $req->all();
        $article['authoruid'] = Auth::id();
        Article::create($article);
        
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
        
        if(is_null($article))
            abort(404);
        
        return view("pages.article", compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("pages.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update and redirect to /
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete and redirect to /
    }
    
    /**
     * Generate and store a article with a random title and a content.
     * 
     * @param \Illuminate\Http\Reuqest $request
     * @return \Illuminate\Http\Response
     */
    public function makeRandomArticle()
    {
        $loremIpsum = array_map("strip_tags", file("http://loripsum.net/api/1/short/headers", FILE_IGNORE_NEW_LINES));
        
        $article['title'] = $loremIpsum[0];
        $article['content'] = $loremIpsum[2];
        $article['authoruid'] = Auth::id();
        
        Article::create($article);
        
        return redirect('/');
    }
    
    /**
     * Show the user's articles
     * 
     * @return Illuminate\Http\Response
     */
    public function showUsersArticles(Request $request, $userId)
    {
        $user = User::find($userId);
        
        $articles = $user->articles()->latest()->get();
        
        return view('pages.usersarticles')
                ->with(['articles' => $articles, 'userId' => $userId, 'userName' => $user->name, 'action' => 'showArticles']);
    }
}
