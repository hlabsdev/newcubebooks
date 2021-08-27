<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Publicite;

class MainController extends Controller
{
    public function index()
    {
        if (!isset($_COOKIE['id'])) {
            abort("404");
        } else {

            foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                }
            }

            return view('users.index');
        }
    }

    public function contacts()
    {
        $contacts = Contact::where('user_id', $_COOKIE['id'])->orWhere('contact_id', $_COOKIE['id'])->paginate(10);

        return view('users.contacts', [
            'contacts' => $contacts
        ]);
    }

    public function logout()
    {
        if (isset($_COOKIE['id'])) {
            setcookie('id', $_COOKIE['id'], time() - 366, "/", null, false, true);
            return redirect(route('indexVisitors'));
        }

        if (isset($_COOKIE['gerant_id'])) {
            setcookie('gerant_id', $_COOKIE['gerant_id'], time() - 366, "/", null, false, true);
            return redirect(route('indexVisitors'));
        }

    }

    public function allUsers() {

        $users = User::orderByDesc('id')->paginate(30);

        return view('users.all', [
            'users' => $users
        ]);
    }

    public function resultSearch(Request $request) {

        $users = User::where('name', 'like', '%' . $request->search_q . '%')->orWhere('profession', 'like', '%' . $request->search_q . '%')->orWhere('ville', 'like', '%' . $request->search_q . '%')->orWhere('quartier', 'like', '%' . $request->search_q . '%')->get();

        return view('ajax.users.users_search', [
            'users' => $users
        ]);
    }

    public function allPublicites() {
        if(!isset($_COOKIE['gerant_id'])) {
            abort('404');
        } else {
            return view('admins.publicites');
        }
    }

    public function storePublicite(Request $request) {
        if ($request->fichier != "") {
            $target_dir = "db/publicites/";

            $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($_FILES["fichier"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return back()->with('error', "Le type du fichier n'est pas pris en charge !");
            }

            $target_file = $target_dir . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
                $publicite = new Publicite;
                $publicite->image = $target_file;
                $publicite->save();
                 return back()->with('success', "Publicité ajoutée avec succès !");
            }
        }
    }

    public function destroyPublicite($id) {
        if(!isset($_COOKIE['gerant_id'])) {
            abort('404');
        } else {
            Publicite::where('id', $id)->delete();

            return back()->with('success', 'publicité supprimée avec succès !');
        }
    }

    public function listAuteurs() {
        return view('users.auteurs');
    }

    public function librairie($id) {
        return view('users.librairie', [
            'id' => $id
        ]);
    }
}
