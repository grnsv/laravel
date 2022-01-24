<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testOrder()
    {
        $faker = Factory::create();
        $data = [
            'customer' => $faker->userName() . '12345',
            'tel' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'info' => $faker->text(100),
        ];
        $response = $this->post('/order', $data);

        $response->assertStatus(200);
    }
}
