
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

                <h2 class="mt-2 mb-4">Création de compte</h2>

                <form action="{{ route('registerForm') }}" method="post">
                    @csrf

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show font-size-13 mb-0" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          {{ $message }}
                        </div>
                    @endif

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

                        <div>
                            <b>NB : </b> Nous vous prions d'entrer une adresse email valide car cette adresse sera utilisée pour toutes les transactions et notifications sur la plateforme.
                        </div>

                        <input type="email" required name="email" id="email" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                        <div class="text-left mt-4">
                            <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                Suivant
                            </button>

                            <div class="text-center">
                                En cliquant sur suivant, nous considérons que vous avez lu et accepté les <a href="{{ route('about') }}">Les conditions d'utilisation</a> de notre plateforme CUBE BOOKS.
                            </div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-1"></div>
            <div class="col-xl-7 col-lg-7 col-md-3 col-sm-1"><br /><br />
                <h1 style="color: #ef6c00;"><b>CUBE BOOKS - Connexion</b></h1>
                <div>
                    <h5  style="line-height: 30px;">Si vous avez déjà un compte, connectez-vous et partagez des livres, envoyez un manuscrit et rejoignez notre communauté d'auteurs et de lecteurs.</h5><br />
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-orange rounded btn-lg mr-0 z-depth-0">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
