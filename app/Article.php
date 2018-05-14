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
     * Get the comments an article has
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
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
     * @return string
     */
    public function getCreatedAtAttribute($created_at)
    {
        $created = new Carbon($created_at, config('app.timezone'));
        Carbon::setLocale(config('app.locale'));
        $created->setTimezone('Europe/Moscow');
        return (string)$created->diffForHumans();
    }
}
