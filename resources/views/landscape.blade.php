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

    <!-- Preload gambar penting -->
    <link rel="preload" as="image" href="{{ asset('header.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('unnes.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}
    <script src="https://kit.fontawesome.com/0dbc56c7a8.js" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            overflow: hidden;
            height: 100vh;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .info-card {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .schedule-card {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .presence-section {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .status-hadir {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            text-align: center;
            padding: 8px 0;
            font-size: 1.1rem;
        }

        .kotak-hadir {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            min-height: 200px;
        }

        .kotak-hadir.hadir {
            background: linear-gradient(135deg, rgba(167, 243, 208, 0.9) 0%, rgba(110, 231, 183, 0.9) 100%);
            border: 3px solid #10B981;
        }

        .kotak-hadir.tidak-hadir {
            background: linear-gradient(135deg, rgba(254, 202, 202, 0.9) 0%, rgba(252, 165, 165, 0.9) 100%);
            border: 3px solid #EF4444;
            opacity: 0.8;
        }

        .kotak-hadir:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.2);
        }

        .status-hadir.hadir {
            background: #10B981;
            color: white;
            border-top: 2px solid #059669;
        }

        .status-hadir.tidak-hadir {
            background: #EF4444;
            color: white;
            border-top: 2px solid #DC2626;
        }

        .presence-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #1F2937;
        }

        .presence-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1F2937;
        }

        .presence-status-icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        /* Responsif untuk gambar background dan konten */
        @media (max-width: 1280px) {
            .header-title {
                font-size: 1.75rem;
                line-height: 2rem;
            }

            .header-subtitle {
                font-size: 0.875rem;
            }

            .floor-title {
                font-size: 2.5rem;
            }

            .presence-box {
                font-size: 1.5rem;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .header-bg-img {
                height: 100% !important;
                transform: translateY(0) !important;
            }

            .header-logo {
                height: 3rem;
                width: auto;
            }

            .header-title {
                font-size: 1.25rem;
                line-height: 1.5rem;
            }

            .header-subtitle {
                font-size: 0.75rem;
            }

            .floor-title {
                font-size: 2rem;
            }

            .info-list {
                font-size: 0.875rem;
            }

            .presence-box {
                font-size: 1.25rem;
                padding: 0.5rem;
            }
        }

        /* Tambahkan style untuk animasi marquee */
        @keyframes marquee {
            0% {
                transform: translateX(100%);
                opacity: 1;
            }

            95% {
                transform: translateX(-150%);
                opacity: 1;
            }

            100% {
                transform: translateX(-155%);
                opacity: 0;
            }
        }

        .marquee-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .marquee-container::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 200px;
            background: linear-gradient(to left, transparent, white);
            z-index: 2;
        }

        .animate-marquee {
            display: inline-block;
            animation: marquee 40s linear infinite;
            margin-left: 200px;
        }

        #liveclock {
            z-index: 3;
            position: relative;
        }

        /* Tambahkan style untuk slide lantai */
        .floor-slider {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .floor-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
            margin-top: 1.5rem;
        }

        .floor-slide {
            min-width: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .floor-title-container {
            text-align: center;
            width: 100%;
        }

        .floor-content {
            width: 80%;
            margin-top: -0.5rem;
        }

        .floor-slide.active {
            opacity: 1;
        }

        .floor-nav {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .floor-nav-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(156, 163, 175, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floor-nav-btn.active {
            background: #dc2626;
            transform: scale(1.2);
        }

        .floor-arrows {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            transform: translateY(-50%);
            z-index: 10;
        }

        .floor-arrow {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floor-arrow:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center overflow-hidden">
    <div class="w-full h-full bg-white shadow-lg flex flex-col overflow-hidden">
        <!-- Judul -->
        <div class="header-gradient flex items-center py-20 px-10 h-[130px] relative overflow-hidden">
            <div class="absolute inset-0 w-[110%] left-[-5%] h-full opacity-30">
                <img src="{{ asset('header.jpg') }}" alt="Background"
                    class="w-full h-auto min-h-full object-cover object-center blur-sm transform translate-y-[-350px] header-bg-img">
            </div>
            <div class="w-24 flex-shrink-0 relative z-10">
                <img src="{{ asset('unnes.png') }}" alt="Logo"
                    class="h-24 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] header-logo hover:scale-105 transition-transform duration-300">
            </div>
            <div class="flex-grow text-4xl font-bold text-center leading-tight font-poppins relative z-10 text-white">
                <div class="header-title">SELAMAT DATANG DI<br>
                    UNIVERSITAS NEGERI SEMARANG</div>
                <p class="text-lg font-bold mt-1 text-white/90 header-subtitle">Kampus UNNES Sekaran, Gunungpati,
                    Semarang,
                    50229, Jawa Tengah, Indonesia</p>
            </div>
            <div class="w-24 flex-shrink-0 relative z-10"></div>
        </div>

        <!-- Informasi Lantai & Jadwal -->
        <div class="grid grid-cols-2 flex-grow bg-gray-50">
            <div
                class="bg-white/50 text-gray-800 flex flex-col items-center justify-start pt-4 text-lg backdrop-blur-sm">
                <div class="font-poppins w-full">
                    <div
                        class="text-5xl font-bold text-gray-800 text-center hover:text-gray-900 transition-colors duration-300">
                    </div>
                    <div class="floor-slider">
                        <div class="floor-slides">
                            <!-- Lantai 1 -->
                            <div class="floor-slide active">
                                <div class="floor-title-container">
                                    <div class="text-5xl font-bold text-red-600">
                                        <i class="fas fa-building-user mr-2"></i>Lantai 1
                                    </div>
                                    <div class="text-lg font-semibold text-gray-600 mb-6">( First Floor )</div>
                                </div>
                                <div class="floor-content">
                                    <div class="info-card rounded-xl p-6 shadow-lg">
                                        <div class="text-gray-800 font-poppins">
                                            <h3 class="font-bold text-5xl mb-4 text-gray-900 text-center">
                                                <i class="fas fa-door-open mr-2"></i>Informasi Ruangan
                                            </h3>
                                            <div class="w-full h-1 bg-gray-800 mb-4 rounded-full"></div>
                                            <ul
                                                class="list-decimal pl-5 space-y-2 text-left font-bold info-list text-lg text-gray-900">
                                                <li>DIREKTUR AKADEMIK, KEMAHASISWAAN, DAN KONSERVASI</li>
                                                <li>KANTOR URUSAN INTERNASIONAL</li>
                                                <li>KANTOR PELAYANAN PENGADAAN</li>
                                                <li>SUBDIREKTORAT AKADEMIK DAN KEMAHASISWAAN</li>
                                                <li>SUBDIREKTORAT REPUTASI DAN KERJASAMA</li>
                                                <li>SEKSI ADMISI DAN LAYANAN TERPADU</li>
                                                <li>RUANG RAPAT 105</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lantai 2 -->
                            <div class="floor-slide">
                                <div class="floor-title-container">
                                    <div class="text-5xl font-bold text-blue-600">
                                        <i class="fas fa-building-user mr-2"></i>Lantai 2
                                    </div>
                                    <div class="text-lg font-semibold text-gray-600 mb-6">( Second Floor )</div>
                                </div>
                                <div class="floor-content">
                                    <div class="info-card rounded-xl p-6 shadow-lg"
                                        style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                                        <div class="text-gray-800 font-poppins">
                                            <h3 class="font-bold text-5xl mb-4 text-gray-900 text-center">
                                                <i class="fas fa-door-open mr-2"></i>Informasi Ruangan
                                            </h3>
                                            <div class="w-full h-1 bg-gray-800 mb-4 rounded-full"></div>
                                            <ul
                                                class="list-decimal pl-5 space-y-2 text-left font-bold info-list text-lg text-gray-900">
                                                <li>RUANG REKTOR</li>
                                                <li>RUANG WAKIL REKTOR 1</li>
                                                <li>RUANG WAKIL REKTOR 2</li>
                                                <li>RUANG WAKIL REKTOR 3</li>
                                                <li>RUANG WAKIL REKTOR 4</li>
                                                <li>SEKRETARIS UNIVERSITAS</li>
                                                <li>SUBDIREKTORAT PERENCANAAN DAN AKUTANSI</li>
                                                <li>SEKSI TATA USAHA DAN PROTOKOLER</li>
                                                <li>RUANG COMMAND CENTER</li>
                                                <li>RUANG RAPAT 217</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lantai 3 -->
                            <div class="floor-slide">
                                <div class="floor-title-container">
                                    <div class="text-5xl font-bold text-green-600">
                                        <i class="fas fa-building-user mr-2"></i>Lantai 3
                                    </div>
                                    <div class="text-lg font-semibold text-gray-600 mb-6">( Third Floor )</div>
                                </div>
                                <div class="floor-content">
                                    <div class="info-card rounded-xl p-6 shadow-lg"
                                        style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                                        <div class="text-gray-800 font-poppins">
                                            <h3 class="font-bold text-5xl mb-4 text-gray-900 text-center">
                                                <i class="fas fa-door-open mr-2"></i>Informasi Ruangan
                                            </h3>
                                            <div class="w-full h-1 bg-gray-800 mb-4 rounded-full"></div>
                                            <ul
                                                class="list-decimal pl-5 space-y-2 text-left font-bold info-list text-lg text-gray-900">
                                                <li>DIREKTUR UMUM DAN SDM</li>
                                                <li>DIREKTUR PERENCANAAN DAN KEUANGAN</li>
                                                <li>SATUAN PENGAWAS INTERNAL</li>
                                                <li>SUBDIREKTORAT UMUM</li>
                                                <li>SUBDIREKTORAT KEUANGAN DAN PERPAJAKAN</li>
                                                <li>SUBDIREKTORAT SDM</li>
                                                <li>RUANG DHARMAWANITA</li>
                                                <li>RUANG RAPAT 303</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lantai 4 -->
                            <div class="floor-slide">
                                <div class="floor-title-container">
                                    <div class="text-5xl font-bold text-purple-600">
                                        <i class="fas fa-building-user mr-2"></i>Lantai 4
                                    </div>
                                    <div class="text-lg font-semibold text-gray-600 mb-6">( Fourth Floor )</div>
                                </div>
                                <div class="floor-content">
                                    <div class="info-card rounded-xl p-6 shadow-lg"
                                        style="background: linear-gradient(135deg, #9333ea 0%, #7e22ce 100%);">
                                        <div class="text-gray-800 font-poppins">
                                            <h3 class="font-bold text-5xl mb-4 text-gray-900 text-center">
                                                <i class="fas fa-door-open mr-2"></i>Informasi Ruangan
                                            </h3>
                                            <div class="w-full h-1 bg-gray-800 mb-4 rounded-full"></div>
                                            <ul
                                                class="list-decimal pl-5 space-y-2 text-left font-bold info-list text-lg text-gray-900">
                                                <li>KETUA SENAT</li>
                                                <li>KANTOR HUKUM</li>
                                                <li>RUANG RAPAT SENAT</li>
                                                <li>RUANG RAPAT 404</li>
                                                <li>RUANG RAPAT 405</li>
                                                <li>RUANG RAPAT 407</li>
                                                <li>RUANG RAPAT VICON</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigasi Slide -->
                        <div class="floor-nav">
                            <div class="floor-nav-btn active" data-floor="0"></div>
                            <div class="floor-nav-btn" data-floor="1"></div>
                            <div class="floor-nav-btn" data-floor="2"></div>
                            <div class="floor-nav-btn" data-floor="3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="bg-gray-100/50 text-gray-800 flex flex-col items-center justify-start pt-8 text-lg backdrop-blur-sm">
                <div class="font-poppins">
                    <div
                        class="text-5xl font-bold mb-6 floor-title text-gray-800 hover:text-gray-900 transition-colors duration-300">
                        <i class="fas fa-calendar-alt mr-2"></i>Jadwal & Agenda
                    </div>
                </div>

                <div class="mt-6 w-4/5">
                    <div class="schedule-card rounded-xl p-6 shadow-lg">
                        <div class="text-white font-poppins space-y-4">
                            <div class="border-b border-gray-500/30 pb-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-lg"><i class="fas fa-users mr-2"></i>Rapat Koordinasi
                                        </h3>
                                        <p class="text-sm text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i>Ruang
                                            Rapat 105</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-400"><i class="far fa-clock mr-1"></i>09:00
                                            WIB</p>
                                        <p class="text-sm text-gray-300"><i class="far fa-calendar-check mr-1"></i>Hari
                                            ini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-b border-gray-500/30 pb-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-lg"><i class="fas fa-user-friends mr-2"></i>Pertemuan
                                            Dekanat</h3>
                                        <p class="text-sm text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i>Ruang
                                            Direktur</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-400"><i class="far fa-clock mr-1"></i>13:30
                                            WIB</p>
                                        <p class="text-sm text-gray-300"><i class="far fa-calendar-check mr-1"></i>Hari
                                            ini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-b border-gray-500/30 pb-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-lg"><i class="fas fa-chart-line mr-2"></i>Evaluasi
                                            Kinerja</h3>
                                        <p class="text-sm text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i>Ruang
                                            Rapat 105</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-400"><i class="far fa-clock mr-1"></i>15:00
                                            WIB</p>
                                        <p class="text-sm text-gray-300"><i class="far fa-calendar-check mr-1"></i>Hari
                                            ini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-b border-gray-500/30 pb-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-lg"><i
                                                class="fas fa-handshake mr-2"></i>Penandatanganan MoU</h3>
                                        <p class="text-sm text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i>Ruang
                                            Rapat 407</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-400"><i class="far fa-clock mr-1"></i>16:30
                                            WIB</p>
                                        <p class="text-sm text-gray-300"><i class="far fa-calendar-check mr-1"></i>Hari
                                            ini</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pb-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-lg"><i class="fas fa-trophy mr-2"></i>Rapat
                                            Penganugerahan Prestasi</h3>
                                        <p class="text-sm text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i>Ruang
                                            Command Center</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-400"><i class="far fa-clock mr-1"></i>18:00
                                            WIB</p>
                                        <p class="text-sm text-gray-300"><i class="far fa-calendar-check mr-1"></i>Hari
                                            ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="presence-section py-2 flex-shrink-0">
            <div class="grid grid-cols-5 gap-6 px-6">
                <div
                    class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box hadir">
                    <i class="fas fa-user-tie presence-icon"></i>
                    <div class="presence-title">Rektor</div>
                    <div
                        class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir hadir font-semibold">
                        <i class="fas fa-check-circle presence-status-icon"></i>Hadir
                    </div>
                </div>
                <div
                    class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box hadir">
                    <i class="fas fa-user-tie presence-icon"></i>
                    <div class="presence-title">Wakil Rektor 1</div>
                    <div
                        class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir hadir font-semibold">
                        <i class="fas fa-check-circle presence-status-icon"></i>Hadir
                    </div>
                </div>
                <div
                    class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box tidak-hadir">
                    <i class="fas fa-user-tie presence-icon"></i>
                    <div class="presence-title">Wakil Rektor 2</div>
                    <div
                        class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir tidak-hadir font-semibold">
                        <i class="fas fa-times-circle presence-status-icon"></i>Tidak Hadir
                    </div>
                </div>
                <div
                    class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box hadir">
                    <i class="fas fa-user-tie presence-icon"></i>
                    <div class="presence-title">Wakil Rektor 3</div>
                    <div
                        class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir hadir font-semibold">
                        <i class="fas fa-check-circle presence-status-icon"></i>Hadir
                    </div>
                </div>
                <div
                    class="glass-effect rounded-xl flex flex-col items-center justify-center relative overflow-hidden kotak-hadir presence-box hadir">
                    <i class="fas fa-user-tie presence-icon"></i>
                    <div class="presence-title">Wakil Rektor 4</div>
                    <div
                        class="text-center py-2 px-8 rounded-t-lg absolute bottom-0 left-1/2 status-hadir hadir font-semibold">
                        <i class="fas fa-check-circle presence-status-icon"></i>Hadir
                    </div>
                </div>
            </div>
        </div>

        <!-- More Information -->
        <div class="bg-white text-center text-lg font-semibold py-4 border-t flex-shrink-0 relative flex items-center">
            <div class="absolute left-0 bottom-1/2 transform translate-y-1/2">
                <div id="liveclock" class="text-3xl font-bold text-white bg-gray-900 px-7 py-4 rounded-r-xl shadow-lg">
                    <i class="far fa-clock mr-2"></i><span>00:00</span>
                </div>
            </div>
            <div class="flex-1 ml-48 overflow-hidden">
                <div class="marquee-container">
                    <div class="animate-marquee whitespace-nowrap text-gray-700">
                        <i class="fas fa-bullhorn text-red-600 mr-3"></i>
                        Pengumuman Rektorat: Rapat Koordinasi Pimpinan Universitas Pukul 09.00 WIB
                        <span class="mx-8">|</span>
                        <i class="fas fa-calendar-check text-blue-600 mr-3"></i>
                        Agenda: Pertemuan Dekanat Seluruh Fakultas Pukul 13.30 WIB
                        <span class="mx-8">|</span>
                        <i class="fas fa-newspaper text-green-600 mr-3"></i>
                        Berita Terkini: Penandatanganan MoU UNNES dengan Mitra Internasional
                        <span class="mx-8">|</span>
                        <i class="fas fa-info-circle text-yellow-600 mr-3"></i>
                        Layanan Terpadu Rektorat Buka Pukul 08.00-16.00 WIB
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();

            // Format time: HH:MM
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `<i class="far fa-clock mr-2"></i>${hours}:${minutes}`;

            // Update the element
            document.getElementById('liveclock').innerHTML = timeString;

            // Update every second untuk animasi yang lebih smooth
            setTimeout(updateClock, 1000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Tambahkan loading state
            const loadingState = document.createElement('div');
            loadingState.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingState.innerHTML = `
                <div class="bg-white p-5 rounded-lg shadow-xl">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-3 text-gray-700">Memuat Data...</p>
                </div>
            `;
            document.body.appendChild(loadingState);

            try {
                updateClock();

                // Menambahkan script untuk slide
                const slides = document.querySelectorAll('.floor-slide');
                const navBtns = document.querySelectorAll('.floor-nav-btn');
                let currentSlide = 0;

                function showSlide(index) {
                    try {
                        slides.forEach(slide => {
                            slide.classList.remove('active');
                            slide.style.transform = `translateX(-${index * 100}%)`;
                        });
                        slides[index].classList.add('active');

                        navBtns.forEach(btn => btn.classList.remove('active'));
                        navBtns[index].classList.add('active');
                    } catch (error) {
                        console.error('Error showing slide:', error);
                    }
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }

                function prevSlide() {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    showSlide(currentSlide);
                }

                // Event Listeners
                navBtns.forEach((btn, index) => {
                    btn.addEventListener('click', () => {
                        currentSlide = index;
                        showSlide(currentSlide);
                    });
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        prevSlide();
                    } else if (e.key === 'ArrowRight') {
                        nextSlide();
                    }
                });

                // Touch events untuk mobile
                let touchStartX = 0;
                let touchEndX = 0;

                document.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                document.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                });

                function handleSwipe() {
                    const swipeThreshold = 50;
                    const swipeLength = touchEndX - touchStartX;

                    if (Math.abs(swipeLength) > swipeThreshold) {
                        if (swipeLength > 0) {
                            prevSlide();
                        } else {
                            nextSlide();
                        }
                    }
                }

                // Auto slide setiap 10 detik
                setInterval(nextSlide, 10000);

                // Hapus loading state setelah semua selesai
                setTimeout(() => {
                    loadingState.remove();
                }, 1000);

            } catch (error) {
                console.error('Error initializing app:', error);
                loadingState.innerHTML = `
                    <div class="bg-white p-5 rounded-lg shadow-xl">
                        <div class="text-red-600 text-center mb-3">
                            <i class="fas fa-exclamation-circle text-4xl"></i>
                        </div>
                        <p class="text-gray-700">Terjadi kesalahan saat memuat aplikasi</p>
                        <button onclick="location.reload()" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Muat Ulang
                        </button>
                    </div>
                `;
            }
        });
    </script>
</body>

</html>