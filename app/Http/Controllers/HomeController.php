<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chat;
use App\Client;
use App\Doctor;
use App\Message;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class HomeController extends Controller
{

    public function event_chat()
    {
        session(['event-chat' => 'a_' . str_random(5) . '_' . time() . '_' . str_random(5) . '_b']);
    }

    public function __construct()
    {
        $this->event_chat();
    }

    private function post()
    {
        return Post::class;
    }

    private function category()
    {
        return Category::class;
    }

    private function tags()
    {
        return Tag::class;
    }

    private function tagHome()
    {
        return $this->tags()::first();
    }

    private function top()
    {
        return $this->post()::orderby('view', 'DESC')->take(7)->get();
    }

    private function chat()
    {
        return Chat::class;
    }

    private function client()
    {
        return Client::class;
    }

    public function index(Request $request)
    {
        $doctor = Doctor::where('status', 'show')->get();

        $tags = ['name' => explode(",", $this->tagHome()->tag),
            'seo' => explode(",", $this->tagHome()->tag_seo)];
        $top = $this->top();
        $posts = $this->post()::where(['slide' => 'hide', 'status' => 'show'])->orderby('id', 'DESC')->paginate(10);
        $slides = $this->post()::where(['slide' => 'show', 'status' => 'show'])->get();
        $categories = $this->category()::all();
        return view('frontend.index', compact('posts', 'categories', 'slides', 'top', 'tags', 'doctor'));
    }

    public function post_($post)
    {
        $tags = ['name' => explode(",", $this->tagHome()->tag),
            'seo' => explode(",", $this->tagHome()->tag_seo)];
        $top = $this->top();
        $post = $this->post()::where(['status' => 'show', 'title_seo' => $post])->first();
        if (isset($post)) {
            Event::fire(URL::current(), $post);
        }
        $categories = $this->category()::all();
        return view('frontend.post', compact('categories', 'post', 'top', 'tags'));
    }

    public function category_($category)
    {
        $tags = ['name' => explode(",", $this->tagHome()->tag),
            'seo' => explode(",", $this->tagHome()->tag_seo)];
        $top = $this->top();
        $category = $this->category()::select('id', 'title')->where('title_seo', $category)->first();

        $category_id = $category->id;
        $category_title = $category->title;

        $posts = $this->post()::where(['status' => 'show', 'category_id' => $category_id])->paginate(10);
        $categories = $this->category()::all();
        return view('frontend.category', compact('posts', 'categories', 'category_title', 'tags', 'top'));
    }

    public function search($search)
    {
        $tags = ['name' => explode(",", $this->tagHome()->tag),
            'seo' => explode(",", $this->tagHome()->tag_seo)];

        $top = $this->top();
        $posts = Post::where(['status' => 'show'])->where('title', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $categories = $this->category()::all();
        return view('frontend.search', compact('posts', 'categories', 'search', 'top', 'tags'));
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
        $timeCreatedAt = Message::where('ip', $request->ip())->orderby('id', 'DESC')->first();

        if (isset($timeCreatedAt)) {
            $timeCreatedAt = $timeCreatedAt->created_at->timestamp;
            if ($timeCreatedAt >= time() - 60 * 5) {
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

    public function tag($tag_)
    {
        $tags = ['name' => explode(",", $this->tagHome()->tag),
            'seo' => explode(",", $this->tagHome()->tag_seo)];

        $top = $this->top();
        $posts = Post::where(['status' => 'show'])->where('title', 'like', '%' . $tag_ . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $categories = $this->category()::all();
        return view('frontend.tag', compact('posts', 'categories', 'search', 'top', 'tags', 'tag_'));
    }

    public function sendMessage_(Request $request)
    {
        $event_chat = $request->session()->get('event-chat');
        $client = $this->client()::where('name', $event_chat)->first();
        if (isset($client)) {
            $timeCreatedAt = $client->created_at->timestamp;
            $client->update([
                'status' => '0',
                'ip' => $request->ip()
            ]);
            if ($timeCreatedAt >= time() - 5) {
                return response()->json([
                    'status' => 205,
                ]);
            }
        } else {
            $client = $this->client()::create([
                'name' => $event_chat,
                'ip' => $request->ip()
            ]);
        }

        $this->chat()::create([
            'client_id' => $client->id,
            'message' => $request->message,
            'type_chat' => 'inbox'
        ]);
//
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            'fff99aade71a480c4189',
            'c6748fe9b671849f41fa',
            '716137',
            $options
        );

        $data['message'] = $request->message;
        $pusher->trigger($request->session()->get('event-chat'), 'my-event', $data);

        return response()->json([
            'status' => 200,
        ]);
    }
}
