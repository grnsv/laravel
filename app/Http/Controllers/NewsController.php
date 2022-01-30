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
            $category = Category::where('slug', '=', $categorySlug)->first();
            $newsList = $category->news()->paginate(9);
            return view('news.index', ['newsList' => $newsList]);
        }
        $categories = Category::select(Category::$availableFields)->paginate(10);
        return view('categories', ['categories' => $categories]);
    }

    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }
}
