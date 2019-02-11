<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\MessageAdmin;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage()
    {
        return MessageAdmin::newMessage();
    }

    public function index()
    {
        $posts = $this->model()::orderby('status', 'ASC')->orderby('id', 'DESC')->paginate(10);
        $new = $this->model()::where('status', '0')->count();
        $old = $this->model()::where('status', '1')->count();
        $newMessage = $this->newMessage();
        return view('admin.message.index', compact('newMessage', 'posts', 'new', 'old'));
    }

    public function show(Message $message)
    {
        $newMessage = $this->newMessage();
        $item = $this->model()::findOrFail($message->id);
        $this->changeStatus($item);
        return view('admin.message.show', compact('message', 'newMessage'));
    }

    public function destroy(Message $message)
    {
        if ($message->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function destroyItem($id)
    {
        $item = $this->model()::findOrFail($id);

        if ($item->delete()) {
            return redirect()->route('messages.index')->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function status(Request $request)
    {
        $item = $this->model()::findOrFail($request->id);
        $this->changeStatus($item);
        return redirect()->back()->with('success', 'Thay đổi status thành công!');
    }

    private function model()
    {
        return Message::class;
    }

    private function changeStatus($item) {
        $status = $item->status;
        $item->update(
            [
                'status' => $status == '0' ? '1' : '0'
            ]
        );
    }
}
