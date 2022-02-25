<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function testFeedback()
    {
        $faker = Factory::create();
        $data = [
            'author' => $faker->userName() . '12345',
            'feedback' => $faker->text(100),
        ];
        $response = $this->post('/feedbacks', $data);

        $response->assertStatus(302);
    }
}
