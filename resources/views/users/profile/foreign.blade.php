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
    @foreach (Publication::where('id', $id)->get() as $publication)

        @if(isset($_COOKIE['id']))
            @include('included.menu_bar_users')
        @else
            @include('included.menu_bar')
        @endif

        @if ($publication->but != "don")
            @foreach (User::where('id', $publication->user_id)->get() as $user)
                @if ($user->visible == 0)ok
                    <div class="side-bar-left Dosis xs-hide">
                        <div class="text-center red white-text pt-1 pb-1">
                            <small>AUTEUR DE LA PUBLICATION</small>
                        </div>
                    <div class="text-center"><br /><br />
                        <i class="icofont-invisible icofont-10x"></i>
                        <h1 class="mb-4">Utilisateur invisible</h1>

                        <div class="alert alert-warning fade show" role="alert">
                            Les informations relatives à cet utilisateur sont invisibles.
                            Cette foncionnalité est expressemnt activée ou  désactivée par
                            ce denier dans le but de rendre visible ou invisible ses infomations
                            personnelles.
                        </div>
                    </div>
                    </div>
                @else
                    <div class="side-bar-left Dosis xs-hide">
                        <div class="white" style="border-right: 1px solid #c2cfec; border-left: 1px solid #c2cfec;">
                            <div class="text-center red white-text pt-1 pb-1">
                                <small>AUTEUR DE LA PUBLICATION</small>
                            </div>
                            <div class="p-3">
                                <table width="100%" class="xs-hide">
                                    <tr>
                                        <td width="50">
                                            @if ($user->avatar == "default.png")
                                                <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" class="rounded-circle p-1 white" style="border: 2px solid #BBB;" alt="img-avatr" width="100%">
                                            @else
                                                <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle p-1 white" alt="img-avatr" style="border: 2px solid #BBB;" width="100%">
                                            @endif
                                        </td>
                                        <td class="pl-2 font-size-13" style="line-height: 18px;">
                                            <a href=""class="indigo-text">
                                                <b class="font-weight-bold">{{ $user->name }}</b>
                                            </a><br />
                                            <small>{{ $user->created_at }}</small>
                                        </td>
                                        <td class="text-right" style="line-height: 15px;">

                                        </td>
                                    </tr>
                                </table>

                                <div class="pb-2 font-size-13">

                                    <div class="mt-3 xs-hide mb-3" style="line-height: 28px;">
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
                                        Bien ou service<br />
                                        {{ $user->bien_service }}<br />

                                        <a href="" class="btn btn-sm btn-indigo rounded btn-block z-depth-0 mb-0 white-text">
                                            <i class="icofont-facebook-messenger"></i>
                                            Envoyer un message
                                        </a>
                                        <div class="text-center red-text" style="line-height: 15px;">
						Vous ne pouvez envoyer un message que si vous êtes connecté.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="side-bar-left Dosis xs-hide">
                <div class="text-center red white-text pt-1 pb-1">
                    <small>AUTEUR DE LA PUBLICATION</small>
                </div>
               <div class="text-center"><br /><br />
                   <i class="icofont-ban icofont-10x red-text"></i>
                   <h1 class="mb-4">Don anonyme</h1>

                   <div class="alert alert-primary fade show" role="alert">
                        Les dons et donnateurs ont une source qu'on a préféré rendre anonyme
                        selon nos politiques de confidentialités et conditions d'utilisation
                   </div>
               </div>
            </div>
        @endif

        <div class="content-center font-size-13 Dosis" style="top: 63px;">
            <div class="col-12 mb-2" style="border: none;">
                <div class="border-bottom white pb-2" style="border: none;">

                    <div>
                        @switch($publication->but)
                            @case("troc")
                                    <div class="ribbon-wrapper ribbon-lg">
                                        <div class="ribbon bg-orange text-md">
                                            {{ "Troc" }}
                                        </div>
                                    </div>
                                @break
                            @case("vente")
                                    <div class="ribbon-wrapper ribbon-lg">
                                        <div class="ribbon bg-danger text-md">
                                            {{ "Vente" }}
                                        </div>
                                    </div>
                                @break

                            @case("don")
                                    <div class="ribbon-wrapper ribbon-lg">
                                        <div class="ribbon bg-success text-md">
                                            {{ "Don" }}
                                        </div>
                                    </div>
                                @break

                            @default

                        @endswitch

                        <img src="{{ URL::asset($publication->fichier) }}" class="mt-2" alt="img" width="100%">

                        <div class="font-size-14 mb-3 mt-2 pl-2 pr-2">
                            <h5>{!! $publication->texte !!}</h5>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="pl-2 pr-2">
                            <a href="#!" class="text-muted">
                                Commentaires
                                <i class="icofont-speech-comments"></i>
                                <span class="text-dark">
                                    @if (count(Commentaire::where('publication_id', $publication->id)->get()) != 0)
                                        {{ count(Commentaire::where('publication_id', $publication->id)->get()) }}
                                    @endif
                                </span>
                            </a>
                        </div>

                        <div class="comment-cover comment-result{{ $publication->id }} mt-3 pl-2 pr-2">
                            <table width="100%">
                                @forelse (Commentaire::where('publication_id', $publication->id)->orderByDesc('id')->limit(1)->get() as $commentaire)
                                    <tr>
                                            @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)

                                            @endforeach
                                            <td width="35">
                                                <img src="{{ URL::asset('db/avatars/1.jpg') }}" class="rounded-circle" alt="img-avatr" width="100%">
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
		                                                        <td colspan="2>
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
                                	<tr><td class="text-center" colspan="3">Pas de commentaire à cette publication</td></tr>
                                    <tr>
                                        <td width="35">
                                            <div style="height: 35px" class="grey lighten-3 rounded-circle">

                                            </div>
                                        </td>
                                        <td class="pl-2 font-size-12" style="line-height: 17px;">
                                            <div class="grey lighten-3 rounded" style="height: 17px;">

                                            </div>
                                            <small class="grey lighten-3 pl-4 pr-4 rounded">&nbsp;</small>
                                        </td>
                                        <td class="text-right">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35">

                                        </td>
                                        <td class="pl-2">
                                            <a href="">
                                                <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-1 black-text">
                                                    &nbsp;
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endsection

@section('js')
    <script>
        $(document).ready(function () {
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
                                $('.comment-result' + publication_id + ">table").html(status);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
