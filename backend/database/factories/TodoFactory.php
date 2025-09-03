<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */



    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'completed' => $this->faker->boolean(),
            'user_id' => User::factory(), // Adicione esta linha
        ];
    }
}
