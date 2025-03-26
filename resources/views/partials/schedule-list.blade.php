@php
$schedules = [
['title' => 'Rapat Koordinasi', 'icon' => 'users', 'location' => 'Ruang Rapat 105', 'time' => '09:00'],
['title' => 'Pertemuan Dekanat', 'icon' => 'user-friends', 'location' => 'Ruang Direktur', 'time' => '13:30'],
['title' => 'Evaluasi Kinerja', 'icon' => 'chart-line', 'location' => 'Ruang Rapat 105', 'time' => '15:00'],
['title' => 'Penandatanganan MoU', 'icon' => 'handshake', 'location' => 'Ruang Rapat 407', 'time' => '16:30'],
[
'title' => 'Rapat Penganugerahan Prestasi',
'icon' => 'trophy',
'location' => 'Ruang Command Center',
'time' =>
'18:00'
],
['title' => 'Workshop Digitalisasi', 'icon' => 'laptop', 'location' => 'Lab Komputer 201', 'time' => '10:00'],
['title' => 'Presentasi Penelitian', 'icon' => 'microscope', 'location' => 'Ruang Seminar 301', 'time' => '11:30'],
['title' => 'Rapat Anggaran', 'icon' => 'money-bill', 'location' => 'Ruang Keuangan', 'time' => '13:00'],
['title' => 'Seminar Teknologi', 'icon' => 'microchip', 'location' => 'Aula Utama', 'time' => '14:00'],
['title' => 'Pelatihan Staff', 'icon' => 'chalkboard-teacher', 'location' => 'Ruang Training', 'time' => '15:30'],
['title' => 'Review Proyek', 'icon' => 'project-diagram', 'location' => 'Ruang Meeting 202', 'time' => '16:00'],
['title' => 'Diskusi Tim IT', 'icon' => 'code', 'location' => 'Ruang Server', 'time' => '17:00'],
['title' => 'Evaluasi Semester', 'icon' => 'tasks', 'location' => 'Ruang Akademik', 'time' => '08:30'],
['title' => 'Koordinasi Fakultas', 'icon' => 'university', 'location' => 'Ruang Dekan', 'time' => '11:00'],
['title' => 'Rapat Pengembangan', 'icon' => 'cogs', 'location' => 'Ruang Inovasi', 'time' => '14:30']
];
$chunks = array_chunk($schedules, 5);
@endphp

<div class="schedule-card rounded-xl p-6 shadow-lg">
    <div class="schedule-slider overflow-hidden">
        @foreach($chunks as $index => $scheduleGroup)
        <div class="schedule-slide" data-index="{{ $index }}">
            <div class="text-white font-poppins space-y-4">
                @foreach($scheduleGroup as $schedule)
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
        @endforeach
    </div>

    <div class="flex justify-center mt-4 space-x-2">
        @foreach($chunks as $index => $scheduleGroup)
        <button class="schedule-dot w-2 h-2 rounded-full bg-gray-400" data-index="{{ $index }}"></button>
        @endforeach
    </div>
</div>

<style>
.schedule-slider {
    position: relative;
    width: 100%;
}

.schedule-slide {
    position: absolute;
    width: 100%;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.schedule-slide.active {
    opacity: 1;
    position: relative;
    pointer-events: auto;
}

.schedule-dot.active {
    background-color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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