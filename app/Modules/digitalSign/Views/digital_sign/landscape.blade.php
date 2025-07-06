<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi Rektorat Universitas Negeri Semarang (UNNES)">
    <meta name="keywords" content="UNNES, Rektorat, Universitas Negeri Semarang, Kampus Konservasi">
    <meta name="author" content="UNNES">
    <meta name="theme-color" content="#1e3a8a">
    <meta property="og:title" content="Web Rektorat UNNES">
    <meta property="og:description" content="Website Resmi Rektorat Universitas Negeri Semarang (UNNES)">
    <meta property="og:image" content="{{ asset('unnes.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <title>Web Rektorat UNNES</title>

    <!-- Preload Resources -->
    <link rel="preload" as="image" href="{{ asset('header.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('unnes.png') }}">
    <link rel="preload" href="{{ asset('css/landscape.css') }}" as="style">
    <link rel="preload" href="{{ asset('js/landscape.js') }}" as="script">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0dbc56c7a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/landscape.css') }}">
    <style>
        /* style yang tidak ada di landscape.css */
        #liveclock {
            z-index: 3;
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center overflow-hidden">
    <div class="w-full h-full bg-white shadow-lg flex flex-col overflow-hidden">
        <!-- Header Section -->
        <header class="header-gradient flex items-center py-20 px-10 h-[180px] relative overflow-hidden">
            <div class="absolute inset-0 w-[110%] left-[-5%] h-full opacity-30">
                <img src="{{ asset('header.jpg') }}" alt="Background"
                    class="w-full h-auto min-h-full object-cover object-center blur-sm transform translate-y-[-350px] header-bg-img">
            </div>
            <div class="w-32 flex-shrink-0 relative z-10">
                <img src="{{ asset('unnes.png') }}" alt="Logo"
                    class="h-32 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] header-logo hover:scale-105 transition-transform duration-300">
            </div>
            <div class="flex-grow text-8xl font-black text-center leading-none font-poppins relative z-10 text-white tracking-wider">
                <h1 class="header-title text-shadow-lg scale-y-110">SELAMAT DATANG DI<br>UNIVERSITAS NEGERI SEMARANG</h1>
                <p class="text-3xl font-bold mt-4 text-white/95 header-subtitle tracking-normal">
                    Kampus UNNES Sekaran, Gunungpati, Semarang, 50229, Jawa Tengah, Indonesia
                </p>
            </div>
            <div class="w-32 flex-shrink-0 relative z-10"></div>
        </header>

        <!-- Main Content -->
        <main class="grid grid-cols-2 flex-grow bg-gray-50">
            <!-- Floor Information -->
            <section class="lantai-section flex flex-col justify-start text-lg backdrop-blur-sm h-full min-h-[300px] p-6 pt-8 {{ count($lantaidanruangan) <= 1 ? '!justify-normal' : '' }}">
                <div class="font-poppins w-full">
                    <div class="floor-slider relative">
                        <!-- SLIDE CONTAINER -->
                        <div class="floor-slides floor-slider-container"></div>
                        <!-- NAV CONTAINER -->
                        <div class="floor-nav-container mt-6 flex justify-center items-center gap-2"></div>
                    </div>
                </div>
            </section>

            <!-- Schedule Section -->
            <section class="bg-gray-100/50 flex flex-col items-center justify-start pt-8 text-lg backdrop-blur-sm">
                <div class="font-poppins">
                    <h2 class="text-5xl font-bold mb-6 floor-title transition-colors duration-300">
                        <i class="fas fa-calendar-alt mr-2"></i>Jadwal & Agenda
                    </h2>
                </div>
                <div class="mt-6 w-4/5">
                    @include('digitalSign::digital_sign.partials.schedule-list')
                </div>
            </section>
        </main>

        <!-- Presence Section -->
        <section class="presence-section py-2 flex-shrink-0">
            @php
                $count = count($kehadiran);
                $cols = 5;
                $start = 0;
                if ($count < $cols) {
                    $start = intval(($cols - $count) / 2);
                }
            @endphp
            <div class="grid grid-cols-5 gap-6 px-6">
                @for($i = 0; $i < $cols; $i++)
                    @if($i < $start || $i >= $start + $count)
                        <div></div>
                    @else
                        @php $item = $kehadiran[$i - $start]; @endphp
                        <div class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box {{ strtolower($item->status) === 'tidak hadir' ? 'tidak-hadir' : 'hadir' }}">
                            <i class="fas fa-user-tie presence-icon"></i>
                            <div class="presence-title">{{ $item->nama_jabatan }}</div>
                            <div class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir {{ strtolower($item->status) === 'tidak hadir' ? 'tidak-hadir' : 'hadir' }} font-semibold">
                                <i class="fas fa-{{ strtolower($item->status) === 'tidak hadir' ? 'times' : 'check' }}-circle presence-status-icon"></i>
                                {{ ucfirst($item->status) }}
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-white text-center text-lg font-semibold mt py-1 border-t flex-shrink-0 relative flex items-center">
            <div class="absolute left-0 bottom-1/2 transform translate-y-1/2">
                <div id="liveclock" class="text-3xl font-bold text-white bg-gray-900 px-7 py-2 rounded-tr-xl shadow-lg">
                    <i class="far fa-clock mr-2"></i><span>00:00</span>
                </div>
            </div>
            <div class="flex-1 ml-48 overflow-hidden">
                <div class="marquee-container">
                    <div class="animate-marquee whitespace-nowrap text-gray-700">
                        @include('digitalSign::digital_sign.partials.announcements')
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/landscape.js') }}"></script>
</body>
</html>
