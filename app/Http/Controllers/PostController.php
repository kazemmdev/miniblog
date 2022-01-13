<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return $this->success(Post::with(['user', 'category'])->latest()->get());
    }

    public function show($slug)
    {
        return $this->success(Post::where('slug', $slug)->with(['user', 'category', 'tags'])->first());

    }

    public function store(PostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());

        $tags = [];

        foreach (explode(',', request('tags')) as $value) {
            if (strlen(trim($value))) $tags[] = Tag::firstOrCreate(['name' => trim($value)])->id;
        };

        $post->tags()->sync($tags);

        return $this->success([], 'Your post create successfully');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
