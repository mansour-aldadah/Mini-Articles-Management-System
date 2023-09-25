<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(User $user, Article $article): bool
    {
        return $article->status === "published";
    }

    public function update(User $user, Comment $comment, Article $article): bool
    {
        return $comment->user_id === $user->id && $article->status === "published";
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }
}
