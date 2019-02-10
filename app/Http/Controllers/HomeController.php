<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
    }
}
