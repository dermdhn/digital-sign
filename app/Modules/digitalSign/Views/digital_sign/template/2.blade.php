<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage UNNES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0099FF;
            --secondary-blue: #33ADFF;
            --primary-red: #c0392b;
            --primary-gray: #f5f6fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            height: 100%;
            width: 100%;
            background-color: var(--primary-blue);
        }

        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            aspect-ratio: 9/16;
            width: auto;
            height: 100%;
            max-width: 100%;
            max-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            background: url('/background.png') no-repeat center center;
            background-size: cover;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .container2 {
            aspect-ratio: 9/16;
            width: auto;
            height: 100%;
            max-width: 100%;
            max-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            background: url('/bg2.png') no-repeat center center;
            background-size: cover;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .container3 {
            aspect-ratio: 9/16;
            width: auto;
            height: 100%;
            max-width: 100%;
            max-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            background: url('/bg3.png') no-repeat center center;
            background-size: cover;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 5% 5%;
            color: white;
            justify-content: flex-start;
            position: relative;
        }

        .header-section {
            margin-top: 5%;
            text-align: left;
            position: relative;
            z-index: 2;
            opacity: 0;
            transform: translateX(-50px);
        }

        .logo {
            width: 551px;
            height: 126px;
            margin-bottom: 3%;
            filter: drop-shadow(0 0 10px rgba(0,0,0,0.3));
            object-fit: contain;
        }

        .title {
            font-size: 96px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1%;
            font-family: 'Poppins', sans-serif;
            color:rgb(151, 0, 70);
        }

        .subtitle {
            font-size: 40px;
            margin-bottom: 4%;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: rgb(151, 0, 70);
        }

        .profile-section {
            position: absolute;
            right: -200px;
            bottom: 193px;
            z-index: 1;
            width: 960px;
            height: 1071px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateX(100px);
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .name-box {
            position: absolute;
            bottom: 100px;
            right: -200px;
            width: 1080px;
            height: 193px;
            background-color: var(--primary-red);
            border-top-right-radius: 225px;
            border-bottom-right-radius: 225px;
            border-top-left-radius: 225px;
            border-bottom-left-radius: 225px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 50px;
            z-index: 1;
            opacity: 0;
            transform: translateY(100px);
        }

        .name {
            font-size: 72px;
            font-weight: 600;
            color: white;
            margin: 0;
            line-height: 1.2;
            font-family: 'Poppins', sans-serif;
        }

        .position {
            font-size: 40px;
            font-weight: 600;
            color: white;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1.1);
            pointer-events: none;
            visibility: hidden;
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
            visibility: visible;
        }

        .slide.active .header-section {
            animation: slideInLeft 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .slide.active .profile-section {
            animation: slideInRight 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .slide.active .name-box {
            animation: slideInBottom 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Opening Animation */
        .opening-slide {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: url('/background5.jpg') no-repeat center center;
            background-size: cover;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .opening-slide.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Opening Slide -->
    <div class="opening-slide active" id="opening-slide">
        <div style="text-align: center; color: white; font-family: 'Poppins', sans-serif;">
            <img src="/UNNES2.png" alt="Logo UNNES" style="width: 469px; height: 465px; object-fit: contain;">
            <div style="font-size: 130px; font-weight: 800; letter-spacing: 2px;">UNNES</div>
            <div style="font-size: 86px; font-weight: 800; line-height: 1.1; margin-top: 20px;">
                SELAMAT DATANG<br>DI GEDUNG REKTORAT<br>UNNES
            </div>
            <div style="font-size: 58px; margin-top: 100px;">
                UNIVERSITAS NEGERI SEMARANG
            </div>
        </div>
    </div>

    <!-- Portrait Slides -->
    <div class="slide" id="slide1">
        <div class="container">
            <div class="content">
                <div class="header-section">
                    <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    <h1 class="title">Dewan Perwakilan Masyarakat</h1>
                    <h2 class="subtitle">Mahasiswa Baru</h2>
                </div>
                <div class="profile-section">
                    <!-- Pastikan path gambar benar -->
                    <img src="{{ asset('storage/portrait/tokoh_1750937762.png') }}" alt="Airlangga" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">AIRLANGGA</h2>
                    <p class="position">Petinggi Ailangga</p>
                </div>
            </div>
        </div>
    </div>

    <div class="slide" id="slide2">
        <div class="container2">
            <div class="content">
                <div class="header-section">
                    <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    <h1 class="title">Selamat Tinggal</h1>
                    <h2 class="subtitle">huhu</h2>
                </div>
                <div class="profile-section">
                    <!-- Pastikan path gambar benar -->
                    <img src="{{ asset('storage/portrait/tokoh_1750937973.png') }}" alt="Gunawan" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">GUNAWAN</h2>
                    <p class="position">Staf Pubdok</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const openingSlide = document.getElementById('opening-slide');
        const totalSlides = slides.length;
        const openingDuration = 4000; // ms
        const portraitDuration = 5000; // ms

        function showSlide(idx) {
            slides.forEach((s, i) => s.classList.remove('active'));
            slides[idx].classList.add('active');
        }

        function nextSlide() {
            // If on opening, move to the first portrait slide
            if (currentSlideIndex === 0) {
                currentSlideIndex = 1;
                openingSlide.classList.remove('active');
                showSlide(currentSlideIndex);
                setTimeout(nextSlide, portraitDuration);
            } else if (currentSlideIndex < totalSlides - 1) {
                currentSlideIndex++;
                showSlide(currentSlideIndex);
                setTimeout(nextSlide, portraitDuration);
            } else {
                // Back to opening slide
                currentSlideIndex = 0;
                showSlide(currentSlideIndex);
                openingSlide.classList.add('active');
                setTimeout(nextSlide, openingDuration);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(nextSlide, openingDuration);
        });
    </script>
</body>
</html>
