<?php

namespace App\Http\Middleware;


use Closure;
use App\TextPost;
use App\Article;
use App\Post;
use Illuminate\Support\Facades\Auth;



class CountReportView
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
        $response = $next($request);

        $segments =$request->segments();

        $category = $segments[0];
        $id = $segments[1];
        if(!Auth::check()){
            if($category == "report")
            {
                $post = TextPost::findOrFail($id);
                $post->post->increment('views');
            }
            elseif($category == "article")
            {
                $post = Article::findOrFail($id);
                $post->increment('views');
            }
        }
        return $response;
    }
}
