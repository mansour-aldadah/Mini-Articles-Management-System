<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $current = 'home';
        $articles = Article::where('status', 'published')
            ->withCount('comments')
            ->with('user')
            ->when(request('search'), function ($query) {
                $query->where(function (Builder $query) {
                    $query->where('title', 'like', '%' . request('search') . '%')
                        ->orwhere('content', 'like', '%' . request('search') . '%');
                });
            })->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.home.all', compact('articles', 'current'));
    }

    public function show(Article $article)
    {
        $article->load(['comments.replies', 'user', 'comments.user', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }]);
        return view('pages.home.view', compact('article'));
    }
}
