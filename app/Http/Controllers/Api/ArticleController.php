<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PaginationResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->when(request('search'), function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('content', 'like', '%' . request('search') . '%');
                });
            })->with('user')
            ->withCount('comments')->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json(
            [
                'error' => false,
                'msg' => null,
                'data' => new PaginationResource(ArticleResource::collection($articles)),
            ]
        );
    }

    public function get_comments(Article $article)
    {
        if ($article->status != 'published') {
            return response()->json(
                [
                    'error' => true,
                    'msg' => 'This article is not published yet',
                    'data' => null,
                ]
            );
        }

        $article->load(['comments.user', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }]);

        return response()->json(
            [
                'error' => false,
                'msg' => null,
                'data' => new PaginationResource(CommentResource::collection($article->comments()->paginate(20))),
            ]
        );
    }
}
