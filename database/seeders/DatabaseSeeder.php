<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'php', 'slug' => 'php']);
        Category::create(['name' => 'laravel', 'slug' => 'laravel']);
        Category::create(['name' => 'symphony', 'slug' => 'symphony']);

        User::factory(10)->create();
        Post::factory(50)->create();
    }
}
