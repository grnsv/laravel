<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryAdminTest extends TestCase
{
    use RefreshDatabase;

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

    public function testCategoryStore()
    {
        $categoryFactoryData = Category::factory()->definition();

        $response = $this->post(route('admin.categories.store'), $categoryFactoryData);

        $response->assertStatus(302);
    }
}
