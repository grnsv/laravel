<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(5);
        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'author' => $this->faker->userName(),
            'status' => ['draft', 'active', 'blocked'][rand(0, 2)],
            'description' => $this->faker->text(100),
            'source_id' => rand(1, 10)
        ];
    }
}
