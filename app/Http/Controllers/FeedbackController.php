<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function success(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:5']
        ]);
        $filename = $request->username . '_' . $request->_token . '.json';
        file_put_contents(public_path('/feedbacks/' . $filename), json_encode($request->all()));
        return view('feedback_success');
    }
}
