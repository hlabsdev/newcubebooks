<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
            if ($user->banni == 1) {
                return redirect(route('logout'));
            }
        }

        return view('users.publications.list');
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
        if (isset($_COOKIE['id'])) {
            if(trim($request->fichier) == "") {
                return back()->with('error', "La publication que vous voulez partager doit avoir au moins un fichier !");
            } else {
                $publication = new Publication;
                $publication->user_id = $_COOKIE['id'];
                $publication->categorie = "null";
                $publication->but = "null";
                $publication->prix = 0;
                $publication->texte = $request->texte;
                $publication->autorise = 0;

                if ($request->fichier != "") {
                    $target_dir = "db/publications/";

                    $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    if ($_FILES["fichier"]["size"] > 50000000) {
                        return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
                    }

                    if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        return back()->with('error', "Le type du fichier n'est pas pris en charge !");
                    }

                    $target_file = $target_dir . $_COOKIE['id'] . time() . "." . $imageFileType;

                    if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
                        $publication->fichier = $target_file;
                    }
                }

                $publication->save();

                return back();
            }
        } else {
            abort("404");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
            if ($user->banni == 1) {
                return redirect(route('logout'));
            }
        }


        return view('users.publications.all_users', [
            'user_id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
            if ($user->banni == 1) {
                return redirect(route('logout'));
            }
        }

    	if(count(Publication::where('id', $id)->get()) == 0) {
    		return back();
    	}

        $publication = Publication::find($id);

        if ($publication->user_id != $_COOKIE['id']) {
            abort('404');
        } else {
            return view('users.publications.edit', [
                "id" => $id
            ]);
        }

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
    	if(count(Publication::where('id', $id)->get()) == 0) {
    		return back();
    	}

        $publication = Publication::find($id);
        $publication->texte = $request->texte;
        if ($request->but != "") {
            $publication->but = "null";
        }
        if ($request->fichier != "") {
            $target_dir = "db/publications/";

            $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($_FILES["fichier"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return back()->with('error', "Le type du fichier n'est pas pris en charge !");
            }

            $target_file = $target_dir . $_COOKIE['id'] . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
                $publication->fichier = $target_file;
            }
        }
        $publication->save();

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
    	if(count(Publication::where('id', $id)->get()) == 0) {
    		return back();
    	}

        $publication = Publication::find($id);
        if(isset($_COOKIE['id'])) {
            if ($publication->user_id != $_COOKIE['id']) {
                abort('404');
            } else {
                $publication->delete();
                return back();
            }
        } else {
            if(isset($_COOKIE['gerant_id'])) {
                $publication->delete();
                return back();
            } else {
                abort('404');
            }
        }
    }

    public function all()
    {

        if(!isset($_COOKIE['gerant_id'])) {
           foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                } else {
                    return view('users.publications.all');
                }
            }
        } else {

    	    return view('users.publications.all');

        }
    }
}
