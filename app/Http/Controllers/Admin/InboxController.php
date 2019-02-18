<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Component\InboxAdmin;
use App\Http\Controllers\Component\MessageAdmin;
use App\Chat;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Pusher\Pusher;

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

    public function destroyAll($id)
    {
        $item = $this->model()::findOrFail($id);

        if ($item->delete()) {
            return redirect()->route('inbox.index')->with('success', 'Xóa thành công!');
        } else
            return redirect()->back()->with('error', 'Xóa thất bại!');
    }

    public function reply(Request $request)
    {
        try {
            $client = $this->model()::findorfail($request->id);
            Chat::create([
                'client_id' => $client->id,
                'message' => $request->message,
                'user_id' => auth()->user()->id,
                'type_chat' => 'reply'
            ]);

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
            $data['is'] = true ;
            $pusher->trigger($client->name, 'my-event', $data);

            return response()->json([
                'status' => 200,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status' => 500,
            ]);
        }

    }

    private function model()
    {
        return Client::class;
    }

}
