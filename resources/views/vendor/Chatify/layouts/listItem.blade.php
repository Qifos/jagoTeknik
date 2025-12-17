<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * Desc   : Package View Chatify dan beberapa custom manual
-->
@php
    // ✅ biar ga error kalau kontak belum punya riwayat chat
    $lastMessage = $lastMessage ?? null;
    $unseenCounter = $unseenCounter ?? 0;
@endphp

{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}" data-unseen="0">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users')
@php
    // fallback aman kalau belum ada chat sama sekali
    $hasLast = !empty($lastMessage);

    if ($hasLast) {
        $lastMessageBody = mb_convert_encoding($lastMessage->body ?? '', 'UTF-8', 'UTF-8');
        $lastMessageBody = strlen($lastMessageBody) > 30
            ? mb_substr($lastMessageBody, 0, 30, 'UTF-8') . '..'
            : $lastMessageBody;

        $lastTimeAttr = $lastMessage->created_at ?? null;
        $lastTimeAgo  = $lastMessage->timeAgo ?? '';
    } else {
        $lastMessageBody = 'Mulai chat dengan mentor ini';
        $lastTimeAttr = null;
        $lastTimeAgo  = '';
    }
@endphp

<table class="messenger-list-item" data-contact="{{ $user->id }}" data-unseen="{{ $unseenCounter }}">

    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
            <div class="avatar av-m" style="background-image: url('{{ $user->avatar }}');"></div>
        </td>

        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}

                {{-- time (kalau belum ada chat, kosong aja) --}}
                <span class="contact-item-time"
                      @if($hasLast && $lastTimeAttr) data-time="{{ $lastTimeAttr }}" @endif>
                    {{ $lastTimeAgo }}
                </span>
            </p>

            <span>
                {{-- Last Message user indicator --}}
                @if($hasLast && ($lastMessage->from_id ?? null) == Auth::user()->id)
                    <span class="lastMessageIndicator">You :</span>
                @endif

                {{-- Last message body / attachment --}}
                @if($hasLast && ($lastMessage->attachment ?? null) != null)
                    <span class="fas fa-file"></span> Attachment
                @else
                    {!! $lastMessageBody !!}
                @endif
            </span>

            {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}" data-unseen="0">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
            {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


