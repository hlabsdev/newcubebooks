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

    <div class="Dosis">
        @include('included.menu_bar_gerant')
    </div>

    <div class="content-center font-size-13 Dosis">
        @foreach (User::where('id', $id)->get() as $user)
            <div class="white p-3">
                <div>
                    <small><b>Profil de {{ $user->name }}</b></small>

                    <div class="text-center">
                        <center>
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                                @if ($user->avatar == "default.png")
                                    <img src="{{ URL::asset('db/avatars/' . $user->avatar . '') }}" alt="img-avatr" width="100%">
                                @else
                                    <img src="{{ URL::asset($user->avatar) }}" alt="img-avatr" width="100%">
                                @endif
                            </div><br />
                        </center>
                        <a href="mailto:{{ $user->email }}" class="orange-text">
                            <i class="icofont-paper-plane"></i>
                            <b>Envoyer un email</b>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('listMessages', ['rcv' => $user->id]) }}">
                            <i class="icofont-envelope"></i>
                            <b>Envoyer un message</b>
                        </a>
                    </div><br />

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-muted">Nom complet</div>
                                <b>{{ $user->name }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12"><br />
                                <div class="text-muted">Email</div>
                                <b>{{ $user->email }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12"><br />
                                <div class="text-muted">Profession</div>
                                <b>{{ $user->profession }}</b>
                            </div>
                            <div class="col-12"><br />
                                <div class="text-muted">Téléphone</div>
                                <b>{{ $user->telephone }}</b><hr />
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Boite postale</div>
                                <b>{{ $user->boite_postale }}</b>
                                @if ($user->boite_postale == "")
                                    <i>Non renseigné !</i>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <div class="text-muted">Pays de résidence</div>
                                    @foreach (Pays::orderBy('nom_fr_fr')->where('id', $user->pays_id)->get() as $pays)
                                        <b>{{ $pays->nom_fr_fr }}</b>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Ville actuelle</div>
                                <b>{{ $user->ville }}</b>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="text-muted">Quartier</div>
                                <b>{{ $user->quartier }}</b>
                            </div>
                            <div class="col-12"><hr />
                                <div class="text-muted">Bien ou service fourni</div>
                                <b>{{ $user->bien_service }}</b>
                            </div>
                            <div class="col-12">
                                <br />

                                @if ($user->banni == 0)
                                    <a href="{{ route('adminBlockUser', $user->id) }}" class="btn btn-danger btn-block btn-md z-depth-0" onclick="return confirm('Êtes-vous sûr(e) de vouloir bloquer ce utilisateur ?')">
                                        <span class="white-text">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                            Bloquer ce utilisateur
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('adminUnBlockUser', $user->id) }}" class="btn btn-green btn-block btn-md z-depth-0" onclick="return confirm('Êtes-vous sûr(e) de vouloir débloquer ce utilisateur ?')">
                                        <span class="white-text">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Débloquer ce utilisateur
                                        </span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach<br />

    </div>

@endsection

@section("js")
	<script>

	</script>
@endsection
