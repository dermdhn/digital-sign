<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Rektorat UNNES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    html,
    body {
        overflow: hidden;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    /* Responsif untuk gambar background */
    @media (max-width: 768px) {
        .header-bg-img {
            height: 100% !important;
            transform: translateY(0) !important;
        }
    }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center overflow-hidden">
    <div class="w-full h-full bg-white shadow-lg flex flex-col overflow-hidden">
        <!-- Judul -->
        <div class="bg-gray-800 flex items-center py-20 px-10 h-[130px] relative overflow-hidden">
            <div class="absolute inset-0 w-[110%] left-[-5%] h-full">
                <img src="{{ asset('header.jpg') }}" alt="Background"
                    class="w-full h-auto min-h-full object-cover object-center blur-sm transform translate-y-[-350px] header-bg-img">
            </div>
            <div class="w-24 flex-shrink-0 relative z-10">
                <img src="{{ asset('unnes.png') }}" alt="Logo"
                    class="h-24 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,0.8)]">
            </div>
            <div class="flex-grow text-4xl font-bold text-center leading-tight font-poppins relative z-10 text-white">
                SELAMAT DATANG DI<br>
                UNIVERSITAS NEGERI SEMARANG
                <p class="text-lg font-bold mt-1 text-white">Kampus UNNES Sekaran, Gunungpati, Semarang, 50229, Jawa
                    Tengah,
                    Indonesia</p>
            </div>
            <div class="w-24 flex-shrink-0 relative z-10"></div>
        </div>

        <!-- Informasi Lantai & Jadwal -->
        <div class="grid grid-cols-2 flex-grow">
            <div class="bg-white text-gray-800 flex flex-col items-center justify-start pt-8 text-lg">
                <div class="font-poppins">
                    <div class="text-5xl font-bold text-red-600">Lantai 1</div>
                    <div class="text-lg text-center">( First Floor )</div>
                </div>

                <div class="mt-3 w-4/5 bg-gray-300 rounded-lg p-4 shadow-lg">
                    <div class="text-gray-800 font-poppins">
                        <h3 class="font-bold text-xl mb-2">Informasi Ruangan:</h3>
                        <ul class="list-disc pl-5 space-y-1 text-left font-bold">
                            <li>DIREKTUR AKADEMIK,KEMAHASISWAAN,DAN KONSERVASI</li>
                            <li>KANTOR URUSAN INTERNASIONAL</li>
                            <li>KANTOR PELAYANAN PENGADAAN</li>
                            <li>SUBDIREKTORAT AKADEMIK DAN KEMAHASISWAAN</li>
                            <li>SUBDIREKTORAT REPUTASI DAN KERJASAMA</li>
                            <li>SEKSI ADMIN DAN LAYANAN TERPADU</li>
                            <li>RUANG RAPAT 105</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 text-gray-800 flex flex-col items-center justify-start pt-8 text-lg">
                <div class="font-poppins">
                    <div class="text-5xl font-bold mb-6">Jadwal & Agenda</div>
                </div>

                <div class="mt-3 w-4/5 bg-gray-600/70 rounded-lg p-4 shadow-lg">
                    <!-- Isi jadwal akan ditampilkan di sini -->
                    <div class="text-white font-poppins">
                        <p class="text-center text-xl">Tidak ada jadwal</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-900 py-4 flex-shrink-0">
            <div class="grid grid-cols-5 gap-5 px-5">
                <!-- Kotak Kehadiran -->
                <div class="bg-white py-16 rounded-xl flex items-center justify-center relative">
                    <span class="text-gray-800 font-bold text-4xl">Rektor</span>
                    <div
                        class="bg-blue-400/70 text-black text-center py-1 px-8 rounded-t-lg absolute bottom-0 left-1/2 transform -translate-x-1/2">
                        Hadir
                    </div>
                </div>
                <div class="bg-white py-16 rounded-xl flex items-center justify-center relative">
                    <span class="text-gray-800 font-bold text-4xl">WR 1</span>
                    <div
                        class="bg-blue-400/70 text-black text-center py-1 px-8 rounded-t-lg absolute bottom-0 left-1/2 transform -translate-x-1/2">
                        Hadir
                    </div>
                </div>
                <div class="bg-white py-16 rounded-xl flex items-center justify-center relative">
                    <span class="text-gray-800 font-bold text-4xl">WR 2</span>
                    <div
                        class="bg-red-500/70 text-black text-center py-1 px-8 rounded-t-lg absolute bottom-0 left-1/2 transform -translate-x-1/2">
                        Tidak
                    </div>
                </div>
                <div class="bg-white py-16 rounded-xl flex items-center justify-center relative">
                    <span class="text-gray-800 font-bold text-4xl">WR 3</span>
                    <div
                        class="bg-blue-400/70 text-black text-center py-1 px-8 rounded-t-lg absolute bottom-0 left-1/2 transform -translate-x-1/2">
                        Hadir
                    </div>
                </div>
                <div class="bg-white py-16 rounded-xl flex items-center justify-center relative">
                    <span class="text-gray-800 font-bold text-4xl">WR 4</span>
                    <div
                        class="bg-blue-400/70 text-black text-center py-1 px-8 rounded-t-lg absolute bottom-0 left-1/2 transform -translate-x-1/2">
                        Hadir
                    </div>
                </div>
            </div>
        </div>

        <!-- More Information -->
        <div class="bg-white text-center text-lg font-semibold py-4 border-t flex-shrink-0 relative">
            <div class="absolute left-0 bottom-1/2 transform translate-y-1/2">
                <div id="liveclock" class="text-3xl font-bold text-white bg-black px-4 py-4">00:00</div>
            </div>
            <span>More information</span>
        </div>
    </div>

    <script>
    function updateClock() {
        const now = new Date();

        // Format time: HH:MM
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const timeString = `${hours}:${minutes}`;

        // Update the element
        document.getElementById('liveclock').textContent = timeString;

        // Update every 30 seconds (since we don't show seconds anymore)
        setTimeout(updateClock, 30000);
    }

    // Start the clock when page loads
    document.addEventListener('DOMContentLoaded', updateClock);
    </script>
</body>

</html>