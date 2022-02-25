<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::paginate(10);
        return view('feedbacks', ['feedbacks' => $feedbacks]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'author' => ['required', 'string', 'min:5', 'max:255'],
            'feedback' => ['required', 'string', 'min:5'],
        ]);
        $data = $request->only(['author', 'feedback']);
        $created = Feedback::create($data);
        if ($created) {
            return redirect()->route('feedbacks.index')
            ->with('success', __('messages.feedbacks.created.success'));
        }
        return back()->with('error', __('messages.feedbacks.created.error'))->withInput();
    }
}
