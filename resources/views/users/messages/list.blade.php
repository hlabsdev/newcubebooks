@extends('layouts.header')

@section('css')
    <style>

        #messageCover input {
            border: 1px solid #CCC;
            padding: 7px 15px;
        }

        #messagesBody {
            height: 72vh;
            overflow: auto;
            border: none;
        }

        #messagesBody div {
            border-radius: 25px;
        }

        @media(min-width: 1480px) {
            .side-bar-left {
                position: absolute;
                top: 60px;
                left: 10%;
                width: 21%;
                bottom: 0;
                border-left: 1px solid #85aabb;
                overflow: auto;
            }

            .side-bar-right {
                position: absolute;
                top: 60px;
                right: 10%;
                width: 21%;
                bottom: 0;
                border-right: 1px solid #85aabb;
            }

            .content-center {
                position: absolute;
                top: 60px;
                right: 31%;
                left: 31%;
                padding: 0 20px 20px 20px;
                bottom: 0;
            }
        }
    </style>
@endsection

@section('content')

    @if (isset($_COOKIE['gerant_id']))
        @include('included.menu_bar_gerant')
    @else

        @if (isset($_COOKIE['id']))
            @include('included.menu_bar_users')
        @endif

    @endif

    <div class="side-bar-left white Dosis">
        <div class="indigo lighten-5 text-center pt-1 pb-2">
            <small><b>DISCUSSIONS</b></small>
        </div>

        @foreach ($contacts as $contact)
            <div class="p-1 white border-bottom">

                <table>
                    @if (isset($_COOKIE['gerant_id']))
                        @if ($contact->user_id == 0)
                            @foreach (User::where('id', $contact->contact_id)->get() as $user)
                                <tr>
                                    <td width="50">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <div style="width: 50px; height: 50px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                                                @if($user->avatar == "default.png")
                                                    <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                                                @else
                                                    <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="font-size-13 pl-2" style="line-height: 15px;">
                                        <b class="blue-grey-text font-weight-bold">{{ $user->name }}</b><br />

                                        @foreach (Message::where('env_id', $user->id)->orWhere('rcp_id', $user->id)->orderByDesc('id')->limit(1)->get() as $message)

                                            @if($message->lu == 0 && $message->rcp_id == 0)
                                                <b class="font-weight-bold black-text">{{ substr($message->message, 0, 30) }} ...</b><br />
                                            @else
                                                <span class="black-text">{{ substr($message->message, 0, 30) }} ...</span><br />
                                            @endif

                                            <small class="black-text">{{ $message->created_at }}</small>
                                        @endforeach

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach (User::where('id', $contact->user_id)->get() as $user)
                                <tr>
                                    <td width="50">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <div style="width: 50px; height: 50px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                                                @if($user->avatar == "default.png")
                                                    <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                                                @else
                                                    <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="font-size-13 pl-2" style="line-height: 15px;">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <b class="blue-grey-text font-weight-bold">{{ $user->name }}</b><br />

                                            @foreach (Message::where('env_id', $user->id)->orWhere('rcp_id', $user->id)->orderByDesc('id')->limit(1)->get() as $message)

                                                @if($message->lu == 0 && $message->rcp_id == 0)
                                                    <b class="font-weight-bold black-text">{{ substr($message->message, 0, 30) }} ...</b><br />
                                                @else
                                                    <span class="black-text">{{ substr($message->message, 0, 30) }} ...</span><br />
                                                @endif

                                                <small class="black-text">{{ $message->created_at }}</small>
                                            @endforeach

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @else
                        @if ($contact->user_id == $_COOKIE['id'])
                            @foreach (User::where('id', $contact->contact_id)->get() as $user)
                                <tr>
                                    <td width="50">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <div style="width: 50px; height: 50px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                                                @if($user->avatar == "default.png")
                                                    <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                                                @else
                                                    <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="font-size-13 pl-2" style="line-height: 15px;">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <b class="blue-grey-text font-weight-bold">{{ $user->name }}</b><br />

                                            @foreach (Message::where('env_id', $user->id)->orWhere('rcp_id', $user->id)->orderByDesc('id')->limit(1)->get() as $message)

                                                @if($message->lu == 0 && $message->rcp_id == $_COOKIE['id'])
                                                    <b class="font-weight-bold black-text">{{ substr($message->message, 0, 30) }} ...</b><br />
                                                @else
                                                    <span class="black-text">{{ substr($message->message, 0, 30) }} ...</span><br />
                                                @endif

                                                <small class="black-text">{{ $message->created_at }}</small>
                                            @endforeach

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach (User::where('id', $contact->user_id)->get() as $user)
                                <tr>
                                    <td width="50">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <div style="width: 50px; height: 50px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                                                @if($user->avatar == "default.png")
                                                    <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                                                @else
                                                    <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="font-size-13 pl-2" style="line-height: 15px;">
                                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                                            <b class="blue-grey-text font-weight-bold">{{ $user->name }}</b><br />

                                            @foreach (Message::where('env_id', $user->id)->orWhere('rcp_id', $user->id)->orderByDesc('id')->limit(1)->get() as $message)

                                                @if($message->lu == 0 && $message->rcp_id == $_COOKIE['id'])
                                                    <b class="font-weight-bold black-text">{{ substr($message->message, 0, 30) }} ...</b><br />
                                                @else
                                                    <span class="black-text">{{ substr($message->message, 0, 30) }} ...</span><br />
                                                @endif

                                                <small class="black-text">{{ $message->created_at }}</small>
                                            @endforeach
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                </table>

            </div>
        @endforeach

    </div>

    <div class="content-center font-size-13 white border Dosis pt-1">

        @if ($rcv != "")
            @foreach ($users as $user)
                <div style="width: 50px; height: 50px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                    @if ($user->avatar == "default.png")
                        <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                    @else
                        <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                    @endif
                </div>
                <div class="text-center" style="border: none;">
                    <div class="font-size-13">
                        <b class="font-weight-bold">{{ $user->name }}</b>
                    </div>
                </div>
            @endforeach
        @else
            <br /><br />
            <small><b>Utilisateur non sélectionné</b></small>
        @endif

        <div id="messagesBody">

        </div>

        <div id="messageCover" style="border: none;" class="mt-2">

            @if ($rcv != "")
                <form id="sendMessageForm" method="get">
                    <input type="hidden" name="rcv" id="rcv" value="{{ $rcv }}">
                    <table class="w-100">
                        <tr>
                            <td>
                                <input type="text" name="message" id="message" class="w-100" placeholder="Saisir un message ..." style="border-radius: 25px;">
                            </td>
                            <td width="40">
                                <button type="submit" class="btn btn-grey z-depth-0 m-0 p-0 text-center rounded-circle white-text" style="line-height: 30px; height: 40px; width: 40px;">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            @endif

        </div>

    </div>

    <div class="side-bar-right white Dosis">
        <div class="indigo lighten-5 text-center pt-1 pb-2">
            <small><b>PROFIL</b></small>
        </div><br /><br />

        @if ($rcv != "")
            @foreach ($users as $user)
                <div style="width: 120px; height: 120px; overflow: hidden;" class="m-auto rounded-circle border white p-1">
                    @if ($user->avatar == "default.png")
                        <img src="{{ URL::asset('db/avatars/default.png') }}" alt="avatar-rcv" width="100%">
                    @else
                        <img src="{{ URL::asset($user->avatar) }}" alt="avatar-rcv" width="100%">
                    @endif
                </div>
                <div class="text-center pt-4">
                    <div class="font-size-13">
                        <b class="font-weight-bold">{{ $user->name }}</b><br />

                        <b class="font-weight-bold"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></b><br /><br />

                        <b>Téléphone : {{ $user->telephone }}</b><br />

                        <b>Profession : {{ $user->profession }}</b><br />

                    </div>
                </div>
            @endforeach
        @else
            <br /><br />
            <h6 class="text-center"><b>Utilisateur non sélectionné</b></h6>
        @endif

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

            setInterval(() => {
                $.ajax({
                    type : "GET",
                    url : "{{ route('usersGetMessages') }}",
                    data : {'rcv' : $('#rcv').val()},
                    success : function(status) {
                        if (status != "") {
                            $('#messagesBody').html(status);
                        }
                    }
                });
            }, 1000);

            $('#sendMessageForm').submit(function(e) {
                e.preventDefault()

                if ($('#message').val() != "") {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('usersSendMessage') }}",
                        data : {'message' : $('#message').val(), 'rcv' : $('#rcv').val()},
                        success : function(status) {
                            $('#message').val("")
                        }
                    });
                }

            })

		});
	</script>
@endsection
