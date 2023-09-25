<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
//            'slug' => ['required', 'unique:articles', 'max:255'],
            'content' => ['required', 'min:20'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
