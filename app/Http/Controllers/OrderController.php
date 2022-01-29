<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success(Request $request)
    {
        $request->validate([
            'customer' => ['required', 'string', 'min:5']
        ]);
        $filename = $request->customer . '_' . $request->_token . '.json';
        file_put_contents(public_path('/orders/' . $filename), json_encode($request->all()));
        return view('order_success');
    }
}
