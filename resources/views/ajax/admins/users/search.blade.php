<div class="col-12">
    <div class="mb-2">
        <b>{{ count($other_users) }} résultat(s) trouvé(s)</b>
    </div>
</div>
@forelse ($other_users as $other_user)
    <div class="col-lg-3">
        <div class="white p-2 mb-3 rounded" style="border: 1px solid #CCC;">
            <table>
                <tr>
                    <td width="50">
                        @if ($other_user->avatar == "default.png")
                            <img src="{{ URL::asset('db/avatars/' . $other_user->avatar . '') }}" alt="img-avatr" width="100%" class="border rounded-circle">
                        @else
                            <img src="{{ URL::asset($other_user->avatar) }}" alt="img-avatr" width="100%" class="border rounded-circle">
                        @endif
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
                        <a href="{{ route('adminShowUser', $other_user->id) }}">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Message
                        </a>

                    </td>
                </tr>
            </table>
        </div>
    </div>
    
@empty

    <div class="col-12 text-center">
        <br /><br />

        Pas de résultats pour cette recherche !

    </div>

@endforelse