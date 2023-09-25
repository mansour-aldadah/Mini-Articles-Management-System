<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(rand(5, 15), true);
        $status = $this->faker->randomElement(['draft', 'published', 'under_review', 'rejected']);
        return [
            'title' => $title,
            'slug' => \Str::slug($title),
            'content' => $this->faker->paragraph(40),
            'status' => $status,    
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'published_at' => $status == "published" ? Carbon::now() : null,
        ];
    }
}
