
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

    <div class="container">
        <div class="row">
            <div class="col-12"><br /><br /><br /><br />
                <h5>Nos contacts</h5>

                <address>
                    Teléphone : +228 91 98 53 11<br /><br />

                    Email : <a href="mailto:contact@dolli-app.com">contact@dolli-app.com</a>
                </address>
            </div>
        </div>
    </div>

@endsection
