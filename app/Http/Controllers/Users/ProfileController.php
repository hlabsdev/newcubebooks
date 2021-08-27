<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_COOKIE['user_id'])) {
            foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                }
            }
        }

        return view('users.profile.details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->profession = $request->profession;
        $user->code_postal = $request->code_postal;
        $user->pays_id = $request->pays_id;
        $user->ville = $request->ville;
        $user->quartier = $request->quartier;
        $user->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function foreign($id)
    {

        if (isset($_COOKIE['user_id'])) {
            foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                }
            }
        }

        return view('users.profile.foreign', [
            "id" => $id
        ]);
    }

    public function visible(Request $request)
    {
        $user = User::find($_COOKIE['id']);
        $user->visible = $request->visible;
        $user->save();

        return "on";
    }

    public function other($id)
    {

        foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
            if ($user->banni == 1) {
                return redirect(route('logout'));
            }
        }

        return view('users.profile.other_user', [
            "user_id" => $id
        ]);
    }

    public function avatar()
    {
        $target_dir = "db/avatars/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $target_upload = $_COOKIE['id'] . "." .  $imageFileType;

        if ($_FILES["avatar"]["size"] <= 3000000) {
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
            || $imageFileType == "gif" ) {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_upload)) {
                    $user = User::find($_COOKIE['id']);
                    $user->avatar = $target_upload;
                    $user->save();
                } else {
                    return back()->with('error', "Image non auvegardée. Réessayez !");
                }
            } else {
                return back()->with('error', "Image non supporté. Réessayez !");
            }
        } else {
            return back()->with('error', "Taille de l'image trop grande. Réessayez !");
        }


        return back();
    }

    public function livres()
    {
        foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
            if ($user->banni == 1) {
                return redirect(route('logout'));
            }
        }

        return view('users.livres.liste');
    }
}
