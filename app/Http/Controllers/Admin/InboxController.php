<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Component\InboxAdmin;
use App\Http\Controllers\Component\MessageAdmin;
use App\Chat;
use App\Message;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage()
    {
        return MessageAdmin::newMessage();
    }

    protected function newInbox()
    {
        return InboxAdmin::newInbox();
    }

    public function index()
    {
        $posts = $this->model()::orderby('status', 'ASC')->orderby('id', 'DESC')->paginate(10);
        $newMessage = $this->newMessage();
        $newInbox = $this->newInbox();
        return view('admin.inbox.index', compact('newMessage', 'newInbox', 'posts'));
    }

    public function show($id)
    {
        $newMessage = $this->newMessage();

        $item = $this->model()::findorfail($id);
        $chat = Chat::where('client_id', $item->id)->get();

        if($item->status == '0') {
            $this->changeStatus($item);
        }

        $newInbox = $this->newInbox();
        return view('admin.inbox.show', compact('item', 'newMessage', 'newInbox', 'chat'));
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
        return Client::class;
    }

    private function changeStatus($item)
    {
        $status = $item->status;
        $item->update(
            [
                'status' => $status == '0' ? '1' : '0'
            ]
        );
    }
}
