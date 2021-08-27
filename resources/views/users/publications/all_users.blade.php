
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
        #venteInputCover {
            display: none;
        }
    </style>
@endsection


@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis" style="border: none;">
        <div class="white p-3" style="border: 1px solid #c2cfec;">
            <div>
                <small><b>PARTAGER UN BIEN OU SERVICE</b></small>

                <div class="form-group mt-1 mb-0">
                    <textarea class="form-control font-size-13" readonly name="" id="" rows="1" placeholder="Cliquez ici pour partager" data-toggle="modal" data-target="#modelPublication"></textarea>
                </div>
            </div>
        </div>
        <div class="border-top"></div>
        <div class="row mt-2" style="border: none;">
            @foreach (Publication::orderByDesc('id')->where('user_id', $user_id)->get() as $publication)
                <div class="col-12 mb-2">
                    <div class="border-bottom white pt-1 pb-2" style="border: 1px solid #c2cfec;">

                        <div class="font-size-14 mb-2 mt-2 pl-2 pr-4 mr-4">

                            <table width="100%">
                                <tr>
                                    @foreach(User::where('id', $publication->user_id)->get() as $user_publication)
                                        <td width="30">
                                            <img src="{{ URL::asset('db/avatars/' . $user_publication->avatar . '') }}" class="rounded-circle" alt="img" width="100%">
                                        </td>
                                        <td class="pl-2 font-size-12">
                                            <a href="#!">{{ $user_publication->name }}</a><br />
                                            <small class="text-muted">{{ $publication->created_at }}</small>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                            <div class="mt-2">
                                {{ $publication->texte }}
                            </div>
                        </div>

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

                            <img src="{{ URL::asset($publication->fichier) }}" class="mt-2" alt="img" width="100%">
                        </div>

                        <div class="mt-2">
                            <div class="pl-2 pr-2">
                                <!--<a href="">
                                    J'aime
                                </a>
                                <a href="">
                                    <i class="icofont-thumbs-up grey-text"></i>
                                    <span class="black-text">10</span>
                                </a>&nbsp;&nbsp;&nbsp;-->
                                <a href="#!" class="text-muted">
                                    Commentaires
                                    <i class="icofont-speech-comments"></i>
                                    <span class="text-dark">
                                        @if (count(Commentaire::where('publication_id', $publication->id)->get()) != 0)
                                            {{ count(Commentaire::where('publication_id', $publication->id)->get()) }}
                                        @endif
                                    </span>
                                </a>
                                @if($publication->user_id == $_COOKIE['id'])
                                    <div class="dropdown float-right">
                                        <a href="" class="indigo-text" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            <i class="icofont-dotted-down icofont-2x"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                            <a class="dropdown-item font-size-13" href="{{ route('editPublication', $publication->id) }}">
                                                Modifier cette publication
                                            </a>
                                            <a class="dropdown-item font-size-13" href="{{ route('destroyPublication', $publication->id) }}" onclick="return confirm('Êtes-vous sûre ? Cette action sera iréversible !')">
                                                Supprimer cette publication
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="comment-cover comment-result{{ $publication->id }} mt-3 pl-2 pr-2">
                                <table width="100%">
                                    @forelse (Commentaire::where('publication_id', $publication->id)->orderBy('id')->limit(3)->get() as $commentaire)
                                        <tr>
                                            @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)

                                            @endforeach
                                            <td width="35">
                                                <img src="{{ URL::asset('db/avatars/1.jpg') }}" class="rounded-circle" alt="img-avatr" width="100%">
                                            </td>
                                            <td class="pl-2 font-size-12" style="line-height: 17px;">
                                                <a href="">
                                                    {{ $user_comment->name }}
                                                </a><br />
                                                <small>{{ $commentaire->created_at }}</small>
                                            </td>
                                            <td class="text-right">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="35">

                                            </td>
                                            <td class="pl-2">
                                                <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}">
                                                    <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-1 black-text">
                                                        {{ $commentaire->texte }}
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="pt-2 pl-2">
                                                <table width="100%">
                                                    @forelse (ReponseCommentaire::where('commentaire_id', $commentaire->id)->get() as $reponse_commentaire)
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div style="height: 35px">
                                                                        <i class="icofont-comment font-size-12"></i>
                                                                        <span class="text-muted"><small>Réponse à ce commentaire</small></span><br />
                                                                        <small>{{ $reponse_commentaire->created_at }}</small>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2>
                                                                    <a href="">
                                                                        <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-2 black-text">
                                                                            {{ $reponse_commentaire->texte }}
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty

                                                        @endforelse
                                                </table>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </table>

                                <div class="comment-form pt-2">
                                    @csrf
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control font-size-13 input-comment" placeholder="Saisir un commentaire ..." id="comment{{ $publication->id }}">
                                            </td>
                                            <td width=40>
                                                <button type="submit" class="float-right btn btn-indigo p-0 rounded-circle m-0 white-text z-depth-0 submit-comment-btn" data-value="{{ $publication->id }}" data-user="{{ $publication->user_id }}"
                                                style="width: 40px; height: 40px; line-height: 36px;">
                                                    <i class="icofont-paper-plane"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('#identiteSwitch').change(function() {
                if ($(this).prop('checked')) {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('updateVisible') }}",
                        data : {"visible" : 1},
                        success : function(status) {
                            //console.log(status);
                        }
                    });
                } else {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('updateVisible') }}",
                        data : {"visible" : 0},
                        success : function(status) {
                            //console.log(status);
                        }
                    });
                }
            });

            $('.submit-comment-btn').each(function () {
                $(this).click(function () {
                    var comment = $('#comment' + $(this).attr('data-value')).val();
                    var publication_id = $(this).attr('data-value');
                    var user_id = $(this).attr('data-user');
                    if (comment.trim() != "") {
                        $.ajax({
                            type : "GET",
                            url : "{{ route('storeComment') }}",
                            data : {"comment" : comment.trim(), "publication_id" : publication_id, "user_id" : user_id},
                            success : function(status) {
                                $('#comment' + publication_id).val("");
                                $('.comment-result' + publication_id + ">table").append(status);
                            }
                        });
                    }
                });
            });

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
