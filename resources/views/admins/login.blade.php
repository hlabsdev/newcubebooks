@extends('layouts.header')

@section('content')
    
    @include('included.menu_bar')
    <br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-3 col-sm-1">
        
                <h2 class="mt-2 mb-4">Connexion administrateur</h2>

                <form action="{{ route('gerantLoginForm') }}" method="post">
                    @csrf

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show font-size-13 mb-0" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          {{ $message }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email" class="Dosis mt-3 mb-0">Email</label>
                        <input type="email" required class="form-control form-control-lg" id="email" name="email" placeholder="Saisir dans le champs ..." />

                        <label for="password" class="Dosis mt-3 mb-0">Mot de passe</label>
                        <input type="password" required class="form-control form-control-lg" id="password" name="password" placeholder="Saisir dans le champs ..." />

                        <div class="text-left mt-4">
                            <button type="submit" class="btn btn-lg orange darken-3 white-text rounded btn-block z-depth-0" style="padding: 10px 0;">
                                Se connecter
                            </button>
                        </div>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>

@endsection