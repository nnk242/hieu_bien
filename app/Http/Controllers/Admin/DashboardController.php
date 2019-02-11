<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\MessageAdmin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
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
        $newMessage = $this->newMessage();
        return view('admin.dashboard', compact('newMessage'));
    }

    public function changePassword(Request $request)
    {

        if (Auth::Check()) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'old_password' => 'required',
                'password' => 'required',
                're_password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Thông tin mật khẩu không chính xác!');
            } else {
                $current_password = Auth::User()->password;
                if (Hash::check($data['old_password'], $current_password)) {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($data['password']);
                    $obj_user->save();
                    return redirect()->back()->with('success', 'Đã thay đổi thành công!');
                } else {
                    return redirect()->back()->with('error', 'Bạn hãy xem lại!');
                }
            }
        } else {
            return redirect()->back();
        }
    }
}
