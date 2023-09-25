<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'published_at' => 'datetime',
    ];

    protected $visible = [
        'title',
        'slug',
        'content',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function image(): morphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
