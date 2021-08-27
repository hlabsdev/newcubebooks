
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

        #venteInputCover {
            display: none;
        }



        @media(max-width: 960px) {

            .content-center {
                position: absolute;
                top: 270px;
            }
        }
    </style>
@endsection

@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <b class="font-weight-bold">Liste des auteurs</b>
                </div>
            </div>
            <div class="row">
                @foreach (Auteur::orderByDesc('id')->get() as $auteur)
                    <div class="col-lg-12">
                        <div class="white p-2 mb-3 rounded" style="border: 1px solid #CCC;">
                            <table class="table w-100 table-sm">
                                <tr>
                                    <td width="100">
                                        <img src="{{ URL::asset($auteur->photo) }}" alt="img-auteur" width="90" class="rounded-circle border">
                                    </td>
                                    <td class="pl-3">
                                        <h6 class="text-truncate mb-0"><small><b class="font-weight-bold">{{ $auteur->nom_complet }}</b></small></h6>

                                        <div class="text-justify">
                                            {{ $auteur->description }}
                                        </div>

                                        <small><b>Lien site web ou page réseaux sociaux</b></small><br />
                                        <a href="{{ $auteur->lien }}" target="_blank">
                                            {{ $auteur->lien }}
                                        </a>

                                        <div>
                                            <small>
                                                Créé par :
                                            </small><br />
                                            @foreach (User::where('id', $auteur->user_id)->get() as $user)
                                                <a href="{{ route('otherProfile', $user->id) }}">
                                                    {{ $user->name }}
                                                </a> -
                                                <a href="mailto:{{ $user->email }}">
                                                    {{ $user->email }}
                                                </a>
                                            @endforeach
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            <small>Biographie</small><br />
                                            <div class="text-justify mb-2">
                                                {{ $auteur->biographie }}
                                            </div>
                                            <small>Bibliographie</small><br />
                                            <div class="text-justify mb-2">
                                                {{ $auteur->bibiographie }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section("js")
	<script>
		$(document).ready(function () {
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
