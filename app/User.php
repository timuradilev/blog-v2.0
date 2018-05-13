<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Get all user's articles
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'authoruid');
    }
    
    /**
     * Get all user's comments
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    /**
     * Get all user's comments with filled article's titles.
     * 
     * @return Illuminate\Support\Collection
     */
    public function latestCommentsWithFullArticlesTitles()
    {
        $comments = DB::table('comments')->where('user_id', '=', $this->id)
                ->join('articles', 'articles.id', '=', 'comments.article_id')
                ->select('comments.content', 'comments.created_at', 'comments.author', 'comments.article_id', 'articles.title')
                ->latest()
                ->get();
        foreach($comments as &$comment) {
            $comment->slug = str_slug($comment->title, '-');
        }
        
        return $comments;
    }
}
