
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
    <br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-3 col-sm-1">

                <h2 class="mt-2 mb-4">Connexion à un compte</h2>

                <form action="{{ route('loginForm') }}" method="post">
                    @csrf

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show font-size-13 mb-0" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          {{ $message }}
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show font-size-13 mb-0" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          {{ $message }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email" class="Dosis mt-3 mb-0">Email</label>
                        <input type="email" required class="form-control form-control-lg" id="email" name="email" placeholder="Saisir dans le champs ..." />

                        <label for="password" class="Dosis mt-3 mb-0">Mot de passe</label>
                        <input type="password" required class="form-control form-control-lg mb-2" id="password" name="password" placeholder="Saisir dans le champs ..." />

                        <a href="#!" data-toggle="modal" data-target="#modelId">Mot de passe oublié ?</a>

                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                Se connecter
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-1"></div>
            <div class="col-xl-7 col-lg-7 col-md-3 col-sm-1"><br />
                <h1 style="color: #ef6c00;"><b>CUBE BOOKS - Inscription</b></h1>
                <div>
                    <h5 style="line-height: 30px;">
                        Si vous n'avez pas encore de compte, créez le dès maintenant.
                        Le procesus ne prend que 2 minutes et se fait gatuitement !
                    </h5><br />
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="btn btn-outline-orange rounded btn-lg mr-0 z-depth-0">
                            Créer un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Récupération de mot de passe</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Toutes les informations que vous allez nous fournir ici doivent être celles que vous avez utilisées lors de votre incsription car elle seront soumises à des vérifications.
                    </div><br />

                    <form method="post" action="{{ route('resetPasswordForm') }}">
                        @csrf

                        <div class="form-group">
                            <label for="pays" class="Dosis mt-2 mb-0">Pays de résidence *</label>
                            <select required class="custom-select custom-select-lg Dosis" name="pays" id="pays">
                                <option selected disabled value="">Sélectionnez votre pays</option>
                                @forelse (\DB::table('pays')->orderBy('nom_fr_fr')->get() as $pays)
                                    <option value="{{ $pays->id }}">{{ $pays->nom_fr_fr }}</option>
                                @empty
                                    <option disabled value="">Aucun pays n'a ét renseigné !</option>
                                @endforelse
                            </select>

                            <label for="ville" class="Dosis mt-3 mb-0">La ville actuelle *</label>
                            <input type="text" required name="ville" id="ville" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                            <label for="quartier" class="Dosis mt-3 mb-0">Quartier *</label>
                            <input type="text" required name="quartier" id="quartier" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                            <label for="email" class="Dosis mt-3 mb-0">Email *</label>

                            <input type="email" required name="email" id="email" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                            <label for="nom_prenom" class="Dosis mt-3 mb-0">Nom complet *</label>

                            <input type="text" required name="nom_prenom" id="nom_prenom" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                            <div class="text-left mt-4">
                                <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                    Soumettre
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
