<?php

namespace App\Http\Controllers\Component;

use App\Client;

class InboxAdmin
{
    protected static function model() {
        return Client::class;
    }

    public static function newInbox() {
        return self::model()::where(['status' => '0'])->get();
    }
}
