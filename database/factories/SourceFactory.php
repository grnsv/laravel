<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'link' => $this->faker->url(),
            'description' => $this->faker->text(50),
            'image' => $this->faker->url(),
        ];
    }
}
