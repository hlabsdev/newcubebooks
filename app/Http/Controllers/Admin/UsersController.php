<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function liste() {
        $other_users = User::orderByDesc('id')->paginate(40);
        return view('admins.users.liste', [
            'other_users' => $other_users
        ]);
    }

    public function show($id) {

        return view('admins.users.show', [
            'id' => $id
        ]);
    }

    public function block($id) {

        $user = User::find($id);
        $user->banni = 1;
        $user->save();

        return back()->with('success', "Utilisateur bloqué avec succès !");
    }

    public function unBlock($id) {

        $user = User::find($id);
        $user->banni = 0;
        $user->save();

        return back()->with('success', "Utilisateur débloqué avec succès !");
    }

    public function search(Request $request) {

        $other_users = User::where('name', 'like', '%' . $request->search_q . '%')->orWhere('profession', 'like', '%' . $request->search_q . '%')->get();

        return view('ajax.admins.users.search', [
            'other_users' => $other_users
        ]);
    }
}
