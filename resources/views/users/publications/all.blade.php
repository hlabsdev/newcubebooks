
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

@section('css')
    <style>
        @media(min-width: 1480px) {
            .side-bar-left {
                position: absolute;
                top: 60px;
                left: 15%;
                width: 16%;
                bottom: 0;
            }

            .side-bar-right {
                position: absolute;
                top: 60px;
                right: 15%;
                width: 16%;
            }

            .content-center {
                position: absolute;
                top: 60px;
                right: 31%;
                left: 31%;
                padding: 0 20px 20px 20px;
            }
        }
    </style>
@endsection

@section('content')


    @if(isset($_COOKIE['gerant_id']))

        @include('included.menu_bar_gerant')
        <br />

        <div class="container-fluid">
            <div class="row">
                @foreach (Publication::orderByDesc('id')->get() as $publication)
                <div class="col-xl-3 col-lg-3 float-left">
                    <div class="panel white">
                        <div class="panel-header pt-1 pb-1 pl-2 pr-2">
                            @if ($publication->but == "don")
                                <table width="100%">
                                    <tr>
                                        <td width="38">
                                            <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
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
                               @foreach (User::where('id', $publication->user_id)->get() as $user)
                                    <table width="100%">
                                        <tr>
                                            <td width="38">
                                                @if ($user->visible == 1)
                                                    @if ($user->avatar == "default.png")
                                                        <a href="#{{ route('uForeign', $user->id) }}">
                                                            <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        </a>
                                                    @else
                                                        <a href="#{{ route('uForeign', $user->id) }}">
                                                            <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        </a>
                                                    @endif
                                                @else
                                                    @if ($user->avatar == "default.png")
                                                        <a href="#{{ route('uForeign', $user->id) }}" class="grey-text">
                                                            <i class="icofont-invisible icofont-2x"></i>
                                                        </a>
                                                    @else

                                                    @endif
                                                @endif
                                            </td>
                                            <td class="pl-2 font-size-13" style="line-height: 18px;">
                                            	<div class="text-truncate">
                                            		<a href="#{{ route('uForeign', $publication->id) }}" class="indigo-text">
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
                        <div class="panel-body grey lighten-1">
                            <div style="height: 150px; overflow: hidden;" class="rounded">
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
                                    <img src="{{ URL::asset($publication->fichier) }}" style="min-width: 280px; max-width: 100%;" class="rounded" alt="img-avatr">
                                </a>
                            </div>
                            @if(isset($_COOKIE['gerant_id']))
                                <a href="{{ route('destroyPublication', $publication->id) }}" onclick="return confirm('Êtes-vous sûre de vouloir supprimer cette publication ? Cette action sera irréversible !')" class="btn btn-danger btn-sm z-depth-0 btn-block rounded white-text">
                                    Supprimer cette publication
                                </a>
                            @endif
                        </div>
                    </div><br />
                </div>
            @endforeach

        	@foreach(Publication::select('categorie')->distinct('categorie')->where('categorie', 'Autres')->get() as $categorie)
        	    <div class="col-12">
	            	<b>Catégorie : {{ $categorie->categorie }}</b>
	            </div>
	            @foreach (Publication::orderByDesc('id')->limit(18)->where('categorie', $categorie->categorie)->get() as $publication)
	                <div class="col-xl-4 col-lg-6 float-left">
	                    <div class="panel white">
	                        <div class="panel-header pt-1 pb-1 pl-2 pr-2">
	                            @if ($publication->but == "don")
	                                <table width="100%">
	                                    <tr>
	                                        <td width="38">
	                                            <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
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
	                               @foreach (User::where('id', $publication->user_id)->get() as $user)
	                                    <table width="100%">
	                                        <tr>
	                                            <td width="38">
	                                                @if ($user->visible == 1)
	                                                    @if ($user->avatar == "default.png")
	                                                        <a href="#{{ route('uForeign', $user->id) }}">
	                                                            <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
	                                                        </a>
	                                                    @else

	                                                    @endif
	                                                @else
	                                                    @if ($user->avatar == "default.png")
	                                                        <a href="#{{ route('uForeign', $user->id) }}" class="grey-text">
	                                                            <i class="icofont-invisible icofont-2x"></i>
	                                                        </a>
	                                                    @else

	                                                    @endif
	                                                @endif
	                                            </td>
	                                            <td class="pl-2 font-size-13" style="line-height: 18px;">
	                                            	<div class="text-truncate">
	                                            		<a href="#{{ route('uForeign', $publication->id) }}" class="indigo-text">
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
	                        <div class="panel-body grey lighten-1">
	                            <div style="height: 150px; overflow: hidden;" class="rounded">
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
	                                    <img src="{{ URL::asset($publication->fichier) }}" style="min-width: 280px; max-width: 100%;" class="rounded" alt="img-avatr">
	                                </a>
	                            </div>
	                        </div>
	                    </div><br />
	                </div>
	            @endforeach
        	@endforeach
            </div>
        </div>

    @else
        @include('included.menu_bar_users')

        @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
	<div class="container-fluid" id="produits">
	<br />
        <div class="row">
    	    <div class="col-12">
            	<b>Toutes les publications</b>
            </div>

        	@foreach (Publication::orderByDesc('id')->get() as $publication)
                <div class="col-xl-6 col-lg-6 float-left">
                    <div class="panel white">
                        <div class="panel-header pt-1 pb-1 pl-2 pr-2">
                            @if ($publication->but == "don")
                                <table width="100%">
                                    <tr>
                                        <td width="38">
                                            <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
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
                               @foreach (User::where('id', $publication->user_id)->get() as $user)
                                    <table width="100%">
                                        <tr>
                                            <td width="38">
                                                @if ($user->visible == 1)
                                                    @if ($user->avatar == "default.png")
                                                        <a href="#{{ route('uForeign', $user->id) }}">
                                                            <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        </a>
                                                    @else
                                                        <a href="#{{ route('uForeign', $user->id) }}">
                                                            <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
                                                        </a>
                                                    @endif
                                                @else
                                                    @if ($user->avatar == "default.png")
                                                        <a href="#{{ route('uForeign', $user->id) }}" class="grey-text">
                                                            <i class="icofont-invisible icofont-2x"></i>
                                                        </a>
                                                    @else

                                                    @endif
                                                @endif
                                            </td>
                                            <td class="pl-2 font-size-13" style="line-height: 18px;">
                                            	<div class="text-truncate">
                                            		<a href="#{{ route('uForeign', $publication->id) }}" class="indigo-text">
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
                        <div class="panel-body grey lighten-1">
                            <div style="height: 150px; overflow: hidden;" class="rounded">
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
                                    <img src="{{ URL::asset($publication->fichier) }}" style="min-width: 280px; max-width: 100%;" class="rounded" alt="img-avatr">
                                </a>
                            </div>
                            @if(isset($_COOKIE['gerant_id']))
                                <a href="" onclick="return confirm('Êtes-vous sûre de vouloir supprimer cette publication ? Cette action sera irréversible !')" class="btn btn-danger btn-sm z-depth-0 btn-block rounded white-text">
                                    Supprimer cette publication
                                </a>
                            @endif
                        </div>
                    </div><br />
                </div>
            @endforeach

        	@foreach(Publication::select('categorie')->distinct('categorie')->where('categorie', 'Autres')->get() as $categorie)
        	    <div class="col-12">
	            	<b>Catégorie : {{ $categorie->categorie }}</b>
	            </div>
	            @foreach (Publication::orderByDesc('id')->limit(18)->where('categorie', $categorie->categorie)->get() as $publication)
	                <div class="col-xl-4 col-lg-6 float-left">
	                    <div class="panel white">
	                        <div class="panel-header pt-1 pb-1 pl-2 pr-2">
	                            @if ($publication->but == "don")
	                                <table width="100%">
	                                    <tr>
	                                        <td width="38">
	                                            <img src="{{ URL::asset('db/avatars/default.png') }}" class="rounded-circle" alt="img-avatr" width="100%">
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
	                               @foreach (User::where('id', $publication->user_id)->get() as $user)
	                                    <table width="100%">
	                                        <tr>
	                                            <td width="38">
	                                                @if ($user->visible == 1)
	                                                    @if ($user->avatar == "default.png")
	                                                        <a href="#{{ route('uForeign', $user->id) }}">
	                                                            <img src="{{ URL::asset($user->avatar) }}" class="rounded-circle" alt="img-avatr" width="100%">
	                                                        </a>
	                                                    @else

	                                                    @endif
	                                                @else
	                                                    @if ($user->avatar == "default.png")
	                                                        <a href="#{{ route('uForeign', $user->id) }}" class="grey-text">
	                                                            <i class="icofont-invisible icofont-2x"></i>
	                                                        </a>
	                                                    @else

	                                                    @endif
	                                                @endif
	                                            </td>
	                                            <td class="pl-2 font-size-13" style="line-height: 18px;">
	                                            	<div class="text-truncate">
	                                            		<a href="#{{ route('uForeign', $publication->id) }}" class="indigo-text">
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
	                        <div class="panel-body grey lighten-1">
	                            <div style="height: 150px; overflow: hidden;" class="rounded">
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
	                                    <img src="{{ URL::asset($publication->fichier) }}" style="min-width: 280px; max-width: 100%;" class="rounded" alt="img-avatr">
	                                </a>
	                            </div>
	                        </div>
	                    </div><br />
	                </div>
	            @endforeach
        	@endforeach
        </div>
    </div>

    </div>

    @endif

@endsection

@section("js")
	<script>
		$(document).ready(function () {
		       setInterval(() => {
	                $.ajax({
	                    type : "GET",
	                    url : "{{ route('getBadgeNotifications') }}",
	                    data : {},
	                    success : function(status) {
	                        if (status != 0) {
	                            $('.nbNotifications').html("<span class='red white-text pl-1 pr-1'>" + status + "</span>");
	                        }
	                    }
	                });
	            }, 2000);
		});
	</script>
@endsection
