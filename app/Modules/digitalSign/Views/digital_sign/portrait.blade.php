<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Digital Signage UNNES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
</head>
<body class="bg-white text-black">
    <div id="version" style="display: none;">{{ $version }}</div>

    {{-- 1. Tampilkan semua media portrait terlebih dahulu --}}
    @php $mediaIndex = 0; @endphp
    @foreach ($media as $item)
        <div class="slide absolute inset-0 flex items-center justify-center" data-durasi="{{ $item->durasi }}">
            @if ($item->media_type === 'image')
                <img src="{{ asset('storage/' . $item->media) }}" alt="Media {{ $mediaIndex }}" class="h-full w-auto object-contain mx-auto">
            @elseif ($item->media_type === 'video')
                <video src="{{ asset('storage/' . $item->media) }}" class="h-full w-auto object-contain mx-auto" autoplay muted playsinline></video>
            @else
                <p class="text-center">[Media tidak dikenal]</p>
            @endif
        </div>
        @php $mediaIndex++; @endphp
    @endforeach

    {{-- 2. Tampilkan template custom setelah media --}}
    @foreach ($slides as $index => $slide)
        @include('digitalSign::digital_sign.template.' . $slide->nama_template, ['slide' => $slide, 'index' => $index])
    @endforeach

    <script>
        const slides = document.querySelectorAll('.slide');
        const fadeDuration = 1000;
        let currentSlide = 0;

        const inAnimation = 'fadein';
        const outAnimation = 'fadeout';

        function resetAnimations(element) {
            element.classList.remove('fadein', 'fadeout', 'slidein', 'slideout');
        }

        function getSlideDuration(index) {
            const durasi = parseInt(slides[index]?.dataset.durasi || "9", 10);
            return durasi * 1000;
        }

        function showNextSlide() {
            if (slides.length === 0) return;

            slides.forEach(slide => {
                slide.style.display = 'none';
                resetAnimations(slide);
            });

            if (currentSlide >= slides.length) currentSlide = 0;

            const slide = slides[currentSlide];
            slide.style.display = 'block';
            slide.classList.add(inAnimation);

            setTimeout(() => {
                slide.classList.remove(inAnimation);
                slide.classList.add(outAnimation);
                setTimeout(() => {
                    slide.style.display = 'none';
                    slide.classList.remove(outAnimation);
                    currentSlide++;
                    showNextSlide();
                }, fadeDuration);
            }, getSlideDuration(currentSlide));
        }

        function startVersionPolling(interval = 3000) {
            const versionElement = document.getElementById("version");
            const currentVersion = versionElement?.textContent.trim();

            setInterval(async () => {
                try {
                    const response = await fetch("/api/portrait/version", { cache: "no-store" });
                    if (!response.ok) throw new Error("Failed to fetch version");

                    const data = await response.json();
                    const latestVersion = data.version?.trim();

                    if (latestVersion && latestVersion !== currentVersion) {
                        console.warn("Version mismatch detected. Reloading page...");
                        location.reload();
                    }
                } catch (error) {
                    console.error("Version polling failed:", error);
                }
            }, interval);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showNextSlide();
            startVersionPolling();
        });
    </script>
</body>
</html>
