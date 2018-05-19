<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title'
    ];
    protected $appends = ['asQuery'];
    /**
     * Convert a title to tag query to search articles with this tag.
     * 
     * @return string
     */
    public function getAsQueryAttribute()
    {
        return '['.$this->title.']';
    }
    /**
     * Get articles for this tag.
     * 
     * @return @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->hasManyThrough('App\Article', 'App\Articletag', 'tag_id', 'id', 'id', 'article_id');
    }
    /**
     * Get articles on the given page for this tag
     * 
     * @param string tagTitle
     * @param int $pageNumber
     * @return @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function articlesOnPage($pageNumber)
    {
        return $this->articles()->latest()->paginate(10, ['*'], 'page', $pageNumber);
    }
    /**
     * Save all given tags to DB
     */
    public static function saveTags($tags, $articleId)
    {
        foreach(Tag::prepareTags($tags) as $tag) {
            $newTag = Tag::firstOrCreate(['title' => $tag]);
            Articletag::create(['article_id' => $articleId, 'tag_id' => $newTag->id]);
        }
    }
    /**
     * Convert string with tags to array of tags
     * 
     * @return array
     */
    protected static function prepareTags($tags)
    {
        $array = array_map('trim', explode(',', $tags));
        $filtered = array_filter($array);
        $unique = array_unique($filtered);
        
        return $unique;
    }
}
