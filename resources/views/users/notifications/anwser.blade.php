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

        <div class="white p-3">
            <div class="text-center">
                <small><b>REPONSES PUBLICATION</b></small>
            </div><br />

            @foreach (Publication::where('id', $publication_id)->get() as $publication)
                <div>
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

                    <img src="{{ URL::asset($publication->fichier) }}" class="mt-2" alt="img" width="100%">

                    <div class="font-size-14 mb-3 mt-2 pl-2 pr-2">
                        <h5>{{ $publication->texte }}</h5>
                    </div>
                </div>

                <div class="mt-2">

                    <div class="comment-cover comment-result{{ $publication->id }} mt-3 pl-2 pr-2">
                        <table width="100%">
                            @forelse (Commentaire::where('id', $commentaire_id)->orderByDesc('id')->limit(1)->get() as $commentaire)
                                <tr>
                                    @foreach (User::where('id', $commentaire->commenter_id)->get() as $user_comment)
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
                                    @endforeach
                                </tr>
                                <tr>
                                    <td width="35">

                                    </td>
                                    <td class="pl-2">
                                        <a href="">
                                            <div class="comment-content font-size-12 grey lighten-3 pt-1 pb-1 pr-3 pl-3 mt-1 black-text">
                                                {{ $commentaire->texte }}
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </table>

                        <div class="comment-form pt-2">
                            @csrf
                            <table width="100%">
                                <tr>
                                    <td width="40"></td>
                                    <td>
                                        <br />
                                        <div class="comment-result{{ $commentaire->id }}">
                                            <table width=100%>
                                                @forelse (ReponseCommentaire::where('id', $reponse_id)->get() as $reponse_commentaire)
                                                    <tr>
                                                        <td colspan="2">
                                                            <div style="height: 35px">
                                                                <i class="icofont-history font-size-12"></i>
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
                                            </table><br />
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
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
