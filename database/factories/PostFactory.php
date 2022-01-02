<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => str_replace(' ', '-', $title),
            'subtitle' => $this->faker->text(500),
            'body' => $this->faker->paragraphs(20, true),
            'user_id' => random_int(1, User::count()),
            'category_id' => random_int(1, Category::count()),
        ];
    }
}
