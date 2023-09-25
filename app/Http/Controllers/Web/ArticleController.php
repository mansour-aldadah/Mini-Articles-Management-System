<?php

namespace App\Http\Controllers\Web;

use App\Events\ArticleCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    public function index()
    {
        $current = "own";
        $this->authorize('viewAny', Article::class);
        $articles = Article::where('user_id', auth()->id())
            ->withCount('comments')
            ->with('user')
            ->when(request('search'), function ($query) {
                $query->where(function (Builder $query) {
                    $query->where('title', 'like', '%' . request('search') . '%')
                        ->orwhere('content', 'like', '%' . request('search') . '%');
                });
            })->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.article.all', compact('articles', 'current'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);
        return view('pages.article.create');
    }

    public function store(ArticleRequest $request)
    {
        $this->authorize('create', Article::class);
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => auth()->user()->is_admin ? 'published' : 'under_review',
            'slug' => Article::where('slug', \Str::slug($request->title))->exists() ? \Str::slug($request->title) . '-' . uniqid() : \Str::slug($request->title),
            'user_id' => auth()->id(),
        ]);

        event(new ArticleCreated($article));

        return to_route('articles.index');
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);
        $article->load(['comments.replies', 'user', 'comments.user', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }]);
        return view('pages.article.view', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('pages.article.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validated());

        return to_route('articles.show', $article)->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return to_route('articles.index')->with('success', 'Article deleted successfully');
    }
}
