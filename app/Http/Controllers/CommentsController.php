<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Article;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showUsersComments', 'getAllForTheArticle']);
    }
    /**
     * Show the user's comments
     * 
     * @return \Illuminate\Http\Response
     */
    public function showUsersComments($userId)
    {
        $user = User::findOrFail($userId);
        $comments = $user->latestCommentsWithFullArticlesTitles();
        
        return view('pages.userscomments')
            ->with(['comments' => $comments, 'userId' => $userId, 'userName' => $user->name, 'action' => 'showComments']);
    }
    
    /**
     * Get the all comments for the given article
     * 
     * @return JSON with comments
     */
    public function getAllForTheArticle($articleId)
    {
        $article = Article::findOrFail($articleId);
        $comments = $article->comments()->oldest()->get();
        
        return $comments;
    }
    /**
     * Store a new comment to the article
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $articleId
     * @return comment in JSON
     */
    public function store(Request $request, $articleId)
    {
        $article = Article::findOrFail($articleId, ['id']); //check that this article exists
        $this->validate($request, ['content' => 'required|max:1000']);
        $comment = Comment::create([
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id'),
            'article_id' => $articleId,
            'user_id' => Auth::id(),
            'author' => Auth::user()->name]);
        
        return $comment;
    }
}
