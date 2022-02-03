<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $availableFields = [
        'news.id',
        'news.title',
        'news.slug',
        'news.author',
        'news.status',
        'news.description',
        'news.created_at'
    ];

    public function getNews(string $categorySlug): array
    {
        return DB::table('categories')
            ->join('categories_has_news', 'categories.id', '=', 'categories_has_news.category_id')
            ->join('news', 'categories_has_news.news_id', '=', 'news.id')
            ->select($this->availableFields)
            ->where('categories.slug', '=', $categorySlug)
            ->limit(100)
            ->get()
            ->toArray();
    }

    public function getNewsBySlug(string $newsSlug)
    {
        return DB::table($this->table)
            ->select($this->availableFields)
            ->where('slug', '=', $newsSlug)
            ->get()
            ->toArray();
    }
}
