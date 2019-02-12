<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Component\MessageAdmin;
use App\Http\Controllers\Controller;
use App\Post;
use App\Services\ImgurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage() {
        return MessageAdmin::newMessage();
    }

    public function model()
    {
        return Post::class;
    }

    public function index()
    {
        $posts = $this->model()::paginate(10);
        $newMessage = $this->newMessage();
        return view('admin.post.index', compact('posts', 'newMessage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'title')->get();
        $newMessage = $this->newMessage();
        return view("admin.post.create", compact('newMessage', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->all();

        $validator = Validator::make($items, [
            'title' => 'required',
            'introduce' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:20000'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', serialize($validator->errors()->getMessages()));
        }

        $data = [
            'title' => $request->title,
            'title_seo' => $this->model()::where('title_seo', str_seo($request->title))->count() == 0 ?
                str_seo($request->title) :
                str_seo($request->title) . time() . str_random(4),
            'introduce' => $request->introduce,
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'author' => $request->author_type == 'yes' ? $request->author : Auth::user()->name,
            'user_id' => Auth::id()
        ];

        if (isset($items['image'])) {
            $image = ['image' => ImgurService::uploadImage($items['image']->getRealPath())];
            $data = array_merge_recursive($image, $data);
        }
        $this->model()::create($data);

        return redirect()->back()->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    public function edit(Post $post)
    {
        $categories = Category::select('id', 'title')->get();
        $newMessage = $this->newMessage();
        return view('admin.post.edit', compact('post', 'newMessage', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $items = $request->all();

        $validator = Validator::make($items, [
            'title' => 'required',
            'introduce' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Sửa thất bại!');
        }

        $data = [
            'title' => $request->title,
            'title_seo' => $this->model()::findOrFail($post->id)->where('title_seo', str_seo($request->title))->count() == 1 ||
            $this->model()::where('title_seo', str_seo($request->title))->count() <= 1 ?
                str_seo($request->title) :
                str_seo($request->title) . time() . str_random(4),
            'introduce' => $request->introduce,
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'author' => $request->author_type == 'yes' ? $request->author : Auth::user()->name,
            'user_id' => Auth::id()
        ];

        if (isset($items['image'])) {
            $image = ['image' => ImgurService::uploadImage($items['image']->getRealPath())];
            $data = array_merge_recursive($image, $data);
        }
        $post->update($data);

        return redirect()->back()->with('success', 'Sửa thành công!');
    }

    public function destroy(Post $post)
    {
        if ($post->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function changeStatus(Request $request)
    {
        $item = $this->model()::findOrFail($request->id);
        $status = $item->status;
        $item->update(
            [
                'status' => $status == 'show' ? 'hide' : 'show'
            ]
        );
        return redirect()->back()->with('success', 'Thay đổi status thành công!');
    }

    public function changeSlide(Request $request)
    {
        $item = $this->model()::findOrFail($request->id);
        $slide = $item->slide;
        $item->update(
            [
                'slide' => $slide == 'show' ? 'hide' : 'show'
            ]
        );
        return redirect()->back()->with('success', 'Thay đổi slide thành công!');
    }
}
