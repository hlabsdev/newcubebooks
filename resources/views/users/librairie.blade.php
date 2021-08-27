
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

    @if(isset($_COOKIE['id']))
        @include('included.menu_bar_users')
    @else
        @include('included.menu_bar')
    @endif
    <br /><br /><br />
    <div class="container-fluid font-size-13 Dosis">
        @foreach (User::where('id', $id)->get() as $user)
            <div class="white p-3">

                <div class="row">
                    <div class="col-12">
                        <div class="text-center pt-2 pb-2 mb-2">
                            <h5>
                                <b>LIBRAIRIE PERSONNALISEE DE {{ $user->name }}</b>
                            </h5><br />
                            <div class="orange m-auto p-1" style="width: 150px;"></div><br />
                        </div>
                    </div>
                </div>

                <div class="row">

                    @forelse(\DB::table('store_produits')->where('user_id', $id)->get() as $store_produit)
                        <div class="col-lg-3">
                            <div class="card z-depth-0">
                                <div style="height: 150px; overflow: hidden;">
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
                    @empty
                        <div class="col-12 text-center">
                            <b>Pas de livres payants ajoutés par ce utilisateur !</b>
                        </div>
                    @endforelse


                    @forelse(\DB::table('livres_gratuits')->where('user_id', $id)->orderByDesc('id')->get() as $store_produit)
                        <div class="col-lg-3">
                            <div class="card z-depth-0">
                                <div style="height: 150px; overflow: hidden;">
                                    <img class="card-img-top" src="{{ URL::asset($store_produit->couverture) }}" alt="">
                                </div>
                                <div class="card-body pb-2 pt-2 pl-0 pr-0">

                                                    <a href="{{ route('usersCubeStoreCommander', [$store_produit->nom, $store_produit->id]) }}" class="blue-grey-text">
                                                        {{ $store_produit->nom }} <span class="badge badge-pill badge-danger z-depth-0">Gratuit</span>
                                                    </a>

                                                    <h6 class="text-left mb-1 mt-1 font-size-13 mb-2"><b>Auteur : </b>{{ $store_produit->nom_auteur }}</h6>
                                                    <h6 class="text-left mb-1 mt-1 font-size-13"><b>Maison d'édition ou compte auteur</b><br />{{ $store_produit->maison_edition }}</h6>
                                                    <p class="card-text text-left">
                                                        <a href="{{ route('usersDownloadLivreGratutis', [$store_produit->nom, $store_produit->id]) }}" class="green-text font-weight-bold">
                                                            Voir & Télécharger
                                                            &rightarrow;
                                                        </a>
                                                    </p>
                                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <b>Pas de livres gratuits ajoutés par ce utilisateur !</b>
                        </div>
                    @endforelse

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
