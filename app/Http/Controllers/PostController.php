<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->success(Post::with(['user', 'category'])->latest()->get());
    }

    public function show($slug): JsonResponse
    {
        return $this->success(Post::where('slug', $slug)->with(['user', 'category', 'tags'])->first());

    }

    public function store(PostRequest $request): JsonResponse
    {
        $post = Auth::user()->posts()->create($request->validated());

        $tags = [];

        foreach (explode(',', request('tags')) as $value) {
            if (strlen(trim($value))) $tags[] = Tag::firstOrCreate(['name' => trim($value)])->id;
        }

        $post->tags()->sync($tags);

        return $this->success([], 'Your post create successfully');
    }

    public function update(PostRequest $request, $id): JsonResponse
    {
        $post = Auth::user()->posts()->whereId($id)->update($request->validated());

        $tags = [];

        foreach (explode(',', request('tags')) as $value) {
            if (strlen(trim($value))) $tags[] = Tag::firstOrCreate(['name' => trim($value)])->id;
        }

        $post->tags()->sync($tags);

        return $this->success([], 'Your post updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        Auth::user()->posts()->whereId($id)->first()->delete();

        return $this->success([], 'Your post updated successfully');
    }
}
