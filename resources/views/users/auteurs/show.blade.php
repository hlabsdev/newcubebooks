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
                padding-right: 5px;
                border-right: 1px solid #CCC;
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
        <div class="pr-2 pl-2" style="border: none !important;">
            <div class="container-fluid white">
                <div class="row">
                    <div class="col-12">
                        <br />
                        <div>
                            <a href="{{ route('usersListeAuteurs') }}">
                                &leftarrow;
                                Retour à la liste
                            </a>
                        </div>

                        <br />
                        <div>
                            <b>DETAILS AUTEUR</b><br /><br />
                        </div>

                        @foreach (Auteur::where('id', $id)->get() as $auteur)

                            <div class="text-center mb-2">
                                <img src="{{ URL::asset($auteur->photo) }}" alt="img-auteur" width="90" class="rounded-circle border">
                            </div>

                            <form action="{{ route('usersUpdateAuteurs', $id) }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="text" class="form-control mb-2" placeholder="Saisir le nom de l'auteur ..." value="{{ $auteur->nom_complet }}" name="nom_complet" required>

                                <div class="form-group mb-2">
                                    <textarea class="form-control" name="biographie" required placeholder="Saisir la biographie l'auteur" rows="2">{{ $auteur->biographie }}</textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <textarea class="form-control" name="bibiographie" required placeholder="Saisir la bibliographie de l'auteur" rows="2">{{ $auteur->bibiographie }}</textarea>
                                </div>

                                <div class="font-size-14">
                                    <small><b class="red-text">Photo de l'auteur [Format 90*90 fortement recomandé]</b></small>
                                </div>
                                <input type="file" name="couverture" class="border w-100 p-2 mb-2 rounded">

                                <input type="text" class="form-control mb-2" name="lien" value="{{ $auteur->lien }}" required placeholder="Lien site web ou page réseau sociaux">

                                <button type="submit" class="btn btn-block btn-blue-grey btn-md z-depth-0 rounded white-text">
                                    <b>Mettre à jour</b>
                                </button>

                            </form><br />

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
	<script>
		$(document).ready(function () {
            $('#avatar').change(function() {
                $('#avatarForm').submit();
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
