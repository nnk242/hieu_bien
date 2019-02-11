<?php

namespace App\Http\Controllers\Component;


use App\Message;

class MessageAdmin
{
    protected static function model() {
        return Message::class;
    }

    public static function newMessage() {
        return self::model()::where(['status' => '0'])->get();
    }
}
