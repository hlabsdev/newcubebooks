@extends('layouts.header')

@section('css')
    <style>
        #venteInputCover {
            display: none;
        }

        .content-center, .side-bar-left {
            margin-top: -350px;
        }
    </style>
@endsection


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

@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis" style="border: none;">
        <div class="white p-3" style="border: 1px solid #c2cfec;">
            <div>
                <small><b>MODIFIER UNE PUBLICATION</b></small>
            </div>
        </div>
        <div class="border-top"></div>
        <div class="row mt-2" style="border: none;">
            @foreach (Publication::where('id', $id)->orderByDesc('id')->get() as $publication)
                <div class="col-12 mb-2">
                    <div class="border-bottom white pb-2" style="border: 1px solid #c2cfec;">
                        <div>
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

                            <div class="p-4">
                                <img src="{{ URL::asset($publication->fichier) }}" class="mt-2" alt="img" width="100%">
                            </div>

                        </div>

                        <div class="m-4">
                            <form action="{{ route('updatePublication', $publication->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!--La publication est destinée à être
                                <div class="form-group">
                                    <select class="custom-select" name="but" id="but_conrol">
                                        <option value="" disabled selected>Cliquez pour sélectionner</option>
                                        <option value="troc">Un troc</option>
                                        <option value="vente">Une vente</option>
                                        <option value="don">Un don</option>
                                    </select>
                                </div>-->

                                <div class="form-group" id="trocInputCover">
                                    <label for="texte" class="mb-0">Saisir un texte à la publication</label>
                                    <input type="text" class="form-control" required name="texte" value="{{ $publication->texte }}" {{ $publication->texte }} id="texte" placeholder="Saisir dans le champs">
                                </div>

                                <input type="file" name="fichier" id="fichier" class="w-100">

                                <div class="text-right">
                                    <button type="submit" class="btn btn-outline-indigo btn-md z-depth-0">
                                        <b>Mettre à jour</b>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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
