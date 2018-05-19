<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use App\Article;

abstract class Search
{
    /**
     * Search for articles
     * 
     * @param string $query
     * @param int $pageNumber
     * @return LengthAwarePaginator|Collection
     */
    public static function articles($query, $pageNumber)
    {
        if (Search::isSearchByTag($query)) {
            return Tag::firstOrNew(['title' => Search::extractTagTitle($query)])->articlesOnPage($pageNumber);
        }
        elseif (Search::isSearchByWords($query)) {
            return Article::hasWords($query, $pageNumber);
        }
        else {
            return new Collection();
        }
    }
    /**
     * Determine whether a given query is search by words
     * 
     * @param string $query
     * @return boolean
     */
    public static function isSearchByWords($query)
    {
        return !Search::isTag($query);
    }
    /**
     * Determine whether a given query is search by tag
     * 
     * @param string $query
     * @return boolean
     */
    public static function isSearchByTag($query)
    {
        return Search::isTag($query);
    }
    /**
     * Get tag's title from query
     * 
     * @param string $tag
     * @return string
     */
    public static function extractTagTitle($tag)
    {
        return substr($tag, 1, -1);
    }
    /**
     * Determine whether a given string is tag or not
     * 
     * @param string $str
     * @return boolean
     */
    protected static function isTag($str)
    {
        return $str[0] === '[' && $str[strlen($str) - 1] === ']';
    }
}