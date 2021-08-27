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
                        <div class="white pt-3 pb-3">
                            <a href="#!" data-toggle="modal" data-target="#modelId">
                                <i class="icofont-plus"></i>
                                <b>Créer un nouvel auteur</b>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div>
                            <b>AUTEURS AJOUTES</b><br /><br />
                        </div>

                        @foreach (Auteur::where('user_id', $_COOKIE['id'])->orderByDesc('id')->get() as $auteur)
                            <div class="text-right">
                                <a href="{{ route('usersEditAuteur', $auteur->id) }}">
                                    <i class="icofont-edit"></i>
                                    Modifier
                                </a>&nbsp;&nbsp;

                                <a href="{{ route('usersDestroyAuteur', $auteur->id) }}" class="red-text" onclick="return confirm('Êtes-vous sûre de vouloir supprimer cet auteur ? Cette action sera irréversible.')">
                                    <i class="icofont-trash"></i>
                                    Supprimer
                                </a>
                            </div>

                            <div>

                                <div class="text-center">
                                    <img src="{{ URL::asset($auteur->photo) }}" alt="img-auteur" width="90" class="rounded-circle border">
                                </div>

                                <b>
                                    {{ $auteur->nom_complet }}
                                </b><br /><br />
                                <small><b>Biographie</b></small><br />
                                <div class="text-justify mb-2">
                                    {{ $auteur->biographie }}
                                </div>

                                <small><b>Bibliographie</b></small><br />
                                <div class="text-justify mb-2">
                                    {{ $auteur->bibiographie }}
                                </div>

                                <small><b>Lien site web ou page réseaux sociaux</b></small><br />
                                <a href="{{ $auteur->lien }}" target="_blank">
                                    {{ $auteur->lien }}
                                </a>

                            </div><hr />
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h6 class="modal-title">Créer un nouvel auteur</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('usersStoreAuteurs') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control mb-2" placeholder="Saisir le nom de l'auteur ..." name="nom_complet" required>

                        <div class="form-group mb-2">
                            <textarea class="form-control" name="biographie" required placeholder="Saisir la biographie l'auteur" rows="2"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <textarea class="form-control" name="bibiographie" required placeholder="Saisir la bibliographie de l'auteur" rows="2"></textarea>
                        </div>

                        <div class="font-size-14">
                            <small><b class="red-text">Photo de l'auteur [Format 90*90 fortement recomandé]</b></small>
                        </div>
                        <input type="file" name="couverture" required class="border w-100 p-2 mb-2 rounded">

                        <input type="text" class="form-control mb-2" name="lien" required placeholder="Lien site web ou page réseau sociaux">

                        <button type="submit" class="btn btn-block btn-blue-grey btn-md z-depth-0 rounded white-text">
                            <b>Créer l'auteur</b>
                        </button>

                    </form>

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
