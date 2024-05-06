<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
        </div>
        <p> {{ strlen($user->firstname) > 12 ? trim(substr($user->firstname, 0, 12)).'..' : $user->firstname }}
            {{ $user->lastname }}</p>
    @endif
</div>
