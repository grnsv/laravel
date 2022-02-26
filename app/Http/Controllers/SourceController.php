<?php

namespace App\Http\Controllers;

use App\Jobs\NewsParsingJob;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'source' => ['required', 'url'],
        ]);
        $url = $request->input('source');
        $pending = dispatch(new NewsParsingJob($url));
        if ($pending) {
            return back()->with('success', __('messages.sources.created.success'));
        }
        return back()->with('error', __('messages.sources.created.error'))->withInput();
    }
}
