<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsList = News::/*whereHas('categories')->*/with('categories')->paginate(10);
        return view('admin.news.index', ['newsList' => $newsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);
        $data = $request->only(['title', 'author', 'status', 'description']) + ['slug' => Str::slug($request->title)];

        $created = News::create($data);
        if ($created) {
            $created->categories()->attach($request->input('categories'));
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно добавлена');
        }

        return back()->with('error', 'Не удалось добавить запись')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);
        $data = $request->only(['title', 'author', 'status', 'description']) + ['slug' => Str::slug($request->title)];

        $updated = $news->fill($data)->save();
        if ($updated) {
            $news->categories()->sync($request->input('categories'));
            return redirect()->route('admin.news.index')->with('success', 'Запись успешно обновлена');
        }

        return back()->with('error', 'Не удалось обновить запись')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
