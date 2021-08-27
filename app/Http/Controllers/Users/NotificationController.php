<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\ReponseCommentaire;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_COOKIE['id'])) {
            foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                }
            }
        } else {
            abort('404');
        }

        return view('users.notifications.list');
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
    public function show($publication_id, $id)
    {
        $commentaire = Commentaire::find($id);

        if (!isset($_COOKIE['id'])) {
            abort("404");
        } else {

            foreach (User::where('id', $_COOKIE['id'])->get() as $user) {
                if ($user->banni == 1) {
                    return redirect(route('logout'));
                }
            }

            $commentaire->vu = 1;
            $commentaire->save();

            return view('users.notifications.show', [
                'publication_id' => $publication_id,
                'commentaire_id' => $id
            ]);
        }


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
        //
    }

    public function count()
    {
        if (!isset($_COOKIE['id'])) {
            return "!";
        } else {
            $commentaires = count(Commentaire::where("user_id", $_COOKIE['id'])->where('commenter_id', '<>', $_COOKIE['id'])->where('vu', 0)->get());

            $reponse_commentaires = count(ReponseCommentaire::where("user_id", $_COOKIE['id'])->where('commenter_id', '<>', $_COOKIE['id'])->where('vu', 0)->get());

            return $commentaires + $reponse_commentaires;
        }

    }
}
