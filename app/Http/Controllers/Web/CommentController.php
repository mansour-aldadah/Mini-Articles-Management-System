<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Article $article)
    {
        $this->authorize('viewAny', Comment::class);
        return CommentResource::collection($article->comments);
    }

    public function store(CommentRequest $request, Article $article)
    {
        $this->authorize('create', [Comment::class, $article]);
        $article->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
        return back()->with('success', 'Comment created successfully.');
    }

    public function update(CommentRequest $request, Article $article, Comment $comment)
    {
        $this->authorize('update', [$comment, $article]);
        $comment->update($request->validated());
        return back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Article $article, Comment $comment)
    {
        $this->authorize('delete', [$comment, $article]);
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
