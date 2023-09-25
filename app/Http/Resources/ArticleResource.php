<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Article */
class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'comment_count' => $this->comments_count,
            'user' => [
                'full_name' => $this->user->full_name,
            ]
        ];
    }
}
