<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Digital Signage UNNES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/portrait.css') }}"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
</head>
    <body>
        <div id="version" style="display: none;">{{ $version }}</div>

        <!-- OPENING -->
        <div id="opening" class="section active">
            <div class="main-content">
                <img src="/UNNES2.png" alt="Logo UNNES" class="logo-unnes fadein">
                <div class="unnes-text fadein">UNNES</div>
                <div class="welcome-text fadein">SELAMAT DATANG<br>DI GEDUNG REKTORAT<br>UNNES</div>
                <div class="footer-text fadein">UNIVERSITAS NEGERI SEMARANG</div>
            </div>
        </div>

        <!-- SLIDES -->
        @foreach ($slides as $index => $slide)
            @include('digitalSign::digital_sign.template.'.$slide->nama_template, ['slide' => $slide, 'index' => $index])
        @endforeach


    <script>
        // Display durations (ms)
        const openingDuration = 3000; // Opening: 3 seconds
        const slideDuration = 9000;   // Slide: 9 seconds
        const fadeDuration = 1000;    // Fade: 1 second

        let currentSlide = 0;

        // Animation names (can be changed as needed)
        const inAnimation = 'fadein';    // example: 'fadein', 'slidein'
        const outAnimation = 'fadeout';  // example: 'fadeout', 'slideout'

        // Get elements
        const opening = document.getElementById('opening');
        const slides = document.querySelectorAll('.slide');

        function resetAnimations(element) {
            element.classList.remove('fadein', 'fadeout', 'slidein', 'slideout');
            // Add other animation names if needed
        }

        function showOpening() {
            opening.style.display = 'block';
            resetAnimations(opening);
            opening.classList.add('fadein');
            slides.forEach(slide => {
                slide.style.display = 'none';
                resetAnimations(slide);
            });
            @if(count($slides) > 0)
                setTimeout(() => {
                    opening.classList.remove('fadein');
                    opening.classList.add('fadeout');
                    setTimeout(() => {
                        opening.style.display = 'none';
                        opening.classList.remove('fadeout');
                        showNextSlide();
                    }, fadeDuration);
                }, openingDuration);
            @endif
        }

        function showNextSlide() {
            if (slides.length === 0) return;

            slides.forEach(slide => {
                slide.style.display = 'none';
                resetAnimations(slide);
            });

            if (currentSlide >= slides.length) {
                currentSlide = 0;
                showOpening();
                return;
            }

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
            }, slideDuration);
        }

        function startVersionPolling(interval = 3000) {
            const versionElement = document.getElementById("version");
            if (!versionElement) return;

            const currentVersion = versionElement.textContent.trim();

            setInterval(async () => {
                try {
                    const response = await fetch("/api/portrait/version", {
                        cache: "no-store",
                    });
                    if (!response.ok) throw new Error("Failed to fetch version");

                    const data = await response.json(); // anggap respons berupa JSON { version: "..." }
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

        // Start with opening
        document.addEventListener('DOMContentLoaded', () => {
            showOpening();
            startVersionPolling();
        });
    </script>
    </body>
</html>
