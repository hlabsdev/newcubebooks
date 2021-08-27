
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
            <div class="col-xl-4 col-lg-5 col-md-3 col-sm-1">

                <h2 class="mt-2 mb-4">Données personnelles</h2>

                <form action="{{ route('registerDatasForm') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="nom_complet" class="Dosis mt-3 mb-0">Nom complet *</label>
                        <input type="text" class="form-control form-control-lg" id="nom_complet" name="nom_complet" required placeholder="Saisir dans le champs ..." />

                        <label for="telephone" class="Dosis mt-3 mb-0">Téléphone *</label>
                        <input type="text" class="form-control form-control-lg" id="telephone" name="telephone" required placeholder="Ex: +22891985311 ..." />

                        <label for="profession" class="Dosis mt-3 mb-0">Profession</label>
                        <input type="text" class="form-control form-control-lg" id="profession" name="profession" placeholder="Saisir dans le champs ..." />

                        <label for="code_postal" class="Dosis mt-3 mb-0">Code postal</label>
                        <input type="text" class="form-control form-control-lg" id="code_postal" name="code_postal" placeholder="Saisir dans le champs ..." />

                        <!--<div class="form-group">
                            <label for="bien" class="Dosis mt-3 mb-0">Service ou bien à marchander *</label>
                            <textarea class="form-control" required name="bien" id="bien" rows="2" placeholder="Ex: Je vends des produits agricoles ..."></textarea>
                        </div>-->

                        <div class="text-left mt-4">
                            <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                Suivant
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-1"></div>
            <div class="col-xl-7 col-lg-7 col-md-3 col-sm-1"><br /><br />

            </div>
        </div>
    </div>

@endsection
