
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

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        Publication
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
