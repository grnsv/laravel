<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(?int $categoryId = null)
    {
        if (!is_null($categoryId)) {
            $news = $this->getNews();
            return view('news', ['categoryId' => $categoryId, 'newsList' => $news]);
        }
        $categories = $this->getCategories();
        return view('categories', ['categories' => $categories]);
    }

    public function show(int $newsId)
    {
        $news = $this->getNews($newsId);
        return view('news', ['news' => $news]);
    }
}
