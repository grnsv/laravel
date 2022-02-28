<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Services\UploadService;

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
     * @param  CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = app(UploadService::class)->saveFile($request->file('image'));
            $validated['isImage'] = true;
        }
        $created = News::create($validated);
        if ($created) {
            $created->categories()->attach($request->input('categories'));
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.created.success'));
        }

        return back()->with('error', __('messages.admin.news.created.error'))->withInput();
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
     * @param  UpdateRequest $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, News $news)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = app(UploadService::class)->saveFile($request->file('image'));
            $validated['isImage'] = true;
        }
        $updated = $news->fill($validated)->save();
        if ($updated) {
            $news->categories()->sync($request->input('categories'));
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.updated.success'));
        }

        return back()->with('error', __('messages.admin.news.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            $news->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('News error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
