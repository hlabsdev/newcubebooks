
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

                <h2 class="mt-2 mb-4">Mot de passe</h2>

                <div class="alert alert-warning alert-dismissible fade show text-justify font-size-14" role="alert">
                    Choisissez un mot de passe, celui que vous allez utilisez lors de vos prochaines connexions puis confimez-le.
                </div>

                <div class="text-right">
                    <a href="#!" id="generatePasswordLink">
                        Générer un mot de passe
                    </a>
                </div>
                <span id="showPassword">&nbsp;</span>
                <form action="{{ route('registerPasswordForm') }}" method="post">
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
                        <label for="password" class="Dosis mt-3 mb-0">Mot de passe</label>
                        <input type="password" id="password" required name="password" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                        <label for="password_confirm" class="Dosis mt-3 mb-0">Confirmer mot de passe</label>
                        <input type="password" id="password_confirm" required name="password_confirm" class="form-control form-control-lg" placeholder="Saisir dans le champs ..." />

                        <div class="text-left mt-4">
                            <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                Suivant
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-xl-1 col-lg-1 col-md-3 col-sm-1"></div>
            <div class="col-xl-7 col-lg-7 col-md-3 col-sm-1"><br /><br /><br />
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#generatePasswordLink').click(function () {
                var rand_password = {{ rand(569854221, 986589998) }};
                $('#password').val(rand_password);
                $('#showPassword').html("Mot de passe auto-généré : <b>" + rand_password + "</b>");
            });
        });
    </script>
@endsection
