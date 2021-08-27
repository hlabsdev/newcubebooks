
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-3">

            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">

                <div class="text-center">
                    <h1>
                        <i class="icofont-email green-text icofont-2x"></i><br />
                        Email envoyé !
                    </h1>
                    <h5 style="line-height: 35px;">
                        Un email vient d'être envoyé à l'adresse email que vous avez saisi. Vérifiez votre boite mail
                        et utilisez le lien dans le mail pour la suite de l'opération.
                    </h5><br />
                    <a href="https://mail.google.com">
                        Accéder à Gmail
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
