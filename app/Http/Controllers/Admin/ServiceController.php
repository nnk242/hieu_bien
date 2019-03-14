<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Component\InboxAdmin;
use App\Http\Controllers\Component\MessageAdmin;
use App\Http\Controllers\Controller;
use App\Services\ImgurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage() {
        return MessageAdmin::newMessage();
    }

    protected function newInbox()
    {
        return InboxAdmin::newInbox();
    }


    private function model()
    {
        return Category::class;
    }

    public function index()
    {
        $posts = $this->model()::paginate(10);
        $newMessage = $this->newMessage();
        $newInbox = $this->newInbox();
        return view('admin.category.index', compact('posts', 'newMessage', 'newInbox'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newMessage = $this->newMessage();
        $newInbox = $this->newInbox();
        return view("admin.category.create", compact('newMessage', 'newInbox'));
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

        $validator = Validator::make($request->all(), [
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
            $file = $request->file('image');
            $imageName = time() . '_' . str_random(7) . '.' . $file->getClientOriginalExtension();
            $image = ['image' => uploadFile($file, $imageName, 'uploads/image')];
            $data = array_merge_recursive($image, $data);
        }
        $this->model()::create($data);

        return redirect()->back()->with('success', 'Thêm thành công!');
    }

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        $newMessage = $this->newMessage();
        $newInbox = $this->newInbox();
        return view('admin.category.edit', compact('category', 'newMessage', 'newInbox'));
    }


    public function update(Request $request, Category $category)
    {
        $items = $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'introduce' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Sửa thất bại!');
        }

        $data = [
            'title' => $request->title,
            'title_seo' => $this->model()::findOrFail($category->id)->where('title_seo', str_seo($request->title))->count() == 1 ||
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
            $file = $request->file('image');
            $imageName = time() . '_' . str_random(7) . '.' . $file->getClientOriginalExtension();
            $image = ['image' => uploadFile($file, $imageName, 'uploads/image')];
            $data = array_merge_recursive($image, $data);
        }

        File::delete(public_path($category->image));
        $category->update($data);

        return redirect()->back()->with('success', 'Sửa thành công!');
    }

    public function destroy(Category $category)
    {
        $re = $category;
        if ($category->delete()) {
            File::delete(public_path($re->image));
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
}
