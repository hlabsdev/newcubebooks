<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LivreNotification;

class NotificationController extends Controller
{
    public function liste() {

        $livre_notifications = LivreNotification::orderByDesc('id')->paginate(20);

        return view('admins.notifications', [
            'livre_notifications' => $livre_notifications
        ]);
    }

    public function readAll() {

        \DB::update('UPDATE livre_notifications SET lu = ?', [1]);

        return back();
    }
}
