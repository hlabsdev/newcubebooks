<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodeEmail;
use App\Models\User;

class RegisterCotroller extends Controller
{
    public function registerForm(Request $request)
    {
        if (count(User::where('email', $request->email)->get()) != 0) {
            return back()->with('error', "Email déjà utlisé !");
        } else {

            setcookie('pays', $request->pays, time() + 365*24*3600, "/", null, false, true);
                setcookie('ville', $request->ville, time() + 365*24*3600, "/", null, false, true);
                setcookie('quartier', $request->quartier, time() + 365*24*3600, "/", null, false, true);
                setcookie('email', $request->email, time() + 365*24*3600, "/", null, false, true);

            /*$code = rand(154789, 986899);

            if (count(CodeEmail::where('email', $request->email)->get()) == 0) {

                $code_email = new CodeEmail;
                $code_email->email = $request->email;
                $code_email->code = $code;
                $code_email->pays_id = $request->pays;
                $code_email->ville = $request->ville;
                $code_email->quartier = $request->quartier;
                $code_email->save();

            } else {
                foreach (CodeEmail::where('email', $request->email)->get() as $code_email) {
                    $code_id = $code_email->id;
                }

                $code_email = CodeEmail::find($code_id);
                $code_email->email = $request->email;
                $code_email->code = $code;
                $code_email->pays_id = $request->pays;
                $code_email->ville = $request->ville;
                $code_email->quartier = $request->quartier;
                $code_email->save();
            }

            $to_name = "Dolli";

            $to_email = $request->email;
            $data = array(
                'email' => $request->email,
                'code' => $code
            );

            \Mail::send('mails_views.code_password', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                ->subject("Confirmation email");
            });*/

            return redirect(route('password'));
        }
    }

    public function emailSent()
    {
        return view('visitors.email_sent');
    }

    public function password(Request $request)
    {

        /*$code_emails = CodeEmail::where("code", $request->code)->where('email', $request->email)->get();

        if (count($code_emails) == 0) {
            abort("404");
        } else {

            foreach ($code_emails as $code_email) {
                setcookie('pays', $code_email->pays_id, time() + 365*24*3600, "/", null, false, true);
                setcookie('ville', $code_email->ville, time() + 365*24*3600, "/", null, false, true);
                setcookie('quartier', $code_email->quartier, time() + 365*24*3600, "/", null, false, true);
                setcookie('email', $code_email->email, time() + 365*24*3600, "/", null, false, true);
            }

            return view('visitors.password');
        }*/


        return view('visitors.password');
    }

    public function passwordForm(Request $request)
    {
        if (!isset($_COOKIE['email'])) {
            abort("404");
        } else {
            if ($request->password != $request->password_confirm) {
                return back()->with('error', "Les deux mot de passe ne sont pas identiques !");
            } else {
                setcookie('password', bcrypt($request->password), time() + 365*24*3600, "/", null, false, true);
                return redirect(route('datas'));
            }
        }
    }

    public function datas()
    {
        if (!isset($_COOKIE['email'])) {
            abort("404");
        } else {
            return view('visitors.datas');
        }
    }

    public function datasForm(Request $request)
    {
        if (!isset($_COOKIE['email'])) {
            abort("404");
        } else {

            $tab = [
                "a", "z", "e", "r", "t", "y", "u", "i", "o", "p", "q", "s", "d", "f",
                "g", "h", "j", "k", "l", "m", "w", "x", "c", "v", "b", "n", "A", "Z",
                "E", "R", "T", "Y", "U", "I", "O", "P", "Q", "S", "D", "F", "G", "H",
                "J", "K", "L", "M", "W", "X", "C", "V", "B", "N", "0", "1", "2", "3",
                "4", "5", "6", "7", "8", "9", "$", "P", "?", ";", "§", "-", ",", ":"
            ];

            $loop = true;
            $private = "";
            $public = "";

            for ($i=0; $i < 26; $i++) {
                $private .= $tab[rand(0, 41)];
                $public .= $tab[rand(0, 41)];
            }

            $user = new User;
            $user->name = $request->nom_complet;
            $user->email = $_COOKIE['email'];
            $user->telephone = $request->telephone;
            $user->profession = $request->profession;
            $user->code_postal = $request->code_postal;
            $user->bien_service = "null";
            $user->avatar = "default.png";
            $user->visible = 1;
            $user->banni = 0;
            $user->cle_privee = $private;
            $user->cle_publique = $public;
            $user->pays_id = $_COOKIE['pays'];
            $user->ville = $_COOKIE['ville'];
            $user->quartier = $_COOKIE['quartier'];
            $user->password = $_COOKIE['password'];
            $user->save();

            $to_name = "Dolli";

            $to_email = $_COOKIE['email'];
            $data = array(
                'cle_privee' => $private,
                'cle_publique' => $public,
                'name' => $request->nom_complet
            );

            \DB::delete("DELETE FROM code_emails WHERE email = ?", [$_COOKIE['email']]);

            setcookie('pays', $request->pays, time() - 366, "/", null, false, true);
            setcookie('ville', $request->ville, time() - 366, "/", null, false, true);
            setcookie('quartier', $request->quartier, time() - 366, "/", null, false, true);
            setcookie('email', $_COOKIE['email'], time() - 366, "/", null, false, true);
            setcookie('password', $_COOKIE['email'], time() - 366, "/", null, false, true);

            /*\Mail::send('mails_views.success_register', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                ->subject("Clés et contre indications");
            });*/

            setcookie('id', $user->id, time() + 365*24*3600, "/", null, false, true);

            return redirect(route('indexUsers'));

            //return redirect(route('successRegister'));
        }
    }

    public function success()
    {
        if (!isset($_COOKIE['id'])) {
            abort("404");
        } else {
            return view('visitors.success_register');
        }
    }
}
