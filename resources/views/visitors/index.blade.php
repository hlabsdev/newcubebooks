
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

@section('content')

    @include('included.menu_bar')


    <div class="container-fluid white">
        <div class="row">
            <div class="col-12">
                <div class="white mt-2" style="border: 1px solid #c2cfec;">
                    <div class="pl-2 pt-3 pb-3" style="border-bottom: 1px solid #c2cfec;">
                        <b class="font-weight-bold">CUBE BOOKS</b>
                    </div>
                    <div class="mt-2 pl-2 pr-2">
                        <div class="row" style="height: 400px; overflow: auto;">
                            <div class="col-lg-2">
                                <small><b>CUBE BOOKS</b></small>

                                <ul style="line-height: 30px;" class="mt-2 pl-4">
                                    <li>
                                        <a href="">
                                            Essais
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Nouvelles
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Romans
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Livres pratiques
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Livres pour enfants
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
                                    @foreach (StoreProduit::orderByDesc('id')->limit(12)->get() as $store_produit)
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
                        <a href="#!" data-toggle="modal" data-target="#modelLivreGratuitsId">
                            <b class="font-weight-bold">Accéder aux livres gratuits</b>
                            &rightarrow;
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="modelLivreGratuitsId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Demande de connexion ou inscription</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <b class="font-weight-bold">Pour pouvoir accéder aux livres         gratuits, vous devez avant tout ...</b><br /><br />

                                            <a href="{{ route('register') }}" class="btn btn-teal btn-md z-depth-0"><span class="white-text">Créer un compte</span></a>
                                            <b class="font-weight-bold">OU</b>
                                            <a href="{{ route('login') }}" class="btn btn-grey btn-md z-depth-0"><span class="white-text">Se connecter</span></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br />


    <div class="container-fluid" id="produits">
        <div class="row mb-2">
            <div class="col-6"><a href="{{ route('register') }}"><b>Créer un compte pour rejoindre</b></a></div>
            <div class="col-6 text-right"><b>Coin des lecteurs et des auteurs</b></div>
        </div>
        <div class="row">
                @php
                    $i = 0
                @endphp
            @foreach (Publication::select('user_id')->distinct('user_id')->orderByDesc('id')->limit(18)->get() as $user_distinct)
                @foreach (Publication::orderByDesc('id')->limit(1)->where('user_id', $user_distinct->user_id)->get() as $publication)
                    @php
                        $i += 1
                    @endphp
                    <div class="col-xl-2 col-lg-3 float-left">
                        <div class="panel white" style="border-radius: 7px;">
                            <div class="panel-header pt-1 pb-1 pl-2 pr-2" style="border-radius: 7px;">
                                @if ($publication->but == "don")
                                    <table width="100%">
                                        <tr>
                                            <td width="38">
                                                <img src="{{ URL::asset($publication->fichier) }}" class="rounded-circle" alt="img-publication" width="100%">
                                            </td>
                                            <td class="pl-2 font-size-13" style="line-height: 18px;">
                                                <span class="badge badge-pill badge-danger z-depth-0">
                                                    Don anonyme
                                                </span><br />
                                                <small>{{ $publication->created_at }}</small>
                                            </td>
                                            <td class="text-right">

                                            </td>
                                        </tr>
                                    </table>
                                @else
                                   {{-- @foreach (User::where('id', $publication->user_id)->get() as $user) --}}
                                   @foreach (User::where('id', $publication->user_id)->get() as $user)
                                        <table width="100%">
                                            <tr>
                                                <td width="38">
                                                    @if ($user->visible == 1)
                                                        @if ($user->avatar != "default.png")
                                                            <a href="{{ route('uForeign', $user->id) }}">
                                                                <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                            </a>
                                                        @else
                                                            <a href="{{ route('uForeign', $user->id) }}">
                                                                <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if ($user->avatar != "default.png")
                                                            <a href="{{ route('uForeign', $user->id) }}" class="grey-text">
                                                                <i class="icofont-invisible icofont-2x"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('uForeign', $user->id) }}">
                                                                <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="pl-2 font-size-13" style="line-height: 18px;">
                                                    <div class="text-truncate">
                                                        <a href="{{ route('uForeign', $publication->id) }}" class="indigo-text">
                                                        @if ($user->visible == 1)
                                                           <b class="font-weight-bold">{{ $user->name }}</b>
                                                        @else
                                                            <span class="badge badge-pill badge-primary z-depth-0">
                                                                Invisible
                                                            </span>
                                                        @endif

                                                    </a>
                                                    </div>
                                                    <small>{{ $publication->created_at }}</small>
                                                </td>
                                                <td class="text-right">

                                                </td>
                                            </tr>
                                        </table>
                                    @endforeach
                                @endif
                            </div>
                            <div class="panel-body">
                                <div style="height: 150px; overflow: hidden;">
                                    <a href="{{ route('uForeign', $publication->id) }}">
                                        @switch($publication->but)
                                            @case("troc")
                                                    <div class="ribbon-wrapper ribbon-sm mr-2">
                                                        <div class="ribbon bg-orange text-md">
                                                            {{ "Troc" }}
                                                        </div>
                                                    </div>
                                                @break
                                            @case("vente")
                                                    <div class="ribbon-wrapper ribbon-sm mr-2">
                                                        <div class="ribbon bg-danger text-md">
                                                            Vente
                                                        </div>
                                                    </div>
                                                @break

                                            @case("don")
                                                    <div class="ribbon-wrapper ribbon-sm mr-2">
                                                        <div class="ribbon bg-success text-md">
                                                            {{ "Don" }}
                                                        </div>
                                                    </div>
                                                @break

                                            @default

                                        @endswitch
                                        <img src="{{ URL::asset($publication->fichier) }}" style="min-width: 280px; max-width: 100%;" alt="img-publication">
                                    </a>
                                </div>

                                <div class="p-2">
                                    <a href="{{ route('uForeign', $publication->id) }}" class="rounded border btn btn-block btn-sm z-depth-0" style="border: 1px solid #CCC;">
                                        <i class="icofont-plus"></i>
                                        Plus de détails
                                    </a>
                                </div>
                            </div>
                        </div><br />
                    </div>
                @endforeach
            @endforeach
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('plusPublication') }}" class="btn btn-blue btn-sm z-depth-0 white-text">
                    Afficher plus de produits
                </a>
            </div>
        </div><br /><br />
    </div>

    <div style="background: url(assets/images/back1.jpg); background-size: cover; background-position: center;">
        <h2 class="text-center pt-3 white-text" style="font-weight: 200;">
            L'idéal pour partager, troquer et vendre !
        </h2>
        <h5 class="text-center white-text">
            N'importe où, n'importe quand, partagez avec des proches, collègues ... Des biens que vous vendez ou services que vous vournissez.
        </h5>
        <div class="text-center mt-3">
            <a href="{{ route('register') }}" class="btn btn-outline-white btn-md z-depth-0">
                Créer le compte
            </a>
        </div><br />
    </div><br /><br />

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <div>
                    QUELQUES TÉMOIGNAGES DE NOS UTILISATEURS
                </div><br />
            </div>
            @for ($i = 0; $i < 6; $i++)
                <div class="col-lg-4 text-center">
                    <div class="panel white mb-3">
                        <div class="panel-body p-2">
                            <table>
                                <tr>
                                    <td width="38">
                                        <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                    </td>
                                    <td class="pl-2 font-size-13" style="line-height: 18px;">
                                        <small class="grey lighten-3">
                                            <span class="pl-5 pr-5">&nbsp;</span>
                                        </small><br />
                                        <small class="grey lighten-3">
                                            <span class="pl-5 pr-5">&nbsp;</span>
                                        </small>
                                    </td>
                                </tr>
                            </table>

                            <div class="text-justify p-2">
                                <div class="pt-1 pb-2 grey lighten-3 mb-1"></div>
                                <div class="pt-1 pb-2 grey lighten-3 mb-1"></div>
                                <div class="pt-1 pb-2 grey lighten-3 mb-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <div class="row">
            <div class="col-12">
                <br />
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-4 col-sm-12">

            </div>
            <div class="col-lg-4 col-sm-12 text-center">
                <form action="" method="post">
                    @csrf
                    <br />
                    <div class="form-group">
                        <div class="text-center">
                            <i class="icofont-comment blue-text icofont-2x"></i>
                        </div>
                        <label for="">Faire un commentaire ou un témoignage</label>
                        <textarea class="form-control mt-2" name="" id="" rows="3" placeholder="Saisir dans le champs ..."></textarea>
                        <button type="submit" class="btn btn-primary btn-md white-text mt-4">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-sm-12">

            </div>
        </div>-->
    </div><br />
    <footer class="pl-2 pr-2 font-size-13 text-center">

        <img src="{{ URL::asset('assets/images/cub.png') }}" alt="logo-CUBE" width="70">

        <img src="{{ URL::asset('assets/images/KI (2).jpg') }}" alt="logo-KI" width="70">

        <img src="{{ URL::asset('assets/images/PRIME.png') }}" alt="logo-PRIME" width="70">

        <img src="{{ URL::asset('assets/images/nunyalab.png') }}" alt="logo-nunyalab" width="70">

        <div class="mt-3">
            Produit de <b>CUBE</b> et <b>NUNYALAB</b>
        </div>

    </footer>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('a[href^="#"]').click(function (evt) {
                evt.preventDefault();
                let target = $(this).attr('href');

                $('html, body').stop().animate({scrollTop: $(target).offset().top}, 700);
            });
        });
    </script>
@endsection
