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
            'username' => $faker->userName() . '12345',
            'feedback' => $faker->text(100),
        ];
        $response = $this->post('/feedback', $data);

        $response->assertStatus(200);
    }
}
