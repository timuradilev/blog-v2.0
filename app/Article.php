<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = [
      'title',
      'content',
      'authoruid',
      'author'
    ];
    
    protected $appends = ['slug'];
    /**
     * Get the article's comments
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
     * Get the article's tags
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->hasManyThrough('App\Tag', 'App\Articletag', 'article_id', 'id', 'id', 'tag_id');
    }
    /**
     * Get the entries in articletags table that belongs to this article.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagsBonds()
    {
        return $this->hasMany('App\Articletag');
    }
    /**
     * Get a slug for the title.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return str_slug($this->attributes['title'], '-');
    }
    /**
     * Get a created_at date.
     * 
     * @param string $created_at
     * @return string
     */
    public function getCreatedAtAttribute($created_at)
    {
        $created = new Carbon($created_at, config('app.timezone'));
        Carbon::setLocale(config('app.locale'));
        $created->setTimezone('Europe/Moscow');
        return (string)$created->diffForHumans();
    }
    /**
     * Get articles on the given page that have given words in the title and the content columns
     * 
     * @param string $query
     * @param int $pageNumber
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function hasWords($query, $pageNumber = 1)
    {
        return Article::where('title', 'like', "%$query%")
                        ->orWhereRaw('match(content) against (?)', [$query])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10, ['*'], 'page', $pageNumber);
    }
}
