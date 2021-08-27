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

        #venteInputCover {
            display: none;
        }



        @media(max-width: 960px) {


            .content-center {
                position: absolute;
                top: 260px;
            }
        }
    </style>
@endsection

@section('content')

    @include('included.menu_bar_users')

    @include('included.side_bar_left')

    <div class="content-center font-size-13 Dosis">
        <div class="pl-2 pr-2" style="border: none !important;">
            <h5 class="pt-2">Mes manuscrits</h5>


            @if ($message = Session::get('success'))
                <div class="green white-text pt-2 pb-2 text-center">
                    {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="red white-text pt-2 pb-2 text-center">
                    {{ $message }}
                </div>
            @endif

            <div class="text-right">
                <a href="#!" data-toggle="modal" data-target="#modelManuscritId">
                    <i class="icofont-plus"></i>
                    <b>Créer un manuscrit</b>
                </a>
            </div><br />

            @php
                $i = 1
            @endphp

            @forelse (Manuscrit::where('user_id', $_COOKIE['id'])->get() as $manuscrit)
                <div class="text-right">
                    <b>Manuscrit {{ $i }}</b>
                </div>
                <b>Titre :</b> {{ $manuscrit->titre }}<br /><br />
                <b>Résumé du manuscrit :</b>
                <div class="text-justify">
                    {{ $manuscrit->resume }}
                </div><br />

                <b>Manuscrit : </b> <a href="{{ URL::asset($manuscrit->manuscrit) }}" download><i class="icofont-download"></i> Cliquer pour télécharger</a><br />
                <b>Couverture : </b> <a href="{{ URL::asset($manuscrit->couverture) }}" download><i class="icofont-download"></i> Cliquer pour télécharger</a>

                @php
                    $i += 1
                @endphp

                <div class="mb-3">
                    <a href="{{ route('userDestroyManuscrit', $manuscrit->id) }}" class="text-danger" onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer ce manuscrit ?')">
                        <i class="icofont-bin"></i>
                        <b>Supprimer le manuscrit</b>
                    </a>
                </div>

            @empty
                <div class="text-center">
                    <br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br /><br />

                    Pas de manuscrit ajouté !

                    <br /><br /><br /><br /><br /><br />
                </div>
            @endforelse

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelManuscritId" tabindex="-1" role="dialog" aria-labelledby="modelTitleManuscritId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Créer un manuscrit</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route('userStoreManuscrit') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="text" class="form-control" required name="titre" placeholder="Saisir le titre de l'ouvrage ...">

                            <div class="form-group mt-3">
                                <textarea class="form-control" placeholder="La résumé du manuscrit ..." required name="resume" rows="3"></textarea>
                            </div>

                            <small><b>Joindre le manuscrit (Uniquement fichier word)</b></small>
                            <input type="file" name="manuscrit" required class="border border-dark w-100"><br /><br />

                            <small><b>Joindre une image (Fichier image)</b></small>
                            <input type="file" name="couverture" required class="border border-dark w-100"><br /><br />

                            <button type="submit" class="btn btn-outline-indigo btn-md z-depth-0 rounded btn-block">
                                <b>Créer le manuscrit</b>
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>

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
