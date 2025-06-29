<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Digital Signage UNNES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portrait.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body>

        <div id="version" style="display: none;">{{ $version }}</div>
        <!-- OPENING -->
        <div class="section active" id="opening">
            <div class="main-content">
            <img src="/UNNES2.png" alt="Logo UNNES" class="logo-unnes">
            <div class="unnes-text">UNNES</div>
            <div class="welcome-text">SELAMAT DATANG<br>DI GEDUNG REKTORAT<br>UNNES</div>
            <div class="footer-text">UNIVERSITAS NEGERI SEMARANG</div>
            </div>
        </div>

        <!-- SLIDES -->
        <div class="section" id="slides">
            @foreach ($slides as $index => $slide)
            <div class="slide {{ $index === 0 ? 'active' : '' }}">
            <div class="container{{ ($index % 3 === 1) ? '2' : (($index % 3 === 2) ? '3' : '') }}">
                <div class="content">
                <div class="header-section">
                    <img src="{{ asset('logobaru.png') }}" alt="Logo UNNES" class="logo">
                    <h1 class="title">{{ $slide->heading }}</h1>
                    <h2 class="subtitle">{{ $slide->subheading }}</h2>
                </div>
                <div class="profile-section">
                    <img src="{{ asset('storage/' . $slide->gambar_tokoh) }}" alt="{{ $slide->nama_tokoh }}" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">{{ strtoupper($slide->nama_tokoh) }}</h2>
                    <p class="position">{{ $slide->jabatan_tokoh }}</p>
                </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>

        <script src="{{ asset('js/portrait.js') }}"></script>
    </body>
</html>
