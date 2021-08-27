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

    <div class="container-fluid white">
        <br />
        <div class="row">
            <div class="col-12">
                <h3>Liste de tous les manuscrits ajoutés</h3><br />

                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                        <tr>
                            <th>
                                Nom auteur
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Pays
                            </th>
                            <th>
                                Ville
                            </th>
                            <th>
                                Téléphone
                            </th>
                            <th>
                                Titre du manuscrit
                            </th>
                            <th>
                                Résumé du manuscrit
                            </th>
                            <th width="100" class="text-center">
                                Manuscrit
                            </th>
                            <th width="100" class="text-center">
                                Couverture
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manuscrits as $manuscrit)
                            <tr>
                                @foreach (User::where('id', $manuscrit->user_id)->get() as $user)
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @foreach (Pays::where('id', $user->pays_id)->get() as $pays)
                                            {{ $pays->nom_fr_fr }}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $user->ville }}
                                    </td>
                                    <td>
                                        {{ $user->telephone }}
                                    </td>
                                @endforeach
                                <td>
                                    {{ $manuscrit->titre }}
                                </td>
                                <td>
                                    {{ $manuscrit->resume }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ URL::asset($manuscrit->manuscrit) }}" download>
                                        <i class="icofont-download"></i>
                                        Télécharcger
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div style="height: 50px; overflow: hidden;">
                                        <img src="{{ URL::asset($manuscrit->couverture) }}" alt="couverture-manuscrit" width="100%">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div><br />
    </div>

@endsection

@section("js")
	<script>
		$(document).ready(function () {
            $('#dataTable').dataTable()
		});
	</script>
@endsection
