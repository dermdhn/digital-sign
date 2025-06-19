@php
    $schedules = [
        ['title' => 'Rapat Koordinasi', 'icon' => 'users', 'location' => 'Ruang Rapat 105', 'time' => '09:00', 'day' => '15 Maret 2024'],
        ['title' => 'Pertemuan Dekanat', 'icon' => 'user-friends', 'location' => 'Ruang Direktur', 'time' => '13:30', 'day' => '16 Maret 2024'],
        ['title' => 'Evaluasi Kinerja', 'icon' => 'chart-line', 'location' => 'Ruang Rapat 105', 'time' => '15:00', 'day' => '15 Maret 2024'],
        ['title' => 'Penandatanganan MoU', 'icon' => 'handshake', 'location' => 'Ruang Rapat 407', 'time' => '16:30', 'day' => '17 Maret 2024'],
        ['title' => 'Rapat Penganugerahan Prestasi', 'icon' => 'trophy', 'location' => 'Ruang Command Center', 'time' => '18:00', 'day' => '16 Maret 2024'],
        ['title' => 'Workshop Digitalisasi', 'icon' => 'laptop', 'location' => 'Lab Komputer 201', 'time' => '10:00', 'day' => '18 Maret 2024'],
        ['title' => 'Presentasi Penelitian', 'icon' => 'microscope', 'location' => 'Ruang Seminar 301', 'time' => '11:30', 'day' => '15 Maret 2024'],
        ['title' => 'Rapat Anggaran', 'icon' => 'money-bill', 'location' => 'Ruang Keuangan', 'time' => '13:00', 'day' => '16 Maret 2024'],
        ['title' => 'Seminar Teknologi', 'icon' => 'microchip', 'location' => 'Aula Utama', 'time' => '14:00', 'day' => '17 Maret 2024'],
        ['title' => 'Pelatihan Staff', 'icon' => 'chalkboard-teacher', 'location' => 'Ruang Training', 'time' => '15:30', 'day' => '15 Maret 2024'],
        ['title' => 'Review Proyek', 'icon' => 'project-diagram', 'location' => 'Ruang Meeting 202', 'time' => '16:00', 'day' => '18 Maret 2024'],
        ['title' => 'Diskusi Tim IT', 'icon' => 'code', 'location' => 'Ruang Server', 'time' => '17:00', 'day' => '16 Maret 2024'],
        ['title' => 'Evaluasi Semester', 'icon' => 'tasks', 'location' => 'Ruang Akademik', 'time' => '08:30', 'day' => '15 Maret 2024'],
        ['title' => 'Koordinasi Fakultas', 'icon' => 'university', 'location' => 'Ruang Dekan', 'time' => '11:00', 'day' => '17 Maret 2024'],
        ['title' => 'Rapat Pengembangan', 'icon' => 'cogs', 'location' => 'Ruang Inovasi', 'time' => '14:30', 'day' => '16 Maret 2024']
    ];
    $chunks = array_chunk($schedules, 3);
@endphp

<div class="schedule-card rounded-xl p-6 shadow-lg">
    <div class="schedule-slider overflow-hidden">
        @foreach($chunks as $index => $scheduleGroup)
            <div class="schedule-slide" data-index="{{ $index }}">
                <div class="text-white font-poppins space-y-4">
                    @foreach($scheduleGroup as $schedule)
                        <div class="schedule-item rounded-lg p-4 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex-grow">
                                    <h3 class="group flex items-center mb-2">
                                        <i
                                            class="fas fa-{{ $schedule['icon'] }} mr-3 text-yellow-400 transition-transform duration-300 group-hover:scale-110 text-xl"></i>
                                        <span
                                            class="hover:text-yellow-400 transition-colors duration-300">{{ $schedule['title'] }}</span>
                                    </h3>
                                    <p class="location-text flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-red-400"></i>
                                        <span>{{ $schedule['location'] }}</span>
                                    </p>
                                </div>
                                <div class="text-right ml-6">
                                    <p class="time-text flex items-center justify-end mb-1">
                                        <i class="far fa-clock mr-2 animate-pulse"></i>
                                        <span>{{ $schedule['time'] }} WIB</span>
                                    </p>
                                    <p class="date-text flex items-center justify-end">
                                        <i class="far fa-calendar-check mr-2 text-green-400"></i>
                                        <span>{{ $schedule['day'] }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center mt-8 space-x-3">
        @foreach($chunks as $index => $scheduleGroup)
            <button class="schedule-dot w-2 h-2 rounded-full bg-gray-400/50 transition-all duration-300 hover:bg-gray-300"
                data-index="{{ $index }}"></button>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.schedule-slide');
        const dots = document.querySelectorAll('.schedule-dot');
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function startSlideShow() {
            if (slideInterval) clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        }

        showSlide(0);
        startSlideShow();

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                startSlideShow();
            });
        });
    });
</script>