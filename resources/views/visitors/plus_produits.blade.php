
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

	<div class="container-fluid" style="margin-top: 60px;" id="produits">
	<br />
        <div class="row">
        	@foreach(Publication::select('categorie')->distinct('categorie')->where('categorie', '<>', 'Autres')->get() as $categorie)
        	    <div class="col-12">
	            	<b>Catégorie : {{ $categorie->categorie }}</b>
	            </div>
	            @foreach (Publication::orderByDesc('id')->limit(18)->where('categorie', $categorie->categorie)->get() as $publication)
	                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 float-left">
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

        	@foreach(Publication::select('categorie')->distinct('categorie')->where('categorie', 'Autres')->get() as $categorie)
        	    <div class="col-12">
	            	<b>Catégorie : {{ $categorie->categorie }}</b>
	            </div>
	            @foreach (Publication::orderByDesc('id')->limit(18)->where('categorie', $categorie->categorie)->get() as $publication)
	                <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 float-left">
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

@endsection
