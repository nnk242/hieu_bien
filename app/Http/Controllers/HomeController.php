<?php

namespace App\Http\Controllers;

use App\Category;
use App\Message;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
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

    private function top() {
        return $this->post()::orderby('view', 'DESC')->take(7)->get();
    }

    public function index()
    {
        $top = $this->top();
        $posts = $this->post()::where(['slide' => 'hide', 'status' => 'show'])->orderby('id', 'DESC')->paginate(10);
        $slides = $this->post()::where(['slide' => 'show', 'status' => 'show'])->get();
        $categories = $this->category()::all();
        return view('frontend.index', compact('posts', 'categories', 'slides', 'top'));
    }

    public function post_($post)
    {
        $top = $this->top();
        $post = $this->post()::where(['status' => 'show', 'title_seo' => $post])->first();
        Event::fire(URL::current(), $post);
        $categories = $this->category()::all();
        return view('frontend.post', compact('categories', 'post', 'top'));
    }

    public function category_($category)
    {
        $category = $this->category()::select('id', 'title')->where('title_seo', $category)->first();

        $category_id = $category->id;
        $category_title = $category->title;

        $posts = $this->post()::where(['status' => 'show', 'category_id' => $category_id])->paginate(10);
        $categories = $this->category()::all();
        return view('frontend.category', compact('posts', 'categories', 'category_title'));
    }

    public function search($search)
    {
        $posts = Post::where(['status' => 'show'])->where('title', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $categories = $this->category()::all();
        return view('frontend.search', compact('posts', 'categories', 'search'));
    }

    public function apiSearch(Request $request)
    {
        $posts = Post::where(['status' => 'show'])->where('title', 'like', '%' . $request->keyword . '%')
            ->orderBy('created_at', 'DESC')
            ->limit(15)->get();
        return $posts;
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
        $timeCreatedAt = Message::where('ip', $request->ip())->orderby('id', 'DESC')->first()->created_at->timestamp;

        if(isset($timeCreatedAt)) {
            if($timeCreatedAt < time() - 60*5) {
                Message::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'content' => $request->input('content'),
                    'ip' => $request->ip()
                ]);
                return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
            } else {
                return redirect()->back()->with('error', 'Gửi tin nhắn qúa nhanh xin vui lòng đọi gửi lại trong 5 phút!');
            }
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
