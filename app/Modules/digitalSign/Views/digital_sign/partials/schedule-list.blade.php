@php
    use Illuminate\Support\Carbon;

    $groupedSchedules = $jadwal->chunk(3);
@endphp

<div class="schedule-card rounded-xl p-6 shadow-lg">
    {{-- Slider --}}
    <div class="schedule-slider overflow-hidden">
        @forelse($groupedSchedules as $index => $group)
            <div class="schedule-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                <div class="text-white font-poppins space-y-4">
                    @foreach($group as $item)
                        <div class="schedule-item rounded-lg p-4 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex-grow">
                                    <h3 class="group flex items-center mb-2">
                                        <span class="transition-colors duration-300">
                                            {{ $item->nama_kegiatan }}
                                        </span>
                                    </h3>
                                    <p class="location-text">
                                        {{ $item->ruangan->nama ?? '-' }}
                                        @if ($item->ruangan && $item->ruangan->lantai)
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right ml-6 text-sm">
                                    <p class="time-text flex items-center justify-end mb-1">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} WIB</span>
                                    </p>
                                    <p class="date-text flex items-center justify-end">
                                        <i class="far fa-calendar-check mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            {{-- Jika tidak ada jadwal --}}
        @endforelse
    </div>

    {{-- Navigasi dots --}}
    <div class="schedule-dots-container flex justify-center mt-8 space-x-3">
        @if ($groupedSchedules->count() > 1)
            <div class="flex justify-center mt-8 space-x-3">
                @foreach($groupedSchedules as $index => $group)
                    <button class="schedule-dot w-2 h-2 rounded-full bg-gray-400/50 transition-all duration-300 {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Pesan jika tidak ada jadwal --}}
    <div class="schedule-slider overflow-hidden"></div>
    <div class="schedule-dots-container"></div>
    <div class="schedule-empty-message hidden text-center text-gray-500 text-2xl font-semibold py-10">
        <i class="far fa-calendar-times text-4xl mb-3 block text-gray-400"></i>
        Tidak ada jadwal yang tersedia saat ini
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.schedule-slide');
        const dots = document.querySelectorAll('.schedule-dot');
        let currentSlide = 0;
        let slideInterval;

        if (slides.length === 0) return; // tidak ada jadwal

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            if (slides[index]) slides[index].classList.add('active');
            if (dots[index]) dots[index].classList.add('active');

            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function startSlideShow() {
            if (slideInterval) clearInterval(slideInterval);
            if (slides.length > 1) {
                slideInterval = setInterval(nextSlide, 5000);
            }
        }

        showSlide(0);
        startSlideShow();

        if (slides.length > 1) {
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    startSlideShow();
                });
            });
        }
    });
</script>
