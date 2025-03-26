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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}
    <script src="https://kit.fontawesome.com/0dbc56c7a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/landscape.css') }}">
    <style>
        /* Tambahan style yang tidak ada di landscape.css */
        #liveclock {
            z-index: 3;
            position: relative;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center overflow-hidden">
    <div class="w-full h-full bg-white shadow-lg flex flex-col overflow-hidden">
        <!-- Header Section -->
        <header class="header-gradient flex items-center py-20 px-10 h-[130px] relative overflow-hidden">
            <div class="absolute inset-0 w-[110%] left-[-5%] h-full opacity-30">
                <img src="{{ asset('header.jpg') }}" alt="Background"
                    class="w-full h-auto min-h-full object-cover object-center blur-sm transform translate-y-[-350px] header-bg-img">
            </div>
            <div class="w-24 flex-shrink-0 relative z-10">
                <img src="{{ asset('unnes.png') }}" alt="Logo"
                    class="h-24 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] header-logo hover:scale-105 transition-transform duration-300">
            </div>
            <div class="flex-grow text-4xl font-bold text-center leading-tight font-poppins relative z-10 text-white">
                <h1 class="header-title">SELAMAT DATANG DI<br>UNIVERSITAS NEGERI SEMARANG</h1>
                <p class="text-lg font-bold mt-1 text-white/90 header-subtitle">Kampus UNNES Sekaran, Gunungpati,
                    Semarang, 50229, Jawa Tengah, Indonesia</p>
            </div>
            <div class="w-24 flex-shrink-0 relative z-10"></div>
        </header>

        <!-- Main Content -->
        <main class="grid grid-cols-2 flex-grow bg-gray-50">
            <!-- Floor Information -->
            <section
                class="bg-white/50 text-gray-800 flex flex-col items-center justify-start pt-4 text-lg backdrop-blur-sm">
                <div class="font-poppins w-full">
                    <div class="floor-slider">
                        <div class="floor-slides">
                            @foreach(['Lantai 1' => 'First Floor', 'Lantai 2' => 'Second Floor', 'Lantai 3' => 'Third
                            Floor', 'Lantai 4' => 'Fourth Floor'] as $lantai => $floor)
                                <div class="floor-slide {{ $loop->first ? 'active' : '' }}">
                                    <div class="floor-title-container">
                                        <div
                                            class="text-5xl font-bold text-{{ $loop->iteration == 1 ? 'red' : ($loop->iteration == 2 ? 'blue' : ($loop->iteration == 3 ? 'green' : 'purple')) }}-600">
                                            <i class="fas fa-building-user mr-2"></i>{{ $lantai }}
                                        </div>
                                        <div class="text-lg font-semibold text-gray-600 mb-6">( {{ $floor }} )</div>
                                    </div>
                                    <div class="floor-content">
                                        @include("partials.floor-content-{$loop->iteration}")
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Floor Navigation -->
                        <div class="floor-nav">


                                           @for($i = 0; $i < 4; $i++) <div class="floor-nav-btn {{ $i == 0 ? 'active' : '' }}"
                                                    data-floor="{{ $i }}">
                                            </div>
                                        @endfor
                        </div>
                            </div>
            </div>
    </section>
      
              <!-- Schedule Section -->
          <sec   tion
                class="bg-gray-100/50 text-gray-800 flex flex-col items-center justify-start pt-8 text-lg backdrop-blur-sm">
             <div    class="font-poppins">
                 <h2
                           class="text-5xl font-bold mb-6 floor-title text-gray-800 hover:text-gray-900 transition-colors duration-300">
                        <i class="fas fa-calendar-alt mr-2"></i>Jadwal & Agenda
                    </h2>
        </div>
   
                <div      class="mt-6 w-4/5">
                    @include('partials.schedule-list')
                </div>
        </section>
        </main>

        <!-- Presence Section -->
        <section class="presence-section py-2 flex-shrink-0">
            <div class="grid grid-cols-5 gap-6 px-6">
                @foreach(['Rektor', 'Wakil Rektor 1', 'Wakil Rektor 2', 'Wakil Rektor 3', 'Wakil Rektor 4'] as $jabatan)
                    <div
                        class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box {{ $jabatan == 'Wakil Rektor 2' ? 'tidak-hadir' : 'hadir' }}">
                        <i class="fas fa-user-tie presence-icon"></i>
                        <div class="presence-title">{{ $jabatan }}</div>
                        <div
                            class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir {{ $jabatan == 'Wakil Rektor 2' ? 'tidak-hadir' : 'hadir' }} font-semibold">
                            <i
                                class="fas fa-{{ $jabatan == 'Wakil Rektor 2' ? 'times' : 'check' }}-circle presence-status-icon"></i>
                            {{ $jabatan == 'Wakil Rektor 2' ? 'Tidak Hadir' : 'Hadir' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Footer Section -->
        <foo ter
            class="bg-white text-center text-lg font-semibold py-4 border-t flex-shrink-0 relative flex items-center">
            <div class="absolute left-0 bottom-1/2 transform translate-y-1/2">
                <div id="liveclock" class="text-3xl font-bold text-white bg-gray-900 px-7 py-4 rounded-tr-xl shadow-lg">
                    <i class="far fa-clock mr-2"></i><span>00:00</span>
                </div>
            </div>
            <div class="flex-1 ml-48 overflow-hidden">
                <div class="marquee-container">
                    <div class="animate-marquee whitespace-nowrap text-gray-700">
                        @include('partials.announcements')
                    </div>
                </div>
            </div>
    </footer>
    </div>
    <!-- Scripts -->
            <script src="{{ asset('js/landscape.js') }}"></script>
</body>

</html>