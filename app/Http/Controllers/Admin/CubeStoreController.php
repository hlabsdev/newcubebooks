<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreProduit;
use App\Models\LivreNotification;

class CubeStoreController extends Controller
{
    public function liste() {

        $store_produits = StoreProduit::orderByDesc('id')->paginate(30);

        return view('admins.cubestore.produits.liste', [
            'store_produits' => $store_produits
        ]);
    }

    public function edit(Request $request, $id) {
        return view('admins.cubestore.produits.edit', [
            'id' => $id,
            'type' => $request->type
        ]);
    }

    public function storeLivreGratuit(Request $request) {
        if (isset($_COOKIE['id'])) {
            $user_id = $_COOKIE['id'];
        } else {
            $user_id = 0;
        }

        $pdf = "";
        $audio = "";
        $video = "";
        $couverture = "";

        if ($request->couverture != "") {
            $target_dir_couverture = "db/livres_gratuits/couverture/";

            $target_file_couverture = $target_dir_couverture . basename($_FILES["couverture"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_couverture,PATHINFO_EXTENSION));

            if ($_FILES["couverture"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_couverture = $target_dir_couverture . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["couverture"]["tmp_name"], $target_file_couverture)) {
                $couverture = $target_file_couverture;
            }

        } else {
            return back()->with('error', "Impossible de partager sans couverture");
        }

        if ($request->pdf != "") {
            $target_dir_pdf = "db/livres_gratuits/pdf/";

            $target_file_pdf = $target_dir_pdf . basename($_FILES["pdf"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_pdf,PATHINFO_EXTENSION));

            if ($_FILES["pdf"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_pdf = $target_dir_pdf . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file_pdf)) {
                $pdf = $target_file_pdf;
            }

        }

        if ($request->audio != "") {
            $target_dir_audio = "db/livres_gratuits/audio/";

            $target_file_audio = $target_dir_audio . basename($_FILES["audio"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_audio,PATHINFO_EXTENSION));

            if ($_FILES["audio"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_audio = $target_dir_audio . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file_audio)) {
                $audio = $target_file_audio;
            }

        }

        if ($request->video != "") {
            $target_dir_video = "db/livres_gratuits/video/";

            $target_file_video = $target_dir_video . basename($_FILES["video"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file_video,PATHINFO_EXTENSION));

            if ($_FILES["video"]["size"] > 50000000) {
                return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
            }

            $target_file_video = $target_dir_video . time() . "." . $imageFileType;

            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file_video)) {
                $video = $target_file_video;
            }

        }

        \DB::insert("INSERT INTO livres_gratuits (user_id, nom, couverture, nom_auteur, categorie, maison_edition, pdf, audio, video, resume, texte)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$user_id, $request->nom, $couverture, $request->nom_auteur, $request->categorie . ", " . $request->autre_categorie
                        , $request->maison_edition, $pdf, $audio, $video, $request->resume, $request->texte]);


        return back()->with('success', "Le livre a été publié avec succès !");

    }

    public function store(Request $request) {

        $store_produit = new StoreProduit;

        if (isset($_COOKIE['id'])) {
            $store_produit->user_id = $_COOKIE['id'];

            $livre_notification = new LivreNotification;
            $livre_notification->user_id = $_COOKIE['id'];
            $livre_notification->titre_livre = $request->nom;

        } else {
            $store_produit->user_id = 0;
        }

        $store_produit->nom = $request->nom;
        $store_produit->nom_auteur = $request->nom_auteur;

        if ($request->categorie == "autres") {
            $store_produit->categorie = $request->autre_categorie;
        } else {
            $store_produit->categorie = $request->categorie;
        }

        $store_produit->maison_edition = $request->maison_edition;
        $store_produit->prix = "0";
        $store_produit->devise = "null";
        $store_produit->unite = "null";
        $store_produit->quantite = "0";
        $store_produit->details = $request->details;
        $store_produit->formats = "null";
        $store_produit->livre_papier = $request->livre_papier;
        $store_produit->prix_livre_papier = $request->prix_livre_papier;
        $store_produit->prix_usd_livre_papier = $request->prix_usd_livre_papier;
        $store_produit->devise_livre_papier = $request->devise_livre_papier;
        $store_produit->livre_pdf = $request->livre_pdf;
        $store_produit->prix_livre_pdf = $request->prix_livre_pdf;
        $store_produit->prix_usd_livre_pdf = $request->prix_usd_livre_pdf;
        $store_produit->devise_livre_pdf = $request->devise_livre_papier;
        $store_produit->livre_audio = $request->livre_audio;
        $store_produit->prix_livre_audio = $request->prix_livre_audio;
        $store_produit->prix_usd_livre_audio = $request->prix_usd_livre_audio;
        $store_produit->devise_livre_audio = $request->devise_livre_papier;
        $store_produit->livre_video = $request->livre_video;
        $store_produit->prix_livre_video = $request->prix_livre_video;
        $store_produit->prix_usd_livre_video = $request->prix_usd_livre_video;
        $store_produit->devise_livre_video = $request->devise_livre_papier;
        $store_produit->abonnement = $request->abonnement;
        $store_produit->prix_abonnement = $request->prix_abonnement;
        $store_produit->prix_usd_abonnement = $request->prix_usd_abonnement;
        $store_produit->devise_abonnement = $request->devise_livre_papier;
        $store_produit->texte = $request->texte;

        if ($request->fichier != "") {
            $target_dir = "db/store_produits/";

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
                $store_produit->fichier = $target_file;
            }

            if (isset($_COOKIE['id'])) {
                $livre_notification->couverture_livre = $target_file;
                $livre_notification->lu = 0;


            }
        }

        $store_produit->save();

        $livre_notification->livre_id = $store_produit->id;
        $livre_notification->save();

        return back()->with('success', "Produit ajouté avec succès !");
    }


    public function update($id, Request $request) {

        if ($request->type == "gratuit") {

            $pdf = $request->pdf_text;
            $audio = $request->audio_text;
            $video = $request->video_text;
            $couverture = $request->couverture_text;

            if ($request->couverture != "") {
                $target_dir_couverture = "db/livres_gratuits/couverture/";

                $target_file_couverture = $target_dir_couverture . basename($_FILES["couverture"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file_couverture,PATHINFO_EXTENSION));

                if ($_FILES["couverture"]["size"] > 50000000) {
                    return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
                }

                $target_file_couverture = $target_dir_couverture . time() . "." . $imageFileType;

                if (move_uploaded_file($_FILES["couverture"]["tmp_name"], $target_file_couverture)) {
                    $couverture = $target_file_couverture;
                }

            }

            if ($request->pdf != "") {
                $target_dir_pdf = "db/livres_gratuits/pdf/";

                $target_file_pdf = $target_dir_pdf . basename($_FILES["pdf"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file_pdf,PATHINFO_EXTENSION));

                if ($_FILES["pdf"]["size"] > 50000000) {
                    return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
                }

                $target_file_pdf = $target_dir_pdf . time() . "." . $imageFileType;

                if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file_pdf)) {
                    $pdf = $target_file_pdf;
                }

            }

            if ($request->audio != "") {
                $target_dir_audio = "db/livres_gratuits/audio/";

                $target_file_audio = $target_dir_audio . basename($_FILES["audio"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file_audio,PATHINFO_EXTENSION));

                if ($_FILES["audio"]["size"] > 50000000) {
                    return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
                }

                $target_file_audio = $target_dir_audio . time() . "." . $imageFileType;

                if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file_audio)) {
                    $audio = $target_file_audio;
                }

            }

            if ($request->video != "") {
                $target_dir_video = "db/livres_gratuits/video/";

                $target_file_video = $target_dir_video . basename($_FILES["video"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file_video,PATHINFO_EXTENSION));

                if ($_FILES["video"]["size"] > 50000000) {
                    return back()->with('error', "La taille du fichier chargé est trop volumineuse !");
                }

                $target_file_video = $target_dir_video . time() . "." . $imageFileType;

                if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file_video)) {
                    $video = $target_file_video;
                }

            }

            \DB::insert("UPDATE livres_gratuits SET nom = ?, couverture = ?, nom_auteur = ?, categorie = ?, maison_edition = ?, pdf = ?,
                        audio = ?, video = ?, resume = ?, texte = ? WHERE id = ?", [$request->nom, $couverture, $request->nom_auteur, $request->categorie . ", " . $request->autre_categorie
                            , $request->maison_edition, $pdf, $audio, $video, $request->resume, $request->texte, $id]);


            return back()->with('success', "Le livre a été mis à jour avec succès !");

        } else {

            $store_produit = StoreProduit::find($id);
            $store_produit->nom = $request->nom;
            $store_produit->nom_auteur = $request->nom_auteur;
            if ($request->categorie == "autres") {
                $store_produit->categorie = $request->autre_categorie;
            } else {
                $store_produit->categorie = $request->categorie;
            }
            $store_produit->maison_edition = $request->maison_edition;
            $store_produit->prix = "0";
            $store_produit->devise = "null";
            $store_produit->unite = "null";
            $store_produit->quantite = "0";
            $store_produit->details = $request->details;
            $store_produit->formats = "null";
            $store_produit->livre_papier = $request->livre_papier;
            $store_produit->prix_livre_papier = $request->prix_livre_papier;
            $store_produit->prix_usd_livre_papier = $request->prix_usd_livre_papier;
            $store_produit->devise_livre_papier = $request->devise_livre_papier;
            $store_produit->livre_pdf = $request->livre_pdf;
            $store_produit->prix_livre_pdf = $request->prix_livre_pdf;
            $store_produit->prix_usd_livre_pdf = $request->prix_usd_livre_pdf;
            $store_produit->devise_livre_pdf = $request->devise_livre_papier;
            $store_produit->livre_audio = $request->livre_audio;
            $store_produit->prix_livre_audio = $request->prix_livre_audio;
            $store_produit->prix_usd_livre_audio = $request->prix_usd_livre_audio;
            $store_produit->devise_livre_audio = $request->devise_livre_papier;
            $store_produit->livre_video = $request->livre_video;
            $store_produit->prix_livre_video = $request->prix_livre_video;
            $store_produit->prix_usd_livre_video = $request->prix_usd_livre_video;
            $store_produit->devise_livre_video = $request->devise_livre_papier;
            $store_produit->abonnement = $request->abonnement;
            $store_produit->prix_abonnement = $request->prix_abonnement;
            $store_produit->prix_usd_abonnement = $request->prix_usd_abonnement;
            $store_produit->devise_abonnement = $request->devise_livre_papier;
            $store_produit->texte = $request->texte;

            if ($request->fichier != "") {
                $target_dir = "db/store_produits/";

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
                    $store_produit->fichier = $target_file;
                }
            }

            $store_produit->save();

            return back()->with('success', "Produit mis à jour avec succès !");

        }
    }

    public function destroy(Request $request, $id) {

        if (isset($_COOKIE['id'])) {

            if ($request->type == "gratuit") {

                if (count(\DB::table('livres_gratuits')->where('user_id', $_COOKIE['id'])->where('id', $id)->get()) == 0) {
                    abort('404');
                } else {
                    \DB::delete("DELETE FROM livres_gratuits WHERE id = ?", [$id]);
                }

            } else {
                if (count(StoreProduit::where('user_id', $_COOKIE['id'])->where('id', $id)->get()) == 0) {
                    abort('404');
                } else {
                    $store_produit = StoreProduit::find($id);
                    $store_produit->delete();
                }

            }

            return back()->with('success', "Produit supprimé avec succès !");

        } else {
            if ($request->type == "gratuit") {

                \DB::delete("DELETE FROM livres_gratuits WHERE id = ?", [$id]);

            } else {
                $store_produit = StoreProduit::find($id);
                $store_produit->delete();
            }

            return back()->with('success', "Produit supprimé avec succès !");
        }

    }

    public function uEdit(Request $request, $id) {
        return view('users.livres.edit', [
            'id' => $id,
            'type' => $request->type
        ]);
    }

    public function resultSearch(Request $request) {

        $results = StoreProduit::where('nom', 'like', '%' . $request->search_q . '%')
                                ->orWhere('nom_auteur', 'like', '%' . $request->search_q . '%')
                                ->orWhere('maison_edition',  'like', '%' . $request->search_q . '%')
                                ->get();

        return view('ajax.admins.livres.search', [
            'results' => $results
        ]);
    }
}
