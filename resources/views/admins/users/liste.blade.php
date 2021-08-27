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
            <div class="col-lg-4">
                <h3>Liste de tous les utilisateurs inscrits</h3>
                Parcourez la liste de tous les utilisateurs isncrits sur CUBE STORE<br /><br />
            </div>
            <div class="col-lg-4 text-center">
                <!--<img src="{{ URL::asset('assets/images/cubebooks.jpg') }}" alt="logo" width="140" class="rounded">-->
            </div>
            <div class="col-lg-4">
                <div class="mb-2">
                    <small>
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <b>RECHERCHER UN UTILISATEUR</b>
                    </small>
                </div>
                <input type="search" name="search_q" id="search_q" placeholder="Saisir le nom ou la profession de l'utilisateur recherché ..." class="form-control">
            </div>
        </div>
        <div class="row" id="resultSearchRow">
            @foreach ($other_users as $other_user)
                <div class="col-lg-3">
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

                                    @if ($other_user->banni == 0)
                                        <a href="{{ route('adminBlockUser', $other_user->id) }}" class="red-text" onclick="return confirm('Êtes-vous sûr(e) de vouloir bloquer ce utilisateur ?')">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                            Bloquer
                                        </a>
                                    @else
                                        <a href="{{ route('adminUnBlockUser', $other_user->id) }}" class="green-text" onclick="return confirm('Êtes-vous sûr(e) de vouloir débloquer ce utilisateur ?')">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Débloquer
                                        </a>
                                    @endif
                                    
                                    &nbsp;&nbsp;
                                    <a href="{{ route('adminShowUser', $other_user->id) }}">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        Détails
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
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-end">
                    {{ $other_users }}
                  </ul>
                </nav>
            </div>
        </div>
    </div><br /><br />

@endsection

@section("js")
	<script>
		$(document).ready(function () {

            $('#search_q').keyup(function() {
                if ($(this).val() != "") {
                    $.ajax({
                        type : "GET",
                        url : "{{ route('getAdminsUsersResultSearch') }}",
                        data : {'search_q' : $(this).val()},
                        success : function(status) {
                            if (status != "") {
                                $('#resultSearchRow').html(status);
                            }
                        }
                    });
                }
            })
		});
	</script>
@endsection