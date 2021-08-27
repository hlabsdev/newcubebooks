
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
        #venteInputCover {
            display: none;
        }

        .content-center, .side-bar-right, .side-bar-left {
            position: absolute;
            top: 520px;
        }

        .video-cover {
            box-shadow: 0 0 5px #CCC;
            position: fixed;
            right: 10px;
            bottom: 90px;
            width: 300px;
            border-radius: 10px;
            overflow: hidden;
            display: none;
        }

        .xs-show {
            display: none;
        }

        @media(max-width: 960px) {
            .side-bar-left {
                position: absolute;
                top: 460px;
            }

            .xs-show {
                display: block;
            }

            .content-center {
                position: absolute;
                top: 765px;
            }

            .xs-show {
                display: block;
            }
        }
    </style>
@endsection

@section('content')

    @include('included.menu_bar_users')
    <br /><br />

    <div class="container-fluid white">
        <div class="row">
            <div class="col-12">
                <div class="white mt-2" style="border: 1px solid #c2cfec;">
                    <div class="pl-2 pt-3 pb-3" style="border-bottom: 1px solid #c2cfec;">
                        <b class="font-weight-bold">CUBE BOOKS</b>

                        <a href="#!" class="mr-2 float-right xs-show" id="sideBarLeftSmTrigger">
                            <i class="icofont-navigation-menu"></i>
                        </a>

                    </div>
                    <div class="mt-2 pl-2 pr-2">
                        <div class="row" style="height: 310px; overflow: auto;">
                            <div class="col-lg-2">
                                <small><b>CUBE BOOKS</b></small>

                                <ul type="none" class="pl-0" style="line-height: 30px;">
                                    <li>
                                        <a href="{{ route('usersListeAuteurs') }}">
                                            <i class="icofont-teacher"></i>
                                            Gérer ou ajouter auteur
                                        </a>
                                    </li>
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
                            <div class="col-lg-10">
                                <div class="row">
                                    @foreach (StoreProduit::orderByDesc('id')->limit(12)->get() as $store_produit)
                                        <div class="col-lg-3">
                                            <div class="card z-depth-0">
                                                <div style="height: 130px; overflow: hidden;">
                                                    <img class="card-img-top" src="{{ URL::asset($store_produit->fichier) }}" alt="">
                                                </div>
                                                <div class="card-body pb-2 pt-2 pl-0 pr-0">

                                                    <a href="{{ route('usersCubeStoreCommander', [$store_produit->nom, $store_produit->id]) }}" class="blue-grey-text">
                                                        {{ $store_produit->nom }}
                                                    </a>

                                                    <h6 class="text-left mb-1 mt-1 font-size-13 mb-2"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                                                    <h6 class="text-left mb-1 mt-1 font-size-13"><b>Maison d'édition ou compte auteur</b><br />{{ $store_produit->maison_edition }}</h6>
                                                    <p class="card-text text-left">
                                                        <a href="{{ route('usersCubeStoreCommander', [$store_produit->nom, $store_produit->id]) }}" class="orange-text font-weight-bold">
                                                            Voir & commander
                                                            &rightarrow;
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2 pt-2 pb-2">
                        <a href="{{ route('cubeStore') }}">
                            <b class="font-weight-bold">Accéder à la librairie CUBEBOOKS</b>
                            &rightarrow;
                        </a>
                        &nbsp;&nbsp;
                        <a href="{{ route('usersLivreGratutis') }}">
                            <b class="font-weight-bold">Accéder aux livres gratuits</b>
                            &rightarrow;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis" style="border: none;">
        <div class="white p-3" style="border: 1px solid #c2cfec;">
            <div>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                <small><b>FAIRE UNE PUBLICATION</b></small>

                <div class="form-group mt-1 mb-0">
                    <textarea class="form-control font-size-13" readonly name="" id="" rows="1" placeholder="Cliquez ici pour publier" data-toggle="modal" data-target="#modelPublication"></textarea>
                </div>
            </div>
        </div>

        <div class="border-top"></div>
        <div class="row mt-2" style="border: none;">

            @forelse (Publication::orderByDesc('id')->get() as $publication)
                        <div class="col-12 mb-2">
                            <div class="border-bottom white pt-1 pb-2" style="border: 1px solid #c2cfec;">

                                <div class="font-size-14 mb-2 mt-2 pl-2 pr-4 mr-4">

                                    <table width="100%">
                                        <tr>
                                            @foreach(User::where('id', $publication->user_id)->get() as $user_publication)
                                                <td width="30">
                                                    @if($user_publication->avatar == "default.png")
                                                        <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img" width="100%">
                                                    @else
                                                        <img src="{{ URL::asset($user_publication->avatar) }}" class="rounded-circle" alt="img" width="100%">
                                                    @endif
                                                </td>
                                                <td class="pl-2 font-size-12">
                                                    <a href="#!">{{ $user_publication->name }}</a><br />
                                                    <small class="text-muted">{{ $publication->created_at }}</small>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                    <div class="mt-2 text-justify">
                                        {!! $publication->texte !!}
                                    </div>
                                </div>

                                <div>

                                    <img src="{{ URL::asset($publication->fichier) }}" class="mt-2" alt="img" width="100%">
                                </div>

                                <div class="mt-2">
                                    <div class="pl-2 pr-2">
                                        <!--<a href="">
                                            J'aime
                                        </a>
                                        <a href="">
                                            <i class="icofont-thumbs-up grey-text"></i>
                                            <span class="black-text">10</span>
                                        </a>&nbsp;&nbsp;&nbsp;-->
                                        <a href="#!" class="text-muted">
                                            Commentaires
                                            <i class="icofont-speech-comments"></i>
                                            <span class="text-dark">
                                                @if (count(Commentaire::where('publication_id', $publication->id)->get()) != 0)
                                                    {{ count(Commentaire::where('publication_id', $publication->id)->get()) }}
                                                @endif
                                            </span>
                                        </a>
                                        @if($publication->user_id == $_COOKIE['id'])
                                            <div class="dropdown float-right">
                                                <a href="" class="indigo-text" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                    <i class="icofont-dotted-down icofont-2x"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                                    <a class="dropdown-item font-size-13" href="{{ route('editPublication', $publication->id) }}">
                                                        Modifier cette publication
                                                    </a>
                                                    <a class="dropdown-item font-size-13" href="{{ route('destroyPublication', $publication->id) }}" onclick="return confirm('Êtes-vous sûre ? Cette action sera iréversible !')">
                                                        Supprimer cette publication
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="comment-cover comment-result{{ $publication->id }} mt-3 pl-2 pr-2">
                                        <table width="100%">
                                            @forelse (Commentaire::where('publication_id', $publication->id)->orderBy('id')->limit(3)->get() as $commentaire)
                                                <tr>
                                                    @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)

                                                    @endforeach
                                                    <td width="35">
                                                        @if($user_comment->avatar == "default.png")
                                                            <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        @else
                                                            <img src="{{ URL::asset($user_comment->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        @endif
                                                    </td>
                                                    <td class="pl-2 font-size-12" style="line-height: 17px;">
                                                        <a href="">
                                                            {{ $user_comment->name }}
                                                        </a><br />
                                                        <small>{{ $commentaire->created_at }}</small>
                                                    </td>
                                                    <td class="text-right">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="35">

                                                    </td>
                                                    <td class="pl-2">
                                                        <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}">
                                                            <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-1 black-text">
                                                                {{ $commentaire->texte }}
                                                            </div>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="pt-2 pl-2">
                                                        <table width="100%">
                                                            @forelse (ReponseCommentaire::where('commentaire_id', $commentaire->id)->get() as $reponse_commentaire)
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div style="height: 35px">
                                                                                <i class="icofont-comment font-size-12"></i>
                                                                                <span class="text-muted"><small>Réponse à ce commentaire</small></span><br />
                                                                                <small>{{ $reponse_commentaire->created_at }}</small>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <a href="">
                                                                                <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-2 black-text">
                                                                                    {{ $reponse_commentaire->texte }}
                                                                                </div>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @empty

                                                                @endforelse
                                                        </table>
                                                    </td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </table>

                                        <div class="comment-form pt-2">
                                            @csrf
                                            <table width="100%">
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control font-size-13 input-comment" placeholder="Saisir un commentaire ..." id="comment{{ $publication->id }}">
                                                    </td>
                                                    <td width=40>
                                                        <button type="submit" class="float-right btn btn-indigo p-0 rounded-circle m-0 white-text z-depth-0 submit-comment-btn" data-value="{{ $publication->id }}" data-user="{{ $publication->user_id }}"
                                                        style="width: 40px; height: 40px; line-height: 36px;">
                                                            <i class="icofont-paper-plane"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12 mb-2">
                            <div class="text-center white">
                                <br /><br /><br /><br />
                                <h1>
                                    <i class="icofont-globe-alt icofont-5x"></i>
                                </h1>
                                <br /><br /><br /><br />
                            </div>
                        </div>
                    @endforelse


        </div>
    </div>

    <div class="side-bar-right Dosis font-size-13 xs-hide">
        <div class="text-center white pt-2 pb-2">
            PUBLICITEST ET ANNONCES
        </div>

        <div id="carouselId" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @php
                    $k = 0
                @endphp

                @forelse(Publicite::orderByDesc('id')->get() as $publicite)
                    <div class="carousel-item {{ ($k == 0) ? 'active' : '' }}">
                        <img src="{{ URL::asset($publicite->image) }}" alt="First slide" width="100%">
                    </div>
                    @php
                        $k += 1
                    @endphp
                @empty
                    <div class="carousel-item active text-center">
                        <b>Pas de publicité ajoutée !</b>
                    </div>
                @endforelse
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><br />

        <div class="panel white">
            <div class="panel-header pt-2 pb-2 pr-3 pl-3">

                <input type="text" placeholder="Rechercher un utilisateur ..." class="form-control" id="userSearchInput" />

            </div>
            <div class="panel-body p-2">
                <div class="container-fluid">
                    <div class="row" id="usersResultSearch">
                        @foreach (User::where('id', '<>', $_COOKIE['id'])->orderByDesc('id')->limit(40)->get() as $other_user)
                            <div class="col-3">
                                <a href="{{ route('otherProfile', $other_user->id) }}">
                                    <div style="width: 35px; height: 35px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                                        @if ($other_user->avatar == "default.png")
                                            <img src="{{ URL::asset('db/avatars/' . $other_user->avatar . '') }}" alt="img-avatr" width="100%">
                                        @else
                                            <img src="{{ URL::asset($other_user->avatar) }}" alt="img-avatr" width="100%">
                                        @endif
                                    </div>

                                    <h6 class="text-truncate font-size-14 mb-3"><small>{{ $other_user->name }}</small></h6>
                                </a>
                            </div>
                        @endforeach

                    </div><br />
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{ route('allUsers') }}">
                                <b>Tous les utilisateurs</b>
                            </a>
                        </div>
                    </div><br />
                </div>
            </div>
        </div>
    </div><br /><br /><br /><br />

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('#identiteSwitch').change(function() {
                if ($(this).prop('checked')) {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('updateVisible') }}",
                        data : {"visible" : 1},
                        success : function(status) {
                            //console.log(status);
                        }
                    });
                } else {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('updateVisible') }}",
                        data : {"visible" : 0},
                        success : function(status) {
                            //console.log(status);
                        }
                    });
                }
            });

            $('.submit-comment-btn').each(function () {
                $(this).click(function () {
                    var comment = $('#comment' + $(this).attr('data-value')).val();
                    var publication_id = $(this).attr('data-value');
                    var user_id = $(this).attr('data-user');
                    if (comment.trim() != "") {
                        $.ajax({
                            type : "GET",
                            url : "{{ route('storeComment') }}",
                            data : {"comment" : comment.trim(), "publication_id" : publication_id, "user_id" : user_id},
                            success : function(status) {
                                $('#comment' + publication_id).val("");
                                $('.comment-result' + publication_id + ">table").append(status);
                            }
                        });
                    }
                });
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

            $('#userSearchInput').keyup(function() {
                if($(this).val() != "") {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('usersResultSearch') }}",
                        data : {'search_q' : $(this).val()},
                        success : function(status) {
                            if (status != "") {
                                $('#usersResultSearch').html(status);
                            }
                        }
                    });
                }
            })
        });
    </script>
@endsection
