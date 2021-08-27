<table class="w-100">
    @foreach ($messages as $message)
        @if ($message->env_id == $_COOKIE['id'])    
            <tr>
                <td width="50%">
                    
                </td>
                <td>
                    <div class="cover-msg-text-own blue-grey white-text pl-3 pr-3 pt-1 pb-1 float-right">
                        {{ $message->message }}
                    </div>
                </td>
            </tr>
        @else    
            <tr>
                <td>
                    <div class="cover-msg-text-other grey lighten-2 pl-3 pr-3 pt-1 pb-1 float-left">
                        {{ $message->message }}
                    </div>
                </td>
                <td>
                    
                </td>
            </tr>
        @endif
    @endforeach
</table>