<!DOCTYPE html>
<html lang="en">
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

        @keyframes slideInLeft {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInBottom {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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

        @media (max-aspect-ratio: 9/16) {
            .container, .container2, .container3 {
                width: 100%;
                height: auto;
            }
        }

        @media (min-aspect-ratio: 9/16) {
            .container, .container2, .container3 {
                height: 100%;
                width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="slide active" id="slide0">
        <div class="container">
            <div class="content" style="position:relative; height:100%; width:100%; padding:0;">
                <img src="/logobaru.png" alt="Logo UNNES" class="logo" style="position:absolute; top:48px; left:48px; width:551px; height:126px; max-width:none; z-index:2;">
                <div style="position:absolute; top:50%; left:48px; width:793px; height:191px; transform:translateY(-50%); text-align:left; z-index:2; display:flex; align-items:center;">
                    <h1 class="title" style="color:white; font-size:130px; margin:0; line-height:1.05; text-align:left; width:100%; height:100%; display:flex; align-items:center;">Dewan<br>Penyantun<br>Pendidikan</h1>
                </div>
                <h2 class="subtitle" style="position:absolute; left:0; top:70%; width:997px; height:119px; color:white; background:#b71c1c; display:flex; align-items:center; padding:0 48px; border-top-right-radius:225px; border-bottom-right-radius:225px; border-top-left-radius:0; border-bottom-left-radius:0; font-size:54px; z-index:2; justify-content:flex-start; writing-mode:unset; text-orientation:unset; transform:translateY(-50%);">Universitas Negeri Semarang</h2>
            </div>
        </div>
    </div>

    <div class="slide" id="slide1">
        <div class="container">
            <div class="content">
                <div class="header-section">
                    <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                    <h2 class="subtitle">Universitas Negeri Semarang</h2>
                </div>
                <div class="profile-section">
                    <img src="/airlangga.png" alt="Airlangga Hartato" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">AIRLANGGA HARTATO</h2>
                    <p class="position">Tokoh Masyarakat</p>
                </div>
            </div>
        </div>
    </div>

    <div class="slide" id="slide2">
        <div class="container2">
            <div class="content">
                <div class="header-section">
                    <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                    <h2 class="subtitle">Universitas Negeri Semarang</h2>
                </div>
                <div class="profile-section">
                    <img src="/gunawan.png" alt="Gunawan Tjokro" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">GUNAWAN TJOKRO</h2>
                    <p class="position">Majelis Wali Amanat</p>
                </div>
            </div>
        </div>
    </div>

    <div class="slide" id="slide3">
        <div class="container3">
            <div class="content">
                <div class="header-section">
                    <img src="/logobaru.png" alt="Logo UNNES" class="logo">
                    <h1 class="title">Dewan<br>Penyantun<br>Pendidikan</h1>
                    <h2 class="subtitle">Universitas Negeri Semarang</h2>
                </div>
                <div class="profile-section">
                    <img src="/ivan.png" alt="Ivan Cokro Saputra" class="profile-image">
                </div>
                <div class="name-box">
                    <h2 class="name">IVAN COKRO SAPUTRA</h2>
                    <p class="position">PT. Gunanusa Eramandiri Tbk.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function nextSlide() {
            // Hapus kelas active dari slide saat ini
            slides[currentSlideIndex].classList.remove('active');
            
            // Pindah ke slide berikutnya
            currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
            
            // Tambah kelas active ke slide baru
            slides[currentSlideIndex].classList.add('active');
        }

        // Ganti slide setiap 5 detik
        setInterval(nextSlide, 5000);

        // Pastikan slide pertama aktif saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            slides[0].classList.add('active');
        });
    </script>
</body>
</html> 