<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(?string $categorySlug = null)
    {
        if (!is_null($categorySlug)) {
            $newsList = (new News())->getNews($categorySlug);
            return view('news.index', ['newsList' => $newsList]);
        }
        $categories = (new Category())->getCategories();
        return view('categories', ['categories' => $categories]);
    }

    public function show(string $newsSlug)
    {
        $news = (new News())->getNewsBySlug($newsSlug)[0];
        return view('news.show', ['news' => $news]);
    }
}
