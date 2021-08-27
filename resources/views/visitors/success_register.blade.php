
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
            <div class="col-xl-3 col-lg-2 col-md-3">

            </div>
            <div class="col-xl-6 col-lg-8 col-md-6">

                <div class="text-center">
                    <h1>
                        Félicitations !
                    </h1><br />
                    <h5 style="line-height: 35px;">
                        La procédure d'insciption sur <b>Dolli</b> s'est terminée avec succès. Vous pouvez à présent
                        commencer par marchander, troquer, échanger des produits, biens ou service sur la plateforme.<br />

                        <b class="red-text">Très important :</b> Nous venons de vous envoyer un deuxième mail. Il contient
                        vos clées (privées et publiques) avec les conrtre-indications joints au mail.<br />
                        <b class="red-text">Nous vous conseillons fortement de consulter votre mail !!</b>
                    </h5><br />

                    <a href="{{ route('indexUsers') }}" class="btn btn-outline-indigo btn-lg rounded z-depth-0">
                        Accéder à la plateforme
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
