@extends('layouts.header')

@section('css')
    <style>

        #autreCategorieInput {
            display: none;
        }

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

    <div class="Dosis">
        @include('included.menu_bar_gerant')
    </div>

    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">

                <table width="100%" class="white" style="border: 1px solid #CCC;">
                    <tr>
                        <td class="p-2">
                            <h4>
                                <b class="font-weight-bold">Notifications</b>
                            </h4>
                        </td>
                        <td class="text-right p-2">
                            <a href="{{ route('adminCubeStoreReadAllNotifications') }}" onclick="return confirm('Tout marquer comme lu ?')">
                                <b>Tout marquer comme lu</b>
                            </a>
                        </td>
                    </tr>
                </table><hr class="mt-1 mb-1" />

                <table style="border: 1px solid #CCC;" width="100%">
                    @foreach ($livre_notifications as $livre_notification)
                        <tr class="white border-bottom">
                            <td width="100" class="pb-2 pt-2 pl-2">
                                <a href="{{ route('usersCubeStoreCommander', [$livre_notification->titre_livre, $livre_notification->livre_id]) }}">
                                    <div style="height: 50px; overflow: hidden;">
                                        <img src="{{ URL::asset($livre_notification->couverture_livre) }}" alt="img-livre" width="100">
                                    </div>
                                </a>
                            </td>
                            <td class="p-2">
                                <small>
                                    <a href="{{ route('adminShowUser', $livre_notification->user_id) }}">
                                        @foreach (User::where('id', $livre_notification->user_id)->get() as $user)
                                            <b>{{ $user->name }}</b>
                                        @endforeach
                                    </a> a publié un livre <i class="icofont-history"></i>
                                    {{ $livre_notification->created_at }}
                                </small>
                                @if ($livre_notification->lu == 0)
                                    <small><span class="badge badge-pill badge-primary z-depth-0">Non lu</span></small>
                                @endif
                                <br />
                                <div>
                                    @if ($livre_notification->lu == 1)
                                        <h6 class="text-truncate mb-0">
                                            @if(strlen($livre_notification->titre_livre) > 50)
                                            {{ substr($livre_notification->titre_livre, 0, 50) }}
                                            @else
                                                {{ $livre_notification->titre_livre }}
                                            @endif
                                        </h6>
                                    @else
                                        <h6 class="text-truncate mb-0"><b class="font-weight-bold">

                                            @if(strlen($livre_notification->titre_livre) > 50)
                                            {{ substr($livre_notification->titre_livre, 0, 50) }}
                                            @else
                                                {{ $livre_notification->titre_livre }}
                                            @endif
                                            </b></h6>
                                    @endif
                                </div>

                                <a href="{{ route('usersCubeStoreCommander', [$livre_notification->titre_livre, $livre_notification->livre_id]) }}">
                                    Obtenir les détails du livre
                                    &rightarrow;
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table><br />

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $livre_notifications }}
                    </ul>
                </nav>

            </div>
        </div>
    </div><br /><br />

@endsection

@section("js")
	<script>
		$(document).ready(function () {


		});
	</script>
@endsection
