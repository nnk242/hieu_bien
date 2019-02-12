<?php

namespace App\Http\Controllers;

use App\Category;
use App\Message;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    private function post()
    {
        return Post::class;
    }

    private function category()
    {
        return Category::class;
    }

    public function index()
    {
        $posts = $this->post()::where(['slide' => 'hide', 'status' => 'show'])->paginate(10);
        $slides = $this->post()::where(['slide' => 'show', 'status' => 'show'])->get();
        $categories = $this->category()::all();
        return view('frontend.index', compact('posts', 'categories', 'slides'));
    }

    public function post_($post)
    {
        $post = $this->post()::where(['status' => 'show', 'title_seo' => $post])->first();
        $categories = $this->category()::all();
        return view('frontend.post', compact('categories', 'post'));
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required|min:20|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', serialize($validator->errors()->getMessages()));
        }

        if (Message::count() > 555) {
            Message::where('status', '1')->orderby('id', 'DESC')->first()->delete();
        }

        Message::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
    }
}
