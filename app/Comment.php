<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
      'content',
      'article_id',
      'user_id',
      'author',
      'parent_id'
    ];
    /**
     * Get a created_at date.
     * 
     * @return string
     */
    public function getCreatedAtAttribute($created_at)
    {
        $created = new Carbon($created_at, config('app.timezone'));
        $created->setTimezone('Europe/Moscow');
        return $created->format("d.m.Y H:i");
    }
}
