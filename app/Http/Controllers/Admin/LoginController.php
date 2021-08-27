<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gerant;

class LoginController extends Controller
{
    public function login() {
        return view('admins.login');
    }

    public function loginForm(Request $request) {
        $users = Gerant::where('email', $request->email)->get();

        if (count($users) == 0) {
            return back()->with('error', "Email incorect !");
        } else {
            foreach ($users as $user) {
                $password = $user->password;
            }
            if (\Hash::check($request->password, $password)) {
                setcookie('gerant_id', $user->id, time() + 365*24*3600, "/", null, false, true);

                if (isset($_COOKIE['id'])) {
                    setcookie('id', $_COOKIE['id'], time() - 366, "/", null, false, true);
                    return redirect(route('indexVisitors'));
                }

                return redirect(route('adminCubeStoreListeProduits'));
            } else {
                return back()->with('error', "Mot de passe incorrect !");
            }
        }
    }
}
