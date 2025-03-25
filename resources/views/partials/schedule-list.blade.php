<div class="schedule-card rounded-xl p-6 shadow-lg">
    <div class="text-white font-poppins space-y-4">
        @foreach([['title' => 'Rapat Koordinasi', 'icon' => 'users', 'location' => 'Ruang Rapat 105', 'time' => '09:00'], ['title' => 'Pertemuan Dekanat', 'icon' => 'user-friends', 'location' => 'Ruang Direktur', 'time' => '13:30'], ['title' => 'Evaluasi Kinerja', 'icon' => 'chart-line', 'location' => 'Ruang Rapat 105', 'time' => '15:00'], ['title' => 'Penandatanganan MoU', 'icon' => 'handshake', 'location' => 'Ruang Rapat 407', 'time' => '16:30'], ['title' => 'Rapat Penganugerahan Prestasi', 'icon' => 'trophy', 'location' => 'Ruang Command Center', 'time' => '18:00']] as $schedule)
            <div class="border-b border-gray-500/30 pb-3 last:pb-1 last:border-b-0">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg">
                            <i class="fas fa-{{ $schedule['icon'] }} mr-2"></i>{{ $schedule['title'] }}
                        </h3>
                        <p class="text-sm text-gray-300">
                            <i class="fas fa-map-marker-alt mr-2"></i>{{ $schedule['location'] }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-yellow-400">
                            <i class="far fa-clock mr-1"></i>{{ $schedule['time'] }} WIB
                        </p>
                        <p class="text-sm text-gray-300">
                            <i class="far fa-calendar-check mr-1"></i>Hari ini
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>