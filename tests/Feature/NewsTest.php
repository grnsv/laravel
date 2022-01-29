<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function testCategoriesList()
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }

    public function testNewsList()
    {
        $response = $this->get(route('news.index', ['categoryId' => mt_rand(1, 10)]));

        $response->assertStatus(200);
    }

    public function testNewsShow()
    {
        $response = $this->get(route('news.show', ['newsId' => mt_rand(1, 10)]));

        $response->assertStatus(200);
    }
}
