
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

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        @foreach (User::where('id', $user_id)->get() as $user)
            <div class="white p-3">
                <div>
                    <small><b>Profil de {{ $user->name }}</b></small>

                    <div class="text-center">
                        <center>
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                                @if ($user->avatar == "default.png")
                                    <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" alt="img-avatr" width="100%">
                                @else
                                    <img src="{{ URL::asset($user->avatar) }}" alt="img-avatr" width="100%">
                                @endif
                            </div><br />
                        </center>
                        <a href="mailto:{{ $user->email }}" class="orange-text">
                            <i class="icofont-paper-plane"></i>
                            <b>Envoyer un email</b>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                            <i class="icofont-envelope"></i>
                            <b>Envoyer un message</b>
                        </a><br /><br />

                        @php
                            $nom = str_replace(' ', '-', $user->name)
                        @endphp

                        <a href="{{ route('usersShowLibrairie', [$user->id, $nom]) }}">
                            <i class="icofont-book-alt"></i>
                            <b>Librairie de {{ $user->name }}</b>
                        </a>
                    </div><br />

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-muted">Nom complet</div>
                                <b>{{ $user->name }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12"><br />
                                <div class="text-muted">Email</div>
                                <b>{{ $user->email }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12"><br />
                                <div class="text-muted">Profession</div>
                                <b>{{ $user->profession }}</b>
                            </div>
                            <div class="col-12"><br />
                                <div class="text-muted">Téléphone</div>
                                <b>{{ $user->telephone }}</b><hr />
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Boite postale</div>
                                <b>{{ $user->boite_postale }}</b>
                                @if ($user->boite_postale == "")
                                    <i>Non renseigné !</i>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <div class="text-muted">Pays de résidence</div>
                                    @foreach (Pays::orderBy('nom_fr_fr')->where('id', $user->pays_id)->get() as $pays)
                                        <b>{{ $pays->nom_fr_fr }}</b>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Ville actuelle</div>
                                <b>{{ $user->ville }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Quartier</div>
                                <b>{{ $user->quartier }}</b>
                            </div>
                            <div class="col-12"><hr />
                                <div class="text-muted">Bien ou service fourni</div>
                                <b>{{ $user->bien_service }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
