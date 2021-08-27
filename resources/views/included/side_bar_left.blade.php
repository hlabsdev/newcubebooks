
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


@foreach (User::where('id', $_COOKIE['id'])->get() as $user)
    <div class="side-bar-left Dosis">
        <div class="m-1 xs-hide"></div>
        <table width="100%" class="xs-hide">
            <tr>
                <td width="50">
                    <div style="width: 50px; height: 50px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                        @if ($user->avatar == "default.png")
                            <a href="{{ route('uProfile') }}">
                                <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" alt="img-avatr" width="100%">
                            </a>
                        @else
                            <a href="{{ route('uProfile') }}">
                                <img src="{{ URL::asset($user->avatar) }}" alt="img-avatr" width="100%">
                            </a>
                        @endif
                    </div>
                </td>
                <td class="pl-2 font-size-13" style="line-height: 18px;">
                    <a href="{{ route('uProfile') }}" class="indigo-text">
                        <b class="font-weight-bold">{{ $user->name }}</b>
                    </a><br />
                    <small>{{ $user->created_at }}</small>
                </td>
                <td class="text-right" style="line-height: 15px;">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mt-0">
                        @if ($user->visible == 1)
                            <input type="checkbox" checked name="identiteSwitch" id="identiteSwitch" class="custom-control-input m-0">
                        @else
                            <input type="checkbox" name="identiteSwitch" id="identiteSwitch" class="custom-control-input m-0">
                        @endif
                        <label for="identiteSwitch" class="custom-control-label mr-0"><small>Visible</small></label>
                    </div>
                </td>
            </tr>
        </table>

        <div class="pt-3 pb-2 font-size-13">

            <table width="100%" class="profile-table">
                <tr>
                    <td width="33.333333337%" class="text-center">
                        <a href="{{ route('uProfile') }}" class="bordered-link">
                            <div>
                                <i class="icofont-user orange-text"></i><br />
                                <small>Profil</small>
                            </div>
                        </a>
                    </td>
                    <td width="33.333333337%" class="text-center">
                        <a href="{{ route('uContacts') }}" class="bordered-link">
                            <div>
                                <i class="icofont-users blue-text"></i><br />
                                <small>Contacts</small>
                            </div>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('listMessages') }}" class="bordered-link">
                            <div>
                                <i class="icofont-envelope red-text"></i><br />
                                <small>Messages</small>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>

            <a href="#!" class="bordered-link" data-toggle="modal" data-target="#modelPublication">
                <div class="text-center font-size-13 mt-2 pt-2 pb-2">
                    <b>Faire une publication</b>
                </div>
            </a>

            <a href="#!" class="bordered-link" data-toggle="modal" data-target="#modalVenteLivre">
                <div class="text-center font-size-13 mt-2 pt-2 pb-2">
                    <i class="icofont-ui-cart"></i>
                    <b>Vendre un livre</b>
                </div>
            </a>

            <a href="{{ route('userManuscrit') }}" class="bordered-link">
                <div class="text-center font-size-13 mt-2 pt-2 pb-2">
                    <i class="icofont-paper-clip"></i>
                    <b>Joindre un manuscrit</b>
                </div>
            </a>

            <a href="{{ route('userManuscrit') }}" class="bordered-link" data-toggle="modal" data-target="#modalPartageLivre">
                <div class="text-center font-size-13 mt-2 pt-2 pb-2">
                    <i class="icofont-share-alt"></i>
                    <b>Partager un livre gratuit</b>
                </div>
            </a>

            <div class="mt-3 xs-hide mb-1" style="line-height: 28px;">
                <i class="icofont-ui-email blue-text mr-2"></i>
                Email : {{ $user->email }}<br />
                <i class="icofont-phone orange-text mr-2"></i>
                Tléphone : {{ $user->telephone }}<br />
                <i class="icofont-briefcase-1 brown-text mr-2"></i>
                Profession :
                @if ($user->profession == '')
                    <i>Non renseigné !</i>
                @else
                    {{ $user->profession }}
                @endif<br />

                <i class="icofont-fax indigo-text mr-2"></i>
                Boite postale :
                @if ($user->code_postal == '')
                    <i>Non renseigné !</i>
                @else
                    {{ $user->code_postal }}
                @endif<br />

                <i class="icofont-google-map red-text mr-2"></i>
                Pays de résidence :
                @foreach (Pays::where('id', $user->pays_id)->get() as $pays)
                    {{ $pays->nom_fr_fr }}
                @endforeach<br />
                <i class="icofont-map-pins black-text mr-2"></i>
                Ville de résidence : {{ $user->ville }}<br />
                <i class="icofont-site-map indigo-text mr-2"></i>
                Quatier : {{ $user->quartier }}<br />
                <i class="icofont-share text-muted mr-2"></i>
            </div>
        </div>

        <div class="font-size-13 xs-hide">
            <ul type="none" class="pl-0" style="line-height: 25px;">
                <li>
                    <a href="{{ route('usersCubeStoreListeProduits') }}">
                        Gérer les livres publiés
                    </a>
                </li>
                <li>
                    <a href="{{ route('uProfile') }}">
                        Mettre à jour mon compte
                    </a>
                </li>
                <li>
                    <a href="">
                        Termes et conditions d'utilisation
                    </a>
                </li>
                <li>
                    <a href="">
                        Politique de confidentialités
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="red-text">
                        <i class="icofont-logout"></i>
                        <b>Se déconnecter</b>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade Dosis" id="modelPublication" tabindex="-1" role="dialog" aria-labelledby="modelTitllPublication" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Faire une publication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('storePublication') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--<div class="form-group">
                            <select class="custom-select" required name="but" id="but_conrol">
                                <option value="troc" selected>Un troc</option>
                                <option value="vente">Une vente</option>
                                <option value="don">Un don</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" required name="categorie" id="categorie">
                                <option value="" selected disabled>Sélectionnez une catégorie</option>
                                <option value="Agro alimentaire">Agro alimentaire</option>
                                <option value="Poduits d'entretien">Poduits d'entretien</option>
                                <option value="Produits services de santé">Produits services de santé</option>
                                <option value="E-commerce">E-commerce</option>
                                <option value="Education">Education</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>

                        <div class="form-group" id="venteInputCover">
                            <label for="prix" class="mb-0">Prix (F CFA)</label>
                            <input type="number" class="form-control" name="prix" id="prix" placeholder="Saisir dans le champs">
                        </div>-->

                        <div class="form-group" id="trocInputCover">
                            <label for="texte" class="mb-0">Saisir un texte à la publication</label>

                            <textarea class="form-control" name="texte" id="edit" placeholder="Saisir dans le champs"></textarea>
                        </div>

                        <input type="file" name="fichier" required id="fichier" class="w-100">

                        <div class="text-right">
                            <button type="submit" class="btn btn-outline-indigo btn-md z-depth-0">
                                <b>Publier</b>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- MOdal pour vendre un livre : PROSPERE -->

    <div class="modal fade" id="modalVenteLivre" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

                        <div class="text-center mb-2">
                            <small>
                                <b>Prière utilisez des visuels de dimensions 900x600 et de moins de 4Mo pour l'affichage des aperçus lors des partages sur les réseaux sociaux.</b>
                            </small>
                        </div>

                        <input type="file" name="fichier" class="border border-dark w-100" required>

                        <!--<table class="w-100">
                            <tr>
                                <td width="50%">
                                    <input type="number" name="prix" required placeholder="Saisir le montant ici ..." class="form-control mt-2 mb-2">
                                </td>
                                <td width="25%">
                                    <select class="custom-select" name="devise" required>
                                        <option selected value="">Devise</option>
                                        <option value="F CFA">F CFA</option>
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="custom-select" name="unite" required>
                                        <option selected value="">Unité</option>
                                        <option value="Unité">Unité</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <input type="number" name="quantite" required placeholder="Saisir la quantité ici ..." class="form-control mt-2 mb-2">-->

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
                                        <input type="text" name="prix_livre_papier" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
                                    </td>
                                    <td width="130">
                                        <input type="text" name="prix_usd_livre_papier" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
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
                                        <input type="text" name="prix_livre_pdf" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
                                    </td>
                                    <td width="130">
                                        <input type="text" name="prix_usd_livre_pdf" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
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
                                        <input type="text" name="prix_livre_audio" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
                                    </td>
                                    <td width="130">
                                        <input type="text" name="prix_usd_livre_audio" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
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
                                        <input type="text" name="prix_livre_video" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
                                    </td>
                                    <td width="130">
                                        <input type="text" name="prix_usd_livre_video" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
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
                                        <input type="text" name="prix_abonnement" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
                                    </td>
                                    <td width="130">
                                        <input type="text" name="prix_usd_abonnement" placeholder="Prix" class="form-control form-control-sm mt-2 mb-2">
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

    <div class="modal fade" id="modalPartageLivre" tabindex="-1" role="dialog" aria-labelledby="modelTitlePartageId" aria-hidden="true">
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

    <!-- Fin Modal pour vendre un livre -->


@endforeach
