
<?php
use App\Models\Auteur;
use App\Models\CodeEmail;
use App\Models\Commentaire;
use App\Models\Contact;
use App\Models\Gerant;
use App\Models\LivreNotification;
use App\Models\Manuscrit;
use App\Models\Message;
use App\Models\Pays;
use App\Models\Publication;
use App\Models\Publicite;
use App\Models\ReponseCommentaire;
use App\Models\StoreProduit;
use App\Models\User;
?>

@extends('layouts.header')

@section('css')
    <style>
        @media(min-width: 1480px) {
            .side-bar-left {
                position: absolute;
                top: 60px;
                left: 15%;
                width: 16%;
                bottom: 0;
                padding-right: 5px;
                border-right: 1px solid #CCC;
            }

            .side-bar-right {
                position: absolute;
                top: 60px;
                right: 15%;
                width: 16%;
            }

            .content-center {
                position: absolute;
                top: 60px;
                right: 31%;
                left: 31%;
                padding: 0 20px 20px 20px;
            }
        }
    </style>
@endsection

@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        <div class="pr-2 pl-2" style="border: none !important;">
            <div class="container-fluid white">
                <div class="row">
                    <div class="col-12">
                        <div class="white pt-3 pb-3">
                            <a href="#!" data-toggle="modal" data-target="#modelId">
                                <i class="icofont-plus"></i>
                                <b>Créer un nouveau livre</b>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>LIVRES PAYANTS</b>
                    </div>
                    @forelse (StoreProduit::orderByDesc('id')->where('user_id', $_COOKIE['id'])->get() as $store_produit)
                        <div class="col-lg-6">
                            <div class="card z-depth-0">
                                <div style="height: 100px; overflow: hidden;">
                                    <img class="card-img-top" src="{{ URL::asset($store_produit->fichier) }}" alt="">
                                </div>
                                <div class="card-body pb-2 pt-2 pl-0 pr-0">

                                    <a href="" class="blue-grey-text">
                                        {{ $store_produit->nom }}
                                    </a>

                                    <h6 class="text-left mb-2 mt-1 font-size-14"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                                    <h6 class="text-left mb-2 mt-1 font-size-14"><b>Maison d'édition ou compte d'auteur</b><br />{{ $store_produit->maison_edition }}</h6>

                                    <p class="card-text text-center">
                                        <a href="{{ route('usersCubeStoreEditProduit', [$store_produit->id, 'type' => 'payant']) }}">
                                            <i class="icofont-edit"></i>
                                            Modifier
                                        </a> |
                                        <a href="{{ route('adminCubeStoreDestroyProduit', [$store_produit->id, 'type' => 'payant']) }}" class="red-text" onclick="return confirm('Êtes-vous sûre de vouloi supprimer ce produit ?')">
                                            <i class="icofont-bin"></i>
                                            Supprimer
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <b class="grey-text">Pas de livres payants ajoutés !</b>
                        </div>
                    @endforelse
                </div><br /><br />
                <div class="row">
                    <div class="col-12">
                        <b>LIVRES GRATUITS</b>
                    </div>
                    @forelse (\DB::table('livres_gratuits')->where('user_id', $_COOKIE['id'])->orderByDesc('id')->get() as $store_produit)
                        <div class="col-lg-6">
                            <div class="card z-depth-0">
                                <div style="height: 100px; overflow: hidden;">
                                    <img class="card-img-top" src="{{ URL::asset($store_produit->couverture) }}" alt="">
                                </div>
                                <div class="card-body pb-2 pt-2 pl-0 pr-0">

                                    <a href="" class="blue-grey-text">
                                        {{ $store_produit->nom }}
                                    </a>

                                    <h6 class="text-left mb-2 mt-1 font-size-14"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                                    <h6 class="text-left mb-2 mt-1 font-size-14"><b>Maison d'édition ou compte d'auteur</b><br />{{ $store_produit->maison_edition }}</h6>

                                    <p class="card-text text-center">
                                        <a href="{{ route('usersCubeStoreEditProduit', [$store_produit->id, 'type' => 'gratuit']) }}">
                                            <i class="icofont-edit"></i>
                                            Modifier
                                        </a> |
                                        <a href="{{ route('adminCubeStoreDestroyProduit', [$store_produit->id, 'type' => 'gratuit']) }}" class="red-text" onclick="return confirm('Êtes-vous sûre de vouloi supprimer ce produit ?')">
                                            <i class="icofont-bin"></i>
                                            Supprimer
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <b class="grey-text">Pas de livres gratuits ajoutés !</b>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Créer un nouveau livre</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('adminCubeStoreStoreProduit') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="fichier" class="border border-dark w-100" required>

                                <input type="text" class="form-control mb-2 mt-2" required name="nom" placeholder="Saisir le titre du livre ...">

                                <input type="text" class="form-control mb-2" required name="nom_auteur" placeholder="Saisir l'auteur du livre ...">

                                <select class="custom-select mb-2" name="categorie" id="categorieSelect" required>
                                    <option selected value="">Sélectionner la catégorie du livre</option>
                                    <option value="Essai">Essai</option>
                                    <option value="Nouvelle">Nouvelle</option>
                                    <option value="Roman">Roman</option>
                                    <option value="Poésie">Poésie</option>
                                    <option value="Livre pratique">Livre pratique</option>
                                    <option value="Théâtre">Théâtre</option>
                                    <option value="Livre jeunesse">Livre jeunesse</option>
                                    <option value="Biographie">Biographie</option>
                                    <option value="Autobiographie">Autobiographie</option>
                                    <option value="Conte">Conte</option>
                                    <option value="Chronique">Chronique</option>
                                    <option value="Fable">Fable</option>
                                    <option value="Science-fiction">Science-fiction</option>
                                    <option value="Roman policier">Roman policier</option>
                                    <option value="Éloge">Éloge</option>
                                    <option value="Parodie">Parodie</option>
                                    <option value="Mémoire">Mémoire</option>
                                    <option value="Magazine">Magazine</option>
                                    <option value="Journal">Journal</option>
                                    <option value="Micronouvelle">Micronouvelle</option>
                                    <option value="Fantastique">Fantastique</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Horreur">Horreur</option>
                                    <option value="Épopée">Épopée</option>
                                    <option value="Bande dessinée">Bande dessinée</option>
                                    <option value="Roman d'amour">Roman d'amour</option>
                                    <option value="Livre scolaire">Livre scolaire</option>
                                    <option value="Livre pour enfant">Livre pour enfant</option>
                                    <option value="Beaux-Arts">Beaux-Arts</option>
                                    <option value="Communication">Communication</option>
                                    <option value="Économie et management">Économie et management</option>
                                    <option value="Éducation">Éducation</option>
                                    <option value="Études littéraires, critiques">Études littéraires, critiques</option>
                                    <option value="Gastronomie - Cuisine">Gastronomie - Cuisine</option>
                                    <option value="Histoire - Géographie">Histoire - Géographie</option>
                                    <option value="Linguistique">Linguistique</option>
                                    <option value="Littérature">Littérature</option>
                                    <option value="Philosophie">Philosophie</option>
                                    <option value="Psychanalyse - Psychologie">Psychanalyse - Psychologie</option>
                                    <option value="Sciences et Santé">Sciences et Santé</option>
                                    <option value="Sciences Humaines - Ethnologie - Sociologie">Sciences Humaines - Ethnologie - Sociologie</option>
                                    <option value="Sciences Politiques et sociales">Sciences Politiques et sociales</option>
                                    <option value="Architecture">Architecture</option>
                                    <option value="Arts plastiques">Arts plastiques</option>
                                    <option value="Cinéma, photographie">Cinéma, photographie</option>
                                    <option value="Danse">Danse</option>
                                    <option value="Design">Design</option>
                                    <option value="Musique, chanson">Musique, chanson</option>
                                    <option value="Opéra">Opéra</option>
                                    <option value="Peinture, dessin">Peinture, dessin</option>
                                    <option value="Bien-être, Développement personnel">Bien-être, Développement personnel</option>
                                    <option value="autres">Autres (à préciser)</option>
                                </select>

                                <input type="text" class="form-control mb-2" name="autre_categorie" placeholder="Autre catégorie à préciser ..." id="autreCategorieInput">

                                <input type="text" class="form-control mb-2" required name="maison_edition" placeholder="Saisir la maison d'édition ou mettre 'compte d'auteur' ...">

                                <div class="form-group">
                                    <textarea class="form-control" name="details" placeholder="Saisir le résumé du livre ici ..." rows="3"></textarea>
                                </div>

                                <div class="font-size-14">
                                    <b>Formats existants :</b><br />

                                    <table class="w-100">
                                        <tr>
                                            <td>
                                                <b class="font-weight-bold">
                                                    Sélectionnez la devise
                                                </b>
                                            </td>
                                            <td>
                                                <select class="custom-select custom-select-sm" name="devise_livre_papier">
                                                    <option selected value="">Devise</option>
                                                    <option value="F CFA">F CFA</option>
                                                    <option value="EUR">EUR</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="custom-select custom-select-sm">
                                                    <option value="USD">USD</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format1" class="font-size-14">Livre papier</label>
                                                <input type="checkbox" name="livre_papier" id="format1">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_livre_papier" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_usd_livre_papier" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format2" class="font-size-14">Livre numérique PDF,E-pub...</label>
                                                <input type="checkbox" name="livre_pdf" id="format2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_livre_pdf" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_usd_livre_pdf" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format4" class="font-size-14">Livre audio</label>
                                                <input type="checkbox" name="livre_audio" id="format4">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_livre_audio" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_usd_livre_audio" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format5" class="font-size-14">Livre vidéo</label>
                                                <input type="checkbox" name="livre_video" id="format5">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_livre_video" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_usd_livre_video" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format3" class="font-size-14">Abonnement mensuel</label>
                                                <input type="checkbox" name="abonnement" id="format3">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_abonnement" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                            <td width="130">
                                                <input type="number" name="prix_usd_abonnement" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="editCover">
                                    <textarea name="texte" id="edit" cols="30" rows="10"></textarea>
                                </div>
                                <br />
                                <button type="submit" class="btn btn-indigo rounded btn-md btn-block z-depth-0">
                                    <span class="white-text">Créer le livre</span>
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
	<script>
		$(document).ready(function () {
            $('#avatar').change(function() {
                $('#avatarForm').submit();
            });
            setInterval(() => {
                $.ajax({
                    type : "GET",
                    url : "{{ route('getBadgeNotifications') }}",
                    data : {},
                    success : function(status) {
                        if (status != 0) {
                            $('.nbNotifications').html("<span class='red white-text pl-1 pr-1'>" + status + "</span>");
                        }
                    }
                });
            }, 2000);
		});
	</script>
@endsection
