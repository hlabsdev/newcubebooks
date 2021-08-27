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

        #editCover {
            display: none;
        }
    </style>
@endsection

@section('content')
    
    <div class="Dosis">
        @include('included.menu_bar_gerant')
    </div>

    <div class="container-fluid white">
        <div class="row">
            <div class="col-12">
                <table class="w-100">
                    <tr>
                        <td>
                            <div class="pt-3 pb-3">
                                <a href="#!" data-toggle="modal" data-target="#modelId">
                                    <i class="icofont-plus"></i>
                                    <b class="font-weight-bold">Créer un nouveau livre</b>
                                </a>
                                &nbsp;&nbsp;
                                <a href="#!" data-toggle="modal" data-target="#modelLivreGratuitId">
                                    <i class="icofont-share-alt"></i>
                                    <b class="font-weight-bold">Partager un livre gratuit</b>
                                </a>
                            </div>
                        </td>
                        <td width="250">
                            <input type="search" name="search_q" id="search_q" placeholder="Rechercher ..." class="form-control">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" id="livresResult">
            @foreach ($store_produits as $store_produit)    
                <div class="col-lg-2">
                    <div class="card z-depth-0">
                        <div style="height: 150px; overflow: hidden;">
                            <img class="card-img-top" src="{{ URL::asset($store_produit->fichier) }}" alt="">
                        </div>
                        <div class="card-body pb-2 pt-2 pl-0 pr-0">
                            
                            <a href="" class="blue-grey-text">
                                {{ $store_produit->nom }}
                            </a>

                            <h6 class="text-left mb-2 mt-1 font-size-14"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                            <h6 class="text-left mb-2 mt-1 font-size-14"><b>Maison d'édition ou compte d'auteur</b><br />{{ $store_produit->maison_edition }}</h6>

                            <p class="card-text text-center">
                                <a href="{{ route('adminCubeStoreEditProduit', [$store_produit->id, 'type' => 'payant']) }}">
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
            @endforeach
        </div><br />
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $store_produits }}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="grey darken-3 text-center white-text pt-2 pb-2">
                    LIBRAIRIE - LIVRES GRATUITS
                </div>
            </div>
        </div><br />
        <div class="row">
            @foreach (\DB::table('livres_gratuits')->orderByDesc('id')->get() as $store_produit)    
                <div class="col-lg-2">
                    <div class="card z-depth-0">
                        <div style="height: 150px; overflow: hidden;">
                            <img class="card-img-top" src="{{ URL::asset($store_produit->couverture) }}" alt="">
                        </div>
                        <div class="card-body pb-2 pt-2 pl-0 pr-0">
                            
                            <a href="" class="blue-grey-text">
                                {{ $store_produit->nom }}
                            </a>

                            <h6 class="text-left mb-2 mt-1 font-size-14"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                            <h6 class="text-left mb-2 mt-1 font-size-14"><b>Maison d'édition ou compte d'auteur</b><br />{{ $store_produit->maison_edition }}</h6>

                            <p class="card-text text-center">
                                <a href="{{ route('adminCubeStoreEditProduit', [$store_produit->id, 'type' => 'gratuit']) }}">
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
            @endforeach
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
                            <option value="Livre pour Entrepreneurs">Livre pour Entrepreneurs</option>
                            <option value="Bande dessinée">Bande dessinée</option>
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
                                    <!--<td width="130">
                                        <select class="custom-select custom-select-sm" name="devise_livre_papier">
                                            <option selected value="">Devise</option>
                                            <option value="F CFA">F CFA</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </td>-->
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
                                    <!--<td width="130">
                                        <select class="custom-select custom-select-sm" name="devise_livre_pdf">
                                            <option selected value="">Devise</option>
                                            <option value="F CFA">F CFA</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </td>-->
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
                                    <!--<td width="130">
                                        <select class="custom-select custom-select-sm" name="devise_livre_audio">
                                            <option selected value="">Devise</option>
                                            <option value="F CFA">F CFA</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </td>-->
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
                                    <!--<td width="130">
                                        <select class="custom-select custom-select-sm" name="devise_livre_video">
                                            <option selected value="">Devise</option>
                                            <option value="F CFA">F CFA</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </td>-->
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
                                    <!--<td width="130">
                                        <select class="custom-select custom-select-sm" name="devise_abonnement">
                                            <option selected value="">Devise</option>
                                            <option value="F CFA">F CFA</option>
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </td>-->
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

    <div class="modal fade" id="modelLivreGratuitId" tabindex="-1" role="dialog" aria-labelledby="modelTitleLivreGratuitId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title">Partager un livre gratuit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('adminStoreLivreGratuit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="text-center mb-2">
                            <small>
                                <b>Prière utilisez des visuels de dimensions 900x600 et de moins de 4Mo pour l'affichage des aperçus lors des partages sur les réseaux sociaux.</b>
                            </small>
                        </div>
    
                        <input type="file" name="couverture" class="border border-dark w-100" required>
    
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
                            <textarea class="form-control" name="resume" placeholder="Saisir le résumé du livre ici ..." rows="3"></textarea>
                        </div>


                        <div class="font-size-14 mb-3">
                            <b>Formats livre disponibles  :</b><br />

                            <table class="w-100">
                                <tr>
                                    <td>
                                        <label for="format2" class="font-size-14">Livre numérique PDF,E-pub...</label>
                                    </td>
                                    <td>
                                        <input type="file" name="pdf" class="font-size-12">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="format4" class="font-size-14">Livre audio</label>
                                    </td>
                                    <td width="130">
                                        <input type="file" name="audio" class="font-size-12">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="format5" class="font-size-14">Livre vidéo</label>
                                    </td>
                                    <td>
                                        <input type="file" name="video" class="font-size-12">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="editCover">
                            <textarea name="texte" id="edit" cols="30" rows="10"></textarea>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-indigo rounded btn-md btn-block z-depth-0">
                            <span class="white-text">Partager le livre</span>
                        </button>
    
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
	<script>

        new FroalaEditor("#edit", {
            theme: 'royal'
        })

		$(document).ready(function () {

            $('#format3').click(function() {
                $('#editCover').slideToggle()
            })

            $('#categorieSelect').change(function () {
                if ($(this).val() == "autres") {
                    $('#autreCategorieInput').fadeIn();
                } else {
                    $('#autreCategorieInput').fadeOut();
                }
            });

            $('#search_q').keyup(function() {
                if ($(this).val() != "") {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('getLivresAdminResultSearch') }}",
                        data : {'search_q' : $('#search_q').val()},
                        success : function(status) {
                            if (status != "") {
                                $('#livresResult').html(status);
                            }
                        }
                    });
                }
            })
		});
	</script>
@endsection