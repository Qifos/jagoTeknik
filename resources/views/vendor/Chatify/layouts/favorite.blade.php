<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Package View Chatify dan beberapa custom manual
-->
<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
        </div>
        <p>{{ strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name }}</p>
    @endif
</div>
