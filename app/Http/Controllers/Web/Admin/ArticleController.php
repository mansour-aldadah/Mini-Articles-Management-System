<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $current = 'manage';
        $articles = Article::where('status', '!=', 'published')->with('user')
            ->when(request('search'), function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('content', 'like', '%' . request('search') . '%');
                });
            })->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('pages.admin.article.all', compact('articles', 'current'));
    }


    public function show(Article $article)
    {
        $article->load(['comments.user', 'user']);
        return view('pages.admin.article.view', compact('article'));
    }

    public function update(Article $article, $status)
    {
        $article->update([
            'status' => $status == 'approve' ? 'published' : ($status == 'draft' ? 'draft' : 'rejected'),
        ]);
        return back()->with('success', 'Article status changed successfully');
    }
}
