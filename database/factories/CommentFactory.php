<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence,
            'user_id' => User::inRandomOrder()->first()->id, // Select an existing user ID
            'post_id' => Post::inRandomOrder()->first()->id, // Select an existing post ID
            // 'created_by' => User::factory(), // Assuming created_by is a user ID
        ];
    }
}
