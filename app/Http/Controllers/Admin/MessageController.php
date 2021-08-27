<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function liste() {
        return view('admins.message');
    }

    public function store(Request $request) {

        $message = new Message;
        $message->env_id = 0;
        $message->message = $request->message;
        $message->lu = 0;
        $message->save();

        return back();
    }

    public function storeUser() {
        return back();
    }
}
