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

        <div class="white p-3">
            <div class="text-center">
                <small><b>TOUTES MES NOTIFICATIONS</b></small>
            </div><br />

            <div class="list-group">
                @foreach (Commentaire::where("user_id", $_COOKIE['id'])->where('commenter_id', '<>', $_COOKIE['id'])->where('vu', 0)->get() as $commentaire)
                    <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}" class="list-group-item list-group-item-action">
                        <table width="100%">
                            @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)
                                <tr>
                                    <td width="40">
                                        <img src="{{ URL::asset('db/avatars/' . $user_comment->avatar . '') }}" alt="avatar" width="100%" class="rounded-circle" />
                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}" class="indigo-text">
                                            <b>{{ $user_comment->name }} <span class="text-muted">a fait un commentaire</span></b><br />
                                            <small class="black-text">{{ $commentaire->created_at }}</small>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40">

                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <span class="black-text font-weight-bold">{{ $commentaire->texte }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </a>
                @endforeach
                @foreach (ReponseCommentaire::where("user_id", $_COOKIE['id'])->where('commenter_id', '<>', $_COOKIE['id'])->where('vu', 0)->get() as $reponse_commentaire)
                    <a href="{{ route('showAnswerComment', [$reponse_commentaire->publication_id, $reponse_commentaire->commentaire_id, $reponse_commentaire->id]) }}" class="list-group-item list-group-item-action">
                        <table width="100%">
                            @foreach (User::where('id', $reponse_commentaire->commenter_id)->get() as $user_answer_comment)
                                <tr>
                                    <td width="40">
                                        <img src="{{ URL::asset('db/avatars/' . $user_answer_comment->avatar . '') }}" alt="avatar" width="100%" class="rounded-circle" />
                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <a href="{{ route('showAnswerComment', [$reponse_commentaire->publication_id, $reponse_commentaire->commentaire_id, $reponse_commentaire->id]) }}" class="indigo-text">
                                            <b>{{ $user_answer_comment->name }}  <span class="text-muted">a répondu à un commentaire</span></b><br />
                                            <small class="black-text">{{ $reponse_commentaire->created_at }}</small>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40">

                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <span class="black-text font-weight-bold">{{ $reponse_commentaire->texte }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </a>
                @endforeach
                @foreach (Commentaire::where("user_id", $_COOKIE['id'])->where('commenter_id', '<>', $_COOKIE['id'])->where('vu', 1)->get() as $commentaire)
                    <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}" class="list-group-item list-group-item-action">
                        <table width="100%">
                            @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)
                                <tr>
                                    <td width="40">
                                        <img src="{{ URL::asset('db/avatars/' . $user_comment->avatar . '') }}" alt="avatar" width="100%" class="rounded-circle" />
                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <a href="{{ route('showComment', [$commentaire->publication_id, $commentaire->id]) }}" class="indigo-text">
                                            <b>{{ $user_comment->name }}  <span class="text-muted">a fait un commentaire</span></b><br />
                                            <small class="black-text">{{ $commentaire->created_at }}</small>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40">

                                    </td>
                                    <td class="font-size-13 pl-2">
                                        <span class="black-text">{{ $commentaire->texte }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </a>
                @endforeach
            </div>
        </div>
    </div>



@endsection

@section('js')
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
