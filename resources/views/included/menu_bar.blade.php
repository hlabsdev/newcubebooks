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

<style>
    #resultSearch {
        position: fixed;
        height: 100vh;
        left: 0;
        right: 0;
        top: 60px;
        z-index: 4;
        display: none;
        overflow: auto;
    }

</style>
{{-- Soft UI Nav bar deb --}}
<div class="container top-0 position-sticky z-index-sticky">
    <div class="row">
        <div class="col-12">
            <nav
                class="top-0 py-2 mx-4 my-3 shadow navbar navbar-expand-lg blur blur-rounded z-index-fixed position-absolute start-0 end-0">
                <div class="container-fluid">
                    <a href="{{ route('indexVisitors') }}">
                        <img src="{{ URL::asset('assets/images/cubebooks.jpg') }}" alt="logo2" width="50">
                    </a>
                    <button class="shadow-none navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="mt-2 navbar-toggler-icon">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="pt-3 pb-2 collapse navbar-collapse py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                            <li class="my-auto nav-item ms-lg-auto">
                                <a href="{{ route('indexVisitors') }}" id="dropdownMenuPages" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Aller à l'accueil" aria-expanded="false">
                                    Accueil
                                </a>
                            </li>
                            <li class="my-auto nav-item ms-lg-auto">
                                <a href="{{ route('about') }}" id="dropdownMenuBlocks" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    En savoir plus
                                </a>
                            </li>
                            <li class="my-auto nav-item ms-lg-auto">
                                <a href="{{ route('contacts') }}">
                                    Contacts
                                </a>
                            </li>

                            <li class="my-auto nav-item ms-lg-auto">
                                <div class="py-2 mx-auto mt-3 text-center col-9 row">
                                        <div class="mb-3 input-group">
                                            <span class="input-group-text"><i class="fas fa-search"
                                                    aria-hidden="true"></i></span>
                                            <input class="form-control" id="usersSearch" placeholder="Recherche..."
                                                type="search">
                                        </div>

                                    {{-- <div class="mx-auto col-3">
                                        <div class="input-group">
                                            <button type="submit"
                                            class="w-auto btn bg-gradient-light me-2">GO</button>
                                        </div>
                                    </div> --}}
                                </div>

                            </li>

                            {{-- <li class="my-auto nav-item ms-lg-auto">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9 justify-content-center">
                                        <input type="search" id="usersSearch" placeholder="Rechercher ..."
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-3 justify-content-center">
                                        <button type="submit"
                                            class="w-auto btn bg-gradient-light me-2">Chercher</button>
                                    </div>
                                </div>
                            </li> --}}

                            @if (isset($_COOKIE['id']) && $_COOKIE['id'] != '')
                                @foreach (User::where('id', $_COOKIE['id'])->get() as $user)
                                    <li class="float-right my-auto nav-item ms-lg-auto">
                                        <div class="dropdown">
                                            <a href="{{ route('register') }}" id="triggerId" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}"
                                                    class="rounded-circle" width="35" alt="">
                                                <span
                                                    class="ml-1"><b>{{ substr($user->name, 0, strpos($user->name, ' ')) }}</b></span>
                                            </a>
                                            <div class="dropdown-menu fon-size-13" aria-labelledby="triggerId"
                                                style="line-height: 25px;">
                                                <a class="dropdown-item text-muted"
                                                    href="{{ route('indexUsers') }}">Accéder à mon
                                                    compte</a>
                                                <a class="dropdown-item text-muted" href="{{ route('logout') }}">
                                                    <i class="icofont-sign-out"></i>
                                                    Me déconnecter
                                                </a>
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            @else

                                <li class="my-auto nav-item ms-lg-0">
                                    <a href="{{ route('login') }}"
                                        class="mt-2 mb-0 btn btn-sm bg-gradient-secondary btn-round me-1 mt-md-0">Connexion</a>
                                </li>

                                <li class="my-auto nav-item ms-lg-0">
                                    <a href="{{ route('register') }}"
                                        class="mt-2 mb-0 btn btn-sm bg-gradient-secondary btn-round me-1 mt-md-0">Créer
                                        un
                                        compte</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
{{-- Soft UI Nav bar end --}}

{{-- old qppbqr deb --}}
<div class="menu-bar">
    <form action="" method="get" class="search-form">
        <ul class="list-inline lg-menu">
            <li class="mr-5 list-inline-item">
                <a href="{{ route('indexVisitors') }}">
                    <img src="{{ URL::asset('assets/images/cubebooks.jpg') }}" alt="logo2" width="50">
                </a>
            </li>
            <li class="mr-4 list-inline-item">
                <a href="{{ route('indexVisitors') }}">Accueil</a>
            </li>
            <li class="mr-4 list-inline-item">
                <a href="{{ route('about') }}">
                    En savoir plus
                </a>
            </li>
            <li class="mr-4 list-inline-item">
                <a href="{{ route('contacts') }}">
                    Contacts
                </a>
            </li>
            <li class="mr-5 list-inline-item">
                <a href="{{ route('login') }}">
                    <i class="icofont-login"></i>
                    Connexion
                </a>
            </li>
            <li class="mr-4 list-inline-item">
                <div>
                    <table class="white"
                        style="position: absolute; margin-top: -22px; line-height: 35px; border-radius: 3px; overflow: hidden;">
                        <tr>
                            <td>
                                <input type="search" id="usersSearch" placeholder="Rechercher un livre ...">
                            </td>
                            <td>
                                <button type="submit">
                                    Rechercher
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </li>

            @if (isset($_COOKIE['id']) && $_COOKIE['id'] != '')
                @foreach (User::where('id', $_COOKIE['id'])->get() as $user)
                    <li class="float-right list-inline-item">
                        <div class="dropdown">
                            <a href="{{ route('register') }}" id="triggerId" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}"
                                    class="rounded-circle" width="35" alt="">
                                <span
                                    class="ml-1"><b>{{ substr($user->name, 0, strpos($user->name, ' ')) }}</b></span>
                            </a>
                            <div class="dropdown-menu fon-size-13" aria-labelledby="triggerId"
                                style="line-height: 25px;">
                                <a class="dropdown-item text-muted" href="{{ route('indexUsers') }}">Accéder à mon
                                    compte</a>
                                <a class="dropdown-item text-muted" href="{{ route('logout') }}">
                                    <i class="icofont-sign-out"></i>
                                    Me déconnecter
                                </a>
                            </div>
                        </div>

                    </li>
                @endforeach
            @else
                <li class="float-right mr-4 list-inline-item">
                    <a href="{{ route('register') }}">
                        <i class="icofont-user"></i>
                        Créer un compte
                    </a>
                </li>
            @endif
            <li class="float-right pr-4 mr-4 list-inline-item">
                <a href="{{ route('register') }}">
                    <i class="icofont-plus"></i>
                    Ajouter un produit ou service
                </a>
            </li>
        </ul>

        <ul class="list-inline sm-menu">
            <li class="mr-5 list-inline-item">
                <a href="{{ route('indexVisitors') }}">
                    <img src="{{ URL::asset('assets/images/cubebooks.jpg') }}" alt="logo2" width="50">
                </a>
            </li>

            <li class="float-right list-inline-item">
                <i class="icofont-navigation-menu white-text" style="font-size: 18px;"></i>
            </li>
            @if (isset($_COOKIE['id']) && $_COOKIE['id'] != '')
                @foreach (User::where('id', $_COOKIE['id'])->get() as $user)
                    <li class="float-right mr-4 list-inline-item">
                        <div class="dropdown">
                            <a href="{{ route('register') }}" id="triggerId" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}"
                                    class="rounded-circle" width="35" alt="">
                                <span
                                    class="ml-1"><b>{{ substr($user->name, 0, strpos($user->name, ' ')) }}</b></span>
                            </a>
                            <div class="dropdown-menu fon-size-13" aria-labelledby="triggerId"
                                style="line-height: 25px;">
                                <a class="dropdown-item text-muted" href="{{ route('indexUsers') }}">Accéder à mon
                                    compte</a>
                                <a class="dropdown-item text-muted" href="{{ route('logout') }}">
                                    <i class="icofont-sign-out"></i>
                                    Me déconnecter
                                </a>
                            </div>
                        </div>

                    </li>
                @endforeach
            @else
                <li class="float-right list-inline-item">
                    <a href="{{ route('login') }}" class="mr-4">
                        <i class="icofont-login"></i>
                        <b>Connexion</b>
                    </a>
                </li>
            @endif
        </ul>

        <div class="xm-show sub-menu z-depth-1">
            <ul type="none" class="pl-3 pr-3" style="line-height: 35px;">
                <li>
                    <a href="{{ route('indexVisitors') }}">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}">
                        En savoir plus
                    </a>
                </li>
                <li>
                    <a href="{{ route('contacts') }}">
                        Contacts
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}">
                        Connexion
                    </a>
                </li>
                <li>
                    <div class="mt-2">
                        <table width="100%" class="white" style="border-radius: 3px !important;">
                            <tr>
                                <td>
                                    <input type="search" placeholder="Rechercher ..." style="width: 100% !important;">
                                </td>
                                <td width="60">
                                    <button type="submit" class="w-100 white-text" style="background-color: #3e0772;">
                                        <i class="icofont-search"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
    </form>

</div>
{{-- old qppbqr end --}}


<div id="resultSearch" class="white">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br />
                <div class="text-right">
                    <span id="resultSearchClose"><i class="fa fa-close"></i></span>
                </div>
            </div>
        </div>
        <div class="row" id="resultSearchRows">
            <div class="col-12">
                <br /><br /><br />
                <h1 class="text-center">Résultats en attente de saisie ...</h1>
            </div>
        </div>
    </div>
    <br /><br /><br />
</div>
