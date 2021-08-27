<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
    	if(isset($_COOKIE['id'])) {
    	   return redirect(route('indexUsers'));
    	} else {
    	   return view('visitors.index');
    	}
    }

    public function about()
    {
        return view('visitors.about');
    }

    public function contacts()
    {
    	if(isset($_COOKIE['id'])) {
    	   return redirect(route('indexUsers'));
    	}
        return view('visitors.contacts');
    }

    public function login()
    {
    	if(isset($_COOKIE['id'])) {
    	   return redirect(route('indexUsers'));
    	}
        return view('visitors.login');
    }

    public function loginForm(Request $request)
    {
        $users = User::where('email', $request->email)->get();

        if (count($users) == 0) {
            return back()->with('error', "Email incorect !");
        } else {
            foreach ($users as $user) {
                $password = $user->password;
                $banni = $user->banni;
                $id = $user->id;
            }
            if ($banni == 0) {

                if($password == "") {
                    $user_update = User::find($id);
                    $user_update->password = bcrypt($request->password);
                    $user_update->save();

                    if (isset($_COOKIE['gerant_id'])) {
                            setcookie('gerant_id', $_COOKIE['gerant_id'], time() - 366, "/", null, false, true);
                        }

                        setcookie('id', $user->id, time() + 365*24*3600, "/", null, false, true);
                        return redirect(route('indexUsers'));

                } else {
                    if (\Hash::check($request->password, $password)) {

                        if (isset($_COOKIE['gerant_id'])) {
                            setcookie('gerant_id', $_COOKIE['gerant_id'], time() - 366, "/", null, false, true);
                        }

                        setcookie('id', $user->id, time() + 365*24*3600, "/", null, false, true);
                        return redirect(route('indexUsers'));
                    } else {
                        return back()->with('error', "Mot de passe incorrect !");
                    }
                }

            } else {
                return back()->with('error', "Il semblerait que votre compte est momentanément indisponible. Veuillez nous laisser un mail pour ce propos.");
            }
        }

    }

    public function register()
    {
    	if(isset($_COOKIE['id'])) {
    	   return redirect(route('indexUsers'));
    	}
        return view('visitors.register');
    }
}
