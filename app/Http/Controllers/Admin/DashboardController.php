<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\MessageAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function newMessage() {
        return MessageAdmin::newMessage();
    }

    public function index()
    {
        $newMessage = $this->newMessage();
        return view('admin.dashboard', compact('newMessage'));
    }
}
