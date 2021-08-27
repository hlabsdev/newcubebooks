@forelse ($users as $other_user)
    <div class="col-3">
        <a href="{{ route('otherProfile', $other_user->id) }}">
            <div style="width: 35px; height: 35px; overflow: hidden; border: 2px solid #BBB;" class="rounded-circle white">
                @if ($other_user->avatar == "default.png")
                    <img src="{{ URL::asset('db/avatars/' . $other_user->avatar . '') }}" alt="img-avatr" width="100%">
                @else
                    <img src="{{ URL::asset($other_user->avatar) }}" alt="img-avatr" width="100%">
                @endif
            </div>

            <h6 class="text-truncate font-size-14 mb-3"><small>{{ $other_user->name }}</small></h6>
        </a>
    </div>
@empty
    <div class="col-12 text-center">
        <br />
        Pas de résultat(s) trouvé(s) !
    </div>
@endforelse