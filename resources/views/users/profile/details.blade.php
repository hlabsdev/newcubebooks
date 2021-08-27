
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
        @foreach (User::where('id', $_COOKIE['id'])->get() as $user)
            <div class="white p-3">
                <div>
                    <small><b>METTRE A JOUR MON PROFIL</b></small>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $message }}
                        </div>
                    @endif

                    <div class="text-center">
                        <center>
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                                @if ($user->avatar == "default.png")
                                    <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" alt="img-avatr" width="100%">
                                @else
                                    <img src="{{ URL::asset($user->avatar) }}" alt="img-avatr" width="100%">
                                @endif
                            </div>
                        </center>

                        <form action="{{ route('updateAvatar') }}" method="post" id="avatarForm" enctype="multipart/form-data">
                            @csrf
                            <label class="btn btn-white btn-sm rounded z-depth-0" for="avatar">
                                <i class="icofont-camera icofont-2x"></i><br />
                                Changer la photo de profil {{ $user->avatar }}
                            </label>
                            <input type="file" accept="image/*" id="avatar" name="avatar" style="width: 0; height: 0; outline: none; border: none; overflow: hidden;">
                        </form>
                    </div><br />

                    <div class="container-fluid">
                        <form method="POST" action="{{ route('uProfileUpdate', $_COOKIE['id']) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="nom_complet" class="mb-0">Nom complet</label>
                                    <input type="text" class="form-control mb-3 font-size-14" id="nom_complet" name="name" placeholder="Saisir dans le champs" value="{{ $user->name }}">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="email" class="mb-0">Email</label>
                                    <input type="email" class="form-control mb-3 font-size-14" id="email" name="email" value="{{ $user->email }}" placeholder="Saisir dans le champs">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="profession" class="mb-0">Profession</label>
                                    <input type="text" class="form-control mb-3 font-size-14" id="profession" name="profession" value="{{ $user->profession }}" placeholder="Saisir dans le champs">
                                </div>
                                <div class="col-12">
                                    <label for="telephone" class="mb-0">Télphone</label>
                                    <input type="text" class="form-control mb-3 font-size-14" id="telephone" name="telephone" placeholder="Saisir dans le champs" value="{{ $user->telephone }}">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="boite_postalle" class="mb-0">Boite postale</label>
                                    <input type="text" class="form-control font-size-14" id="boite_postalle" name="code_postal" value="{{ $user->boite_postalle }}" placeholder="Saisir dans le champs">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="pays" class="mb-0">Pays de résidence</label>
                                        <select class="custom-select font-size-14" name="pays_id" id="pays">
                                            @foreach (Pays::orderBy('nom_fr_fr')->get() as $pays)
                                                @if ($pays->id == $user->pays_id)
                                                    <option value="{{ $pays->id }}" selected>{{ $pays->nom_fr_fr }}</option>
                                                @else
                                                    <option value="{{ $pays->id }}">{{ $pays->nom_fr_fr }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="ville" class="mb-0">Ville actuelle</label>
                                    <input type="text" class="form-control mb-3 font-size-14" id="ville" name="ville" value="{{ $user->ville }}" placeholder="Saisir dans le champs">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="quartier" class="mb-0">Quartier</label>
                                    <input type="text" class="form-control font-size-14" id="quartier" name="quartier" value="{{ $user->quartier }}" placeholder="Saisir dans le champs">
                                </div>
                                <div class="col-12"><hr />

                                    <div class="text-right">
                                        <button type="submit" class="mr-0 btn btn-outline-indigo btn-md rounded z-depth-0">
                                            <b>Mettre à jour</b>
                                        </button>
                                    </div><br /><br /><br />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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
