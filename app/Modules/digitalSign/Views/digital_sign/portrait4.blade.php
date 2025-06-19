<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage UNNES - Modern Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --text-light: #ecf0f1;
            --gradient-start: #3498db;
            --gradient-end: #2980b9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        }

        .slide-container {
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 1s ease;
        }

        .slide.active {
            opacity: 1;
        }

        .content-wrapper {
            height: 100%;
            display: grid;
            grid-template-columns: 40% 60%;
        }

        .info-section {
            padding: 5% 3%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transform: translateX(-100%);
            transition: transform 1s ease;
        }

        .active .info-section {
            transform: translateX(0);
        }

        .logo-section {
            text-align: center;
        }

        .logo {
            width: 300px;
            margin-bottom: 2rem;
        }

        .title-section {
            color: var(--text-light);
            margin: 2rem 0;
        }

        .title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #fff;
        }

        .subtitle {
            font-size: 1.8rem;
            font-weight: 500;
            opacity: 0.9;
            color: #fff;
        }

        .profile-section {
            position: relative;
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.2);
            transition: transform 1.5s ease;
        }

        .active .profile-image {
            transform: scale(1);
        }

        .name-card {
            position: absolute;
            bottom: 10%;
            right: 5%;
            background: var(--accent-color);
            padding: 2rem 4rem;
            border-radius: 20px;
            transform: translateX(200%);
            transition: transform 1s ease 0.5s;
        }

        .active .name-card {
            transform: translateX(0);
        }

        .name {
            font-size: 2.5rem;
            color: var(--text-light);
            font-weight: 700;
            margin: 0;
        }

        .position {
            font-size: 1.2rem;
            color: var(--text-light);
            opacity: 0.9;
            margin: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .slide.active .content-wrapper > * {
            animation: fadeIn 1s ease forwards;
        }
    </style>
</head>
<body>
    <div class="slide-container">
        <div class="slide active">
            <div class="content-wrapper">
                <div class="info-section">
                    <div class="logo-section">
                        <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    </div>
                    <div class="title-section">
                        <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                        <h2 class="subtitle">Universitas Negeri Semarang</h2>
                    </div>
                </div>
                <div class="profile-section">
                    <img src="/airlangga.png" alt="Airlangga Hartato" class="profile-image">
                    <div class="name-card">
                        <h2 class="name">AIRLANGGA HARTATO</h2>
                        <p class="position">Tokoh Masyarakat</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="content-wrapper">
                <div class="info-section">
                    <div class="logo-section">
                        <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    </div>
                    <div class="title-section">
                        <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                        <h2 class="subtitle">Universitas Negeri Semarang</h2>
                    </div>
                </div>
                <div class="profile-section">
                    <img src="/gunawan.png" alt="Gunawan Tjokro" class="profile-image">
                    <div class="name-card">
                        <h2 class="name">GUNAWAN TJOKRO</h2>
                        <p class="position">Majelis Wali Amanat</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="content-wrapper">
                <div class="info-section">
                    <div class="logo-section">
                        <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    </div>
                    <div class="title-section">
                        <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                        <h2 class="subtitle">Universitas Negeri Semarang</h2>
                    </div>
                </div>
                <div class="profile-section">
                    <img src="/ivan.png" alt="Ivan Cokro Saputra" class="profile-image">
                    <div class="name-card">
                        <h2 class="name">IVAN COKRO SAPUTRA</h2>
                        <p class="position">PT. Gunanusa Eramandiri Tbk.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function nextSlide() {
            slides[currentSlideIndex].classList.remove('active');
            currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
            slides[currentSlideIndex].classList.add('active');
        }

        setInterval(nextSlide, 5000);

        document.addEventListener('DOMContentLoaded', () => {
            slides[0].classList.add('active');
        });
    </script>
</body>
</html> 