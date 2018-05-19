<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articletag extends Model
{
    protected $fillable = [
      'article_id',
      'tag_id'
    ];
}
