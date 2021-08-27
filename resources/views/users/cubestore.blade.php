
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

    <br /><br />
    <div class="container-fluid white">
        <div class="row">
            <div class="col-12">
                <div class="white mt-2" style="border: 1px solid #c2cfec;">
                    <div class="pl-2 pt-3 pb-3" style="border-bottom: 1px solid #c2cfec;">
                        <b class="font-weight-bold">CUBE BOOKS</b>
                    </div>
                    <div class="mt-2 pl-2 pr-2">
                        <div class="row">
                            <div class="col-lg-2">
                                <small><b>CUBE BOOKS</b></small>

                                <ul style="line-height: 30px;" class="mt-2 pl-4">
                                    <li>
                                        <a href="">
                                            Procédure de livraison
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Catégories de produits
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Nos marques
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Livraison internationale
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Produits enfants
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">
                                            Conditions d'utilisation
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <div class="col-lg-10">
                                <div class="row">
                                    @foreach (StoreProduit::orderByDesc('id')->get() as $store_produit)
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
                </div>
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
