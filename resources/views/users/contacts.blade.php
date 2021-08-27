
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

        #venteInputCover {
            display: none;
        }



        @media(max-width: 960px) {

            .content-center {
                position: absolute;
                top: 270px;
            }
        }
    </style>
@endsection

@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <b class="font-weight-bold">Mes contacts</b>
                </div>
            </div>
            <div class="row">
                @foreach ($contacts as $contact)
                    @if ($contact->user_id == $_COOKIE['id'])
                        @foreach (User::where('id', $contact->contact_id)->get() as $other_user)
                            <div class="col-lg-6">
                                <div class="white p-2 mb-3 rounded" style="border: 1px solid #CCC;">
                                    <table>
                                        <tr>
                                            <td width="50">
                                                <div style="width: 50px; height: 50px; overflow: hidden;" class="border rounded-circle">
                                                    @if ($other_user->avatar == "default.png")
                                                        <img src="{{ URL::asset('db/avatars/' . $other_user->avatar . '') }}" alt="img-avatr" width="100%">
                                                    @else
                                                        <img src="{{ URL::asset($other_user->avatar) }}" alt="img-avatr" width="100%">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="pl-3">
                                                <h6 class="text-truncate mb-0"><small><b class="font-weight-bold">{{ $other_user->name }}</b></small></h6>
                                                <small class="blue-grey-text">{{ $other_user->profession }}</small><br />

                                                <a href="{{ route('adminShowUser', $other_user->id) }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    Profil
                                                </a>

                                                &nbsp;&nbsp;
                                                <a href="{{ route('listMessages', ['rcv' => $other_user->id]) }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    Message
                                                </a>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach (User::where('id', $contact->user_id)->get() as $other_user)
                            <div class="col-lg-6">
                                <div class="white p-2 mb-3 rounded" style="border: 1px solid #CCC;">
                                    <table>
                                        <tr>
                                            <td width="50">
                                                <div style="width: 50px; height: 50px; overflow: hidden;" class="border rounded-circle">
                                                    @if ($other_user->avatar == "default.png")
                                                        <img src="{{ URL::asset('db/avatars/' . $other_user->avatar . '') }}" alt="img-avatr" width="100%">
                                                    @else
                                                        <img src="{{ URL::asset($other_user->avatar) }}" alt="img-avatr" width="100%">
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="pl-3">
                                                <h6 class="text-truncate mb-0"><small><b class="font-weight-bold">{{ $other_user->name }}</b></small></h6>
                                                <small class="blue-grey-text">{{ $other_user->profession }}</small><br />

                                                <a href="{{ route('otherProfile', $other_user->id) }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    Profil
                                                </a>

                                                &nbsp;&nbsp;
                                                <a href="{{ route('listMessages', ['rcv' => $other_user->id]) }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    Message
                                                </a>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
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
