@extends('layouts.header')

@section('css')
    <style>

        #autreCategorieInput {
            display: none;
        }

        @media(min-width: 1480px) {
            .side-bar-left {
                position: absolute;
                top: 60px;
                left: 15%;
                width: 16%;
                bottom: 0;
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

    <div class="Dosis">
        @include('included.menu_bar_gerant')
    </div>

    <div class="container-fluid white">
        <div class="row">
            @if ($type == "gratuit")

                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    @foreach (\DB::table('livres_gratuits')->where('id', $id)->get() as $store_produit)
                        <div class="col-12">
                            <div class="text-center">
                                <br /><br />
                                <img src="{{ URL::asset($store_produit->couverture) }}" alt="" width="200">
                                <br /><br />
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <form action="{{ route('adminCubeStoreUpdateProduit', $id) }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="type" value="{{ $type }}">

                                <input type="file" name="couverture" class="border border-dark w-100">

                                <input type="hidden" name="couverture_text" class="border border-dark w-100" value="{{ $store_produit->couverture }}">

                                <input type="text" class="form-control mb-2 mt-2" required name="nom" placeholder="Saisir le titre du livre ..."  value="{{ $store_produit->nom }}">

                                <input type="text" class="form-control mb-2" required name="nom_auteur" placeholder="Saisir l'auteur du livre ..." value="{{ $store_produit->nom_auteur }}">

                                <div>
                                    <small>
                                        <b>Catégorie : {{ $store_produit->categorie }}</b>
                                    </small>
                                </div>

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

                                <input type="text" class="form-control mb-2" name="autre_categorie" placeholder="Autre catégorie à préciser ..." id="autreCategorieInput" value="{{ $store_produit->categorie }}">

                                <input type="text" class="form-control mb-2" required name="maison_edition" placeholder="Saisir la maison d'édition ou compte de l'auteur ..." value="{{ $store_produit->maison_edition }}">

                                <div class="form-group">
                                    <textarea class="form-control" name="resume" placeholder="Saisir le résumé du livre ici ..." rows="3">{{ $store_produit->resume }}</textarea>
                                </div>

                                <div class="font-size-14">
                                    <b>Formats livre disponibles  :</b><br />

                                    <table class="w-100">
                                        <tr>
                                            <td>
                                                <label for="format2" class="font-size-14">
                                                    PDF,E-pub...
                                                    @if ($store_produit->pdf != "")
                                                        <i class="icofont-check green-text"></i>
                                                    @endif
                                                </label>
                                            </td>
                                            <td>
                                                <input type="file" name="pdf" class="font-size-12">
                                                <input type="hidden" name="pdf_text" class="border border-dark w-100" value="{{ $store_produit->pdf }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format4" class="font-size-14">
                                                    Livre audio
                                                    @if ($store_produit->audio != "")
                                                        <i class="icofont-check green-text"></i>
                                                    @endif
                                                </label>
                                            </td>
                                            <td width="130">
                                                <input type="file" name="audio" class="font-size-12">
                                                <input type="hidden" name="audio_text" class="border border-dark w-100" value="{{ $store_produit->audio }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="format5" class="font-size-14">
                                                    Livre vidéo
                                                    @if ($store_produit->video != "")
                                                        <i class="icofont-check green-text"></i>
                                                    @endif
                                                </label>
                                            </td>
                                            <td>
                                                <input type="file" name="video" class="font-size-12">
                                                <input type="hidden" name="video_text" class="border border-dark w-100" value="{{ $store_produit->video }}">
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div id="editCover">
                                    <textarea name="texte" id="edit" cols="30" rows="10">{{ $store_produit->texte }}</textarea>
                                </div>
                                <br />

                                <button type="submit" class="btn btn-indigo rounded btn-md btn-block z-depth-0">
                                    <span class="white-text">Mettre à jour le produit</span>
                                </button>

                            </form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        </div>
                        <div class="col-lg-4"></div>
                    @endforeach
                </div>

            @else

                @foreach (StoreProduit::where('id', $id)->get() as $store_produit)
                    <div class="col-12">
                        <div class="text-center">
                            <br /><br />
                            <img src="{{ URL::asset($store_produit->fichier) }}" alt="" width="200">
                            <br /><br />
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <form action="{{ route('adminCubeStoreUpdateProduit', $id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="fichier" class="border border-dark w-100">

                            <input type="text" class="form-control mb-2 mt-2" required name="nom" placeholder="Saisir le titre du livre ..."  value="{{ $store_produit->nom }}">

                            <input type="text" class="form-control mb-2" required name="nom_auteur" placeholder="Saisir l'auteur du livre ..." value="{{ $store_produit->nom_auteur }}">

                            <div>
                                <small>
                                    <b>Catégorie : {{ $store_produit->categorie }}</b>
                                </small>
                            </div>

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

                            <input type="text" class="form-control mb-2" name="autre_categorie" placeholder="Autre catégorie à préciser ..." id="autreCategorieInput" value="{{ $store_produit->categorie }}">

                            <input type="text" class="form-control mb-2" required name="maison_edition" placeholder="Saisir la maison d'édition ou compte de l'auteur ..." value="{{ $store_produit->maison_edition }}">

                            <div class="form-group">
                                <textarea class="form-control" name="details" placeholder="Saisir le résumé du livre ici ..." rows="3">{{ $store_produit->details }}</textarea>
                            </div>

                            <div class="font-size-14">
                                <b>Formats existants :</b><br /><br />

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
                                                <option value="F CFA" {{ ($store_produit->devise_livre_papier == "F CFA") ? 'selected' : '' }}>F CFA</option>
                                                <option value="EUR" {{ ($store_produit->devise_livre_papier == "EUR") ? 'selected' : '' }}>EUR</option>
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
                                            <input type="checkbox" name="livre_papier" id="format1" {{ ($store_produit->livre_papier == "on") ? "checked" : "" }}>
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_livre_papier" value="{{ $store_produit->prix_livre_papier }}" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_usd_livre_papier" value="{{ $store_produit->prix_usd_livre_papier }}" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="format2" class="font-size-14">Livre numérique PDF,E-pub...</label>
                                            <input type="checkbox" name="livre_pdf" id="format2" {{ ($store_produit->livre_pdf == "on") ? "checked" : "" }}>
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_livre_pdf" value="{{ $store_produit->prix_livre_pdf }}" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_usd_livre_pdf" value="{{ $store_produit->prix_usd_livre_pdf }}" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="format4" class="font-size-14">Livre audio</label>
                                            <input type="checkbox" name="livre_audio" id="format4" {{ ($store_produit->livre_audio == "on") ? "checked" : "" }}>
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_livre_audio" value="{{ $store_produit->prix_livre_audio }}" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_usd_livre_audio" value="{{ $store_produit->prix_usd_livre_audio }}" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="format5" class="font-size-14">Livre vidéo</label>
                                            <input type="checkbox" name="livre_video" id="format5" {{ ($store_produit->livre_video == "on") ? "checked" : "" }}>
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_livre_video" value="{{ $store_produit->prix_livre_video }}" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_usd_livre_video" value="{{ $store_produit->prix_usd_livre_video }}" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="format3" class="font-size-14">Abonnement mensuel</label>
                                            <input type="checkbox" name="abonnement" id="format3" {{ ($store_produit->abonnement == "on") ? "checked" : "" }}>
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_abonnement" value="{{ $store_produit->prix_abonnement }}" placeholder="FCFA" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                        <td width="130">
                                            <input type="number" name="prix_usd_abonnement" value="{{ $store_produit->prix_usd_abonnement }}" placeholder="USD" class="form-control form-control-sm mt-2 mb-2">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="editCover">
                                <textarea name="texte" id="edit" cols="30" rows="10">{{ $store_produit->texte }}</textarea>
                            </div>
                            <br />

                            <button type="submit" class="btn btn-indigo rounded btn-md btn-block z-depth-0">
                                <span class="white-text">Mettre à jour le produit</span>
                            </button>

                        </form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                    </div>
                    <div class="col-lg-4"></div>
                @endforeach

            @endif
        </div>
    </div>

@endsection

@section("js")
	<script>
		$(document).ready(function () {

            $('#categorieSelect').change(function () {
                if ($(this).val() == "autres") {
                    $('#autreCategorieInput').fadeIn();
                } else {
                    $('#autreCategorieInput').fadeOut();
                }
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
