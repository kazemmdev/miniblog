<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        if (request('slug')) {
            return $this->success(Category::where('slug', request('slug'))->with(['posts' => function($post) {
                return $post->with(['user','category']);
            }])->first());
        }

        return $this->success(Category::all());
    }

    public function store(): JsonResponse
    {
        $category = Category::create(['name' => request('name'), 'slug' => Str::slug(request('name'))]);
        return $this->success($category, 'Category created successfully');
    }

    public function update(Category $category): JsonResponse
    {
        $category->update(['name' => request('name'), 'slug' => Str::slug(request('name'))]);
        return $this->success($category->refresh(), 'Category updated successfully');
    }

    public function destroy(Category $category): JsonResponse
    {
        if ($category->posts()->count())
            return $this->error('This category has some posts and cannot deleted!');

        return $this->success($category->delete(), 'Category deleted successfully');
    }
}
