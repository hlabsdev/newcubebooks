
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

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.2"></script>

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

@section('meta')
    @foreach (StoreProduit::where('nom', $nom)->get() as $store_produit)
        <meta name="description" content="CUBE BOOKS | {{ $store_produit->nom }}">
        <meta property="og:image" content="{{ URL::asset($store_produit->fichier) }}">
    @endforeach
@endsection

@section('content')

    @if (isset($_COOKIE['gerant_id']))
        <div class="Dosis">
            @include('included.menu_bar_gerant')
        </div>
    @else

        @if (isset($_COOKIE['id']))
            @include('included.menu_bar_users')
            <br /><br />
        @else
            @include('included.menu_bar')
            <br /><br />
        @endif

    @endif

    <br /><br />
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @foreach (\DB::table('livres_gratuits')->where('id', $id)->get() as $store_produit)
                    <img width="100%" src="{{ URL::asset($store_produit->couverture) }}" alt="">
                    <br /><br />
                    <div class="text-justify">
                        <b class="font-weight-bold">

                            {{ $store_produit->nom }}

                        </b><br />
                        <b class="font-weight-bold">
                            Nom de l'auteur :
                        </b>{{ $store_produit->nom_auteur }}<br />
                        <b class="font-weight-bold">
                            Catégorie :
                        </b>{{ $store_produit->categorie }}<br />

                        <b class="font-weight-bold">
                            Maison d'édition ou compte d'auteur :
                        </b> {{ $store_produit->maison_edition }}<br /><br />

                        {{ $store_produit->resume }}

                        <br /><br /><br /><br />

                    </div>
                @endforeach
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                @foreach (\DB::table('livres_gratuits')->where('id', $id)->get() as $store_produit)

                    <div class="mb-2 text-center grey lighten-3 pt-2 pb-2 border border-primary">
                        <b><b class="font-weight-bold">Téléchargez le(s) format(s) que vous voulez.</b></b>
                    </div>

                    @if ($store_produit->pdf != "")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format1" class="font-size-14">PDF, Epub ...</label>
                                </td>
                                <td class="text-right">
                                    <a href="{{  route('countLivresGratuitsDownload', $store_produit->id) }}">
                                        <i class="icofont-download"></i>
                                        Télécharger | Ouvrir
                                        <span class="badge badge-default badge-pill z-depth-0">{{ count(\DB::table('livre_gratuits')->where('livre_id', $store_produit->id)->get()) }}</span>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @endif

                    @if ($store_produit->audio != "")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format1" class="font-size-14">AUDIO</label>
                                </td>
                                <td class="text-right">
                                    <a href="{{ URL::asset($store_produit->audio) }}">
                                        <i class="icofont-download"></i>
                                        Télécharger
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @endif

                    @if ($store_produit->video != "")
                        <table class="w-100">
                            <tr>
                                <td>
                                    <label for="format1" class="font-size-14">VIDEO</label>
                                </td>
                                <td class="text-right">
                                    <a href="{{ URL::asset($store_produit->video) }}">
                                        <i class="icofont-download"></i>
                                        Télécharger
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @endif

                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("js")

	<script>

		$(document).ready(function () {

		    $('#pays').change(function() {
		        if($(this).val() != "34") {
		            $('#paygateBtn').fadeOut()
		            $('#fedaPayBtn').fadeOut()
		        } else {
		            $('#paygateBtn').fadeIn()
		            $('#fedaPayBtn').fadeIn()
		        }

		        if($(this).val() != "1" && $(this).val() != "7") {
		            $('#fedaPayBtn').fadeOut()
		        } else {
		            $('#fedaPayBtn').fadeIn()
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
