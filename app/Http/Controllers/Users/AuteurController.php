<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auteur;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.auteurs.liste');
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
        $auteur = new Auteur;
        if (isset($_COOKIE['id'])) {
            $auteur->user_id = $_COOKIE['id'];
        } else {
            $auteur->user_id = 0;
        }
        $auteur->nom_complet = $request->nom_complet;
        $auteur->description = "Description";
        $auteur->biographie = $request->biographie;
        $auteur->bibiographie = $request->bibiographie;

        if ($request->couverture != "") {
            $target_dir_couverture = "db/auteurs/";

            $target_file_couverture = $target_dir_couverture . basename($_FILES["couverture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_couverture,PATHINFO_EXTENSION));

            if ($_FILES["couverture"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_couverture = $target_dir_couverture . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["couverture"]["tmp_name"], $target_file_couverture)) {
                $auteur->photo = $target_file_couverture;
            }

        }
        $auteur->lien = $request->lien;
        $auteur->save();

        return back()->with('success', "Auteur ajouté avec succès !");
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
        return view('users.auteurs.show', [
            'id' => $id
        ]);
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
        $auteur = Auteur::find($id);
        $auteur->nom_complet = $request->nom_complet;
        $auteur->description = "Description";
        $auteur->biographie = $request->biographie;
        $auteur->bibiographie = $request->bibiographie;

        if ($request->couverture != "") {
            $target_dir_couverture = "db/auteurs/";

            $target_file_couverture = $target_dir_couverture . basename($_FILES["couverture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_couverture,PATHINFO_EXTENSION));

            if ($_FILES["couverture"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_couverture = $target_dir_couverture . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["couverture"]["tmp_name"], $target_file_couverture)) {
                $auteur->photo = $target_file_couverture;
            }

        }

        $auteur->lien = $request->lien;
        $auteur->save();

        return back()->with('success', "Auteur ajouté avec succès !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($_COOKIE['gerant_id'])) {
            Auteur::where('id', $id)->delete();

            return back()->with('success', "Ateur supprimé avec succès !");
        } else {
            if (isset($_COOKIE['id'])) {
                if (count(Auteur::where('user_id', $_COOKIE['id'])->where('id', $id)->get()) == 0) {
                    abort('404');
                } else {
                    Auteur::where('id', $id)->delete();

                    return back()->with('success', "Ateur supprimé avec succès !");
                }

            } else {
                abort('404');
            }

        }
    }
}
