<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsAdminTest extends TestCase
{
    public function testNewsListAvailable()
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

    public function testNewsCreateAvailable()
    {
        $response = $this->get(route('admin.news.create'));

        $response->assertStatus(200);
    }

    public function testNewsStoreJson()
    {
        $faker = Factory::create();
        $data = [
            'title' => $faker->title() . '12345',
            'author' => $faker->userName(),
            'status' => ['draft', 'active', 'blocked'][rand(0, 2)],
            'description' => $faker->text(100),
        ];
        $response = $this->post(route('admin.news.store'), $data);

        $response->assertStatus(201);
        $response->assertJson($data);
    }
}
