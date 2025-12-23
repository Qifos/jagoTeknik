@include('Chatify::layouts.headLinks')
<<<<<<< HEAD
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                {{-- header buttons --}}
=======
{{-- Bootstrap & Icons (biar sama kayak homepage) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

{{-- CSS yang dipakai NAVBAR homepage --}}
<link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/personalisasi.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

{{-- CSS custom chatify kamu --}}
<link rel="stylesheet" href="{{ asset('css/chatify/jagoteknik-chatify.css') }}">

{{-- Bootstrap JS (buat toggler navbar) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- CDN Bootstrap + Icons (biar navbar kamu jalan di halaman chatify) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

@php
    // Total unread (jumlah pesan masuk yang belum dibaca)
    $jtUnreadTotal = \App\Models\ChMessage::where('to_id', \Illuminate\Support\Facades\Auth::id())
        ->where('seen', 0)
        ->count();
@endphp

{{-- Navbar JagoTeknik --}}
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand ms-2 ms-lg-3" href="{{ route('homepage') }}">
            <img src="{{ asset('image/jagoteknik.png') }}" alt="Jago Teknik" class="brand-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kelas.semua') }}">Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jadwal.index') }}">Jadwal</a>
                </li>

                {{-- Chat -> halaman ini (Chatify) --}}
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('chat.index') }}">Chat</a>
                </li>

                <li class="nav-item">
                    <form class="d-flex mx-3" onsubmit="return false;">
                        <div class="search-box">
                            <input class="form-control" type="search" placeholder="Cari di JagoTeknik">
                            <i class="bi bi-search"></i>
                        </div>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('personalisasi.view') }}">
                        <img src="{{ asset('image/profile.jpg') }}" alt="Profile" class="profile-img">
                        <span class="ms-2">Profil</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="messenger">

    {{-- Left rail/sidebar (sebelah kiri list chat) --}}
    <aside class="jt-rail" aria-label="Sidebar">
        <a class="jt-rail-back" href="{{ url()->previous() ?: route('homepage') }}" title="Kembali">
            <i class="bi bi-chevron-left"></i>
        </a>

        <div class="jt-rail-group">
            <a class="jt-rail-item" href="{{ route('homepage') }}" title="Beranda">
                <i class="bi bi-house-door"></i>
            </a>
            <a class="jt-rail-item is-active" href="{{ route('chat.index') }}" title="Chat">
                <i class="bi bi-chat-dots"></i>
            </a>
            <a class="jt-rail-item" href="{{ route('jadwal.index') }}" title="Jadwal">
                <i class="bi bi-calendar-event"></i>
            </a>
            <a class="jt-rail-item" href="{{ route('mentor.index') }}" title="Mentor">
            <img src="{{ asset('/image/people.png') }}" alt="Mentor" class="jt-rail-icon-img">
            </a>
        </div>
    </aside>

    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">

        {{-- Header and search bar --}}
        <div class="m-header">
            <div class="jt-list-head">
                <div class="jt-head-left">
                    <div class="jt-chat-title">Chat</div>
                    <div class="jt-badge" id="jt-unread-total">{{ $jtUnreadTotal }}</div>
                </div>

                <button type="button" class="jt-filter-btn">
                    <i class="fas fa-sliders-h"></i> Filter
                </button>

>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
<<<<<<< HEAD
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}}
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favorites</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>Your Space</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contact --}}
               <p class="messenger-title"><span>All Messages</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
=======
            </div>

            <div class="jt-search-left">
                <div class="jt-search-pill">
                    <i class="fas fa-search"></i>
                    <input type="text" class="messenger-search" placeholder="Cari chat" />
                </div>
            </div>
        </div>

        {{-- tabs and lists --}}
        <div class="m-body contacts-container">

            {{-- ---------------- [ User Tab ] ---------------- --}}
            <div class="show messenger-tab users-tab app-scroll" data-view="users">
                <div class="favorites-section">
                    <p class="messenger-title"><span>Favorites</span></p>
                    <div class="messenger-favorites app-scroll-hidden"></div>
                </div>

                <p class="messenger-title"><span>Your Space</span></p>
                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

                <p class="messenger-title"><span>All Messages</span></p>
                <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
            </div>

            {{-- ---------------- [ Search Tab ] ---------------- --}}
            <div class="messenger-tab search-tab app-scroll" data-view="search">
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
<<<<<<< HEAD
             </div>
=======
            </div>
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
<<<<<<< HEAD
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
=======

        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">

                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;"></div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>

>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
<<<<<<< HEAD
            {{-- Internet connection --}}
=======

>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

<<<<<<< HEAD
        {{-- Messaging area --}}
=======
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
<<<<<<< HEAD
            {{-- Typing indicator --}}
=======

>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
<<<<<<< HEAD
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
=======

        @include('Chatify::layouts.sendForm')
    </div>

    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
        <nav>
            <p>User Details</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
<<<<<<< HEAD
=======

{{-- Update badge total unread (otomatis ikut berubah saat contact list berubah/seen/ada pesan baru) --}}
<script>
    (function () {
        function jtComputeUnreadTotal() {
            const badge = document.getElementById('jt-unread-total');
            if (!badge) return;
            let total = 0;
            document.querySelectorAll('.listOfContacts .messenger-list-item').forEach((item) => {
                const n = parseInt(item.getAttribute('data-unseen') || '0', 10);
                if (!Number.isNaN(n)) total += n;
            });
            badge.textContent = String(total);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // initial
            setTimeout(jtComputeUnreadTotal, 600);

            // auto-update saat list contact berubah
            const target = document.querySelector('.listOfContacts');
            if (!target || !window.MutationObserver) return;
            const obs = new MutationObserver(function () {
                jtComputeUnreadTotal();
            });
            obs.observe(target, { childList: true, subtree: true, attributes: true, attributeFilter: ['data-unseen'] });
        });
    })();
</script>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 008e2df50e114cd6f15e972ab9f157700f9bd9b0
