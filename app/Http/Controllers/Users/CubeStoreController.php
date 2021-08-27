<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreProduit;

class CubeStoreController extends Controller
{
    public function commander($nom, $id) {

        if (count(StoreProduit::where('id', $id)->get()) == 0) {
            abort('404');
        } else {

            \DB::update('UPDATE livre_notifications set lu = ? WHERE id = ?', [1, $id]);

            return view('users.commander', [
                'nom' => $nom,
                'id' => $id
            ]);
        }
    }

    public function cubeStore() {
        return view('users.cubestore');
    }

    public function resultSearch(Request $request) {

        $results = StoreProduit::where('nom', 'like', '%' . $request->search_q . '%')
                                ->orWhere('nom_auteur', 'like', '%' . $request->search_q . '%')
                                ->orWhere('maison_edition',  'like', '%' . $request->search_q . '%')
                                ->orWhere('categorie',  'like', '%' . $request->search_q . '%')
                                ->get();

        return view('ajax.users.livres.search', [
            'results' => $results
        ]);
    }

    public function livreGratuit() {

        if(!isset($_COOKIE['id'])) {
    	   return redirect(route('login'))->with('error', "Pour accéder aux livres gratuits, vous devez vous connecter ou créer un compte si vous n'êtes pas encore inscrit.");
    	}

        return view('users.livres_gratuits');
    }

    public function DownloadLivreGratuit($nom, $id) {
        if (count(\DB::table('livres_gratuits')->where('id', $id)->get()) == 0) {
            abort('404');
        } else {

            if(!isset($_COOKIE['id'])) {
        	   return redirect(route('login'))->with('error', "Pour accéder aux livres gratuits, vous devez vous connecter ou créer un compte si vous n'êtes pas encore inscrit.");
        	}

            \DB::update('UPDATE livre_notifications set lu = ? WHERE id = ?', [1, $id]);

            return view('users.telecharger', [
                'nom' => $nom,
                'id' => $id
            ]);
        }
    }
}
