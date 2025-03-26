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
                                <span>Hari ini</span>
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

<style>
.schedule-slider {
    position: relative;
    width: 100%;
}

.schedule-slide {
    position: absolute;
    width: 100%;
    opacity: 0;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
    transform: translateY(20px);
}

.schedule-slide.active {
    opacity: 1;
    position: relative;
    pointer-events: auto;
    transform: translateY(0);
}

.schedule-dot.active {
    background-color: #FBBF24;
    width: 24px;
    border-radius: 9999px;
}

.schedule-item {
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.5s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
    background: rgba(255, 255, 255, 0.05);
    margin-bottom: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.schedule-item h3 {
    font-size: 1.25rem;
    line-height: 1.75rem;
    letter-spacing: 0.025em;
}

.schedule-item .location-text {
    font-size: 0.95rem;
    color: #E2E8F0;
    letter-spacing: 0.01em;
}

.schedule-item .time-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #FCD34D;
}

.schedule-item .date-text {
    font-size: 0.95rem;
    color: #A0AEC0;
}

.schedule-item:hover {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.schedule-item:nth-child(1) {
    animation-delay: 0.1s;
}

.schedule-item:nth-child(2) {
    animation-delay: 0.2s;
}

.schedule-item:nth-child(3) {
    animation-delay: 0.3s;
}

.schedule-item:nth-child(4) {
    animation-delay: 0.4s;
}

.schedule-item:nth-child(5) {
    animation-delay: 0.5s;
}

.schedule-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 0;
    background: #FBBF24;
    transition: height 0.3s ease;
}

.schedule-item:hover::before {
    height: 100%;
}

@keyframes pulse {
    0% {
        opacity: 1;
    }

    50% {
        opacity: 0.5;
    }

    100% {
        opacity: 1;
    }
}

.animate-pulse {
    animation: pulse 2s infinite;
}

.scale-102 {
    scale: 1.02;
}

.schedule-card {
    background: linear-gradient(135deg, #2C3E50 0%, #1a202c 100%);
    border: 1px solid rgba(255, 255, 255, 0.1);
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