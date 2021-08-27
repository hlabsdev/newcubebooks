
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

<div class="pt-3 pb-3 pl-3 pr-3" style="background-color: #116982;">
    <span class="white-text font-weight-bold">CUBE BOOKS</span>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{ route('adminCubeStoreListeUsers') }}">
        <span class="white-text">Utilisateurs</span>
    </a>&nbsp;&nbsp;
    <a href="{{ route('adminCubeStoreListeProduits') }}">
        <span class="white-text">Livres</span>
    </a>&nbsp;&nbsp;
    <a href="{{ route('allPublications') }}">
        <span class="white-text">Toutes les publications</span>
    </a>&nbsp;&nbsp;
    <a href="{{ route('allPublicites') }}">
        <span class="white-text">Publicités & annonces</span>
    </a>&nbsp;&nbsp;
    <a href="{{ route('adminCubeStoreListeManuscrits') }}">
        <span class="white-text">Manuscrits</span>
    </a>&nbsp;&nbsp;
    <a href="">
        <span class="white-text">Ventes</span>
    </a>&nbsp;&nbsp;
    <a href="{{ route('adminLiseMessages') }}">
        <span class="white-text">
            &RightArrowLeftArrow;
            Message diffusion
        </span>
    </a>

    <a href="{{ route('logout') }}" class="float-right white-text">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        Déconnexion
    </a>

    @if (count(LivreNotification::where('lu', 0)->get()) != 0)
        <a href="{{ route('adminCubeStoreListeNotifications') }}" class="float-right mr-4">
            <small><span class="badge badge-pill badge-danger z-depth-0">{{ count(LivreNotification::where('lu', 0)->get()) }}</span></small>
        </a>
        <a href="{{ route('adminCubeStoreListeNotifications') }}" class="float-right white-text">
            <i class="icofont-alarm"></i>
        </a>
    @else
        <a href="{{ route('adminCubeStoreListeNotifications') }}" class="float-right white-text mr-3">
            <i class="icofont-alarm"></i>
        </a>
    @endif

</div>
