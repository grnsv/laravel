<?php

namespace Tests\Feature;

use App\Models\Source;
use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoriesList()
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }

    public function testNewsList()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('news.index', ['category' => $category]));

        $response->assertStatus(200);
    }

    public function testNewsShow()
    {
        $source = Source::factory()->create();
        $news = News::factory()->create([
            'source_id' => $source->id
        ]);
        $response = $this->get(route('news.show', ['news' => $news]));

        $response->assertStatus(200);
    }
}
