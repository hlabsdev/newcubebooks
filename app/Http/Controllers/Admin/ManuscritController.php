<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manuscrit;

class ManuscritController extends Controller
{
    public function liste() {

        $manuscrits = Manuscrit::all();

        return view('admins.users.manuscrit', [
            'manuscrits' => $manuscrits
        ]);
    }
}
