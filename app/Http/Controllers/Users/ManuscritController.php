<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manuscrit;
use App\Models\User;

class ManuscritController extends Controller
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

        return view('users.manuscrits.liste');
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
        $manuscrit = new Manuscrit;
        $manuscrit->user_id = $_COOKIE['id'];
        $manuscrit->titre = $request->titre;
        $manuscrit->resume = $request->resume;

        if ($request->manuscrit != "") {
            $target_dir = "db/manuscrits/";

            $target_file = $target_dir . basename($_FILES["manuscrit"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($_FILES["manuscrit"]["size"] > 50000000) {
                return back()->with('error', "La taille du manuscrit chargé est trop volumineuse !");
            }

            if ($imageFileType != "docx" && $imageFileType != "doc") {
                return back()->with('error', "Le type du manuscrit n'est pas pris en charge !");
            }

            $target_file = $target_dir . $_COOKIE['id'] . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["manuscrit"]["tmp_name"], $target_file)) {
                $manuscrit->manuscrit = $target_file;
            }
        }

        if ($request->couverture != "") {
            $target_dir = "db/couvertures/";

            $target_file = $target_dir . basename($_FILES["couverture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($_FILES["couverture"]["size"] > 50000000) {
                return back()->with('error', "La taille du couverture chargé est trop volumineuse !");
            }

            if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                return back()->with('error', "Le type du couverture n'est pas pris en charge !");
            }

            $target_file = $target_dir . $_COOKIE['id'] . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["couverture"]["tmp_name"], $target_file)) {
                $manuscrit->couverture = $target_file;
            }
        }

        $manuscrit->save();

        return back()->with('success', "Manuscrit ajouté avec succès !");

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manuscrit = Manuscrit::where('id', $id)->delete();

        return back()->with('success', "Manuscrit supprimé avec succès !");
    }
}
