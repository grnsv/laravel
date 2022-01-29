<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryAdminTest extends TestCase
{
    public function testCategoryListAvailable()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

    public function testCategoryCreateAvailable()
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);
    }

    public function testCategoryStoreJson()
    {
        $faker = Factory::create();
        $data = [
            'title' => $faker->title() . '12345',
        ];
        $response = $this->post(route('admin.categories.store'), $data);

        $response->assertStatus(201);
        $response->assertJson($data);
    }
}
