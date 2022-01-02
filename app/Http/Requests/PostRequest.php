<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ];
    }

    public function validated(): array
    {
        return array_merge(parent::validated(), [
            'slug' => Str::slug(request('title')),
        ]);
    }
}
