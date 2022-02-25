<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::paginate(10);
        return view('admin.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    public function delete(int $id)
    {
        $feedback = Feedback::find($id);
        try {
            $feedback->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Feedback error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
