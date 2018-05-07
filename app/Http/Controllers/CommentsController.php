<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;

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
     * @return Illuminate\Http\Response
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
        $comments = $article->comments()->get();
        
        return $comments;
    }
}
