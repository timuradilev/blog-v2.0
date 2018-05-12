<?php

namespace App\Http\Middleware;

use Closure;
use App\Article;
use Illuminate\Support\Facades\Auth;

class ValidateThatUserIsAuthorOfArticle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $article = Article::findOrFail($request->route('id'), ['authoruid']);
        if($article->authoruid !== Auth::id()) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
