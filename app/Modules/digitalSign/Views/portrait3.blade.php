<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage UNNES - Elegant Portrait</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&family=Poppins:wght@800&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            min-width: 100vw;
            overflow: hidden;
            position: relative;
            font-family: 'Montserrat', sans-serif;
        }
        /* Background gradasi dan pola abstrak */
        .bg-gradient {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            background: linear-gradient(120deg, #232526 0%, #414345 100%);
        }
        .bg-pattern {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            background: url('https://www.transparenttextures.com/patterns/diagmonds-light.png');
            opacity: 0.18;
        }
        .bg-image {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 2;
        }
        .overlay {
            position: absolute;
            left: 0; right: 0;
            bottom: 0;
            height: 38vh;
            background: linear-gradient(0deg, rgba(20,20,20,0.85) 80%, rgba(20,20,20,0.1) 100%);
            z-index: 3;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
        }
        .content {
            position: absolute;
            left: 0; right: 0;
            /* dinaikkan ke atas */
            bottom: 18vh;
            z-index: 4;
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            /* padding-bottom: 5vh; */
        }
        .congrats {
            color: #fff;
            font-size: 2.1rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 2.2rem;
            opacity: 0.92;
            font-weight: 600;
        }
        .names {
            font-family: 'Playfair Display', serif;
            font-size: 4.2rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 3px;
            margin-bottom: 1.2rem;
            text-align: center;
            text-shadow: 0 2px 18px rgba(0,0,0,0.28);
        }
        .event-detail {
            color: #ffd700;
            font-size: 3.2rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1.1rem;
            text-align: center;
            text-shadow: 0 2px 10px rgba(0,0,0,0.18);
        }
        .desc {
            color: #fff;
            font-size: 2.3rem;
            font-weight: 400;
            letter-spacing: 1.5px;
            opacity: 0.90;
            text-align: center;
            text-shadow: 0 2px 8px rgba(0,0,0,0.18);
        }
        @media (max-width: 600px) {
            .names { font-size: 2.2rem; }
            .event-detail { font-size: 1.7rem; }
            .congrats { font-size: 1.1rem; }
            .desc { font-size: 1.3rem; }
            .content { bottom: 12vh; }
        }
        /* Fade out animation for opening slide */
        .opening-slide {
            position: absolute;
            z-index: 10;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            transition: opacity 1s ease;
            opacity: 1;
            pointer-events: auto;
        }
        .opening-slide.fade-out {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- Slide Pembuka -->
    <div class="opening-slide" id="openingSlide">
        <div class="bg-gradient"></div>
        <div class="bg-pattern"></div>
        <div style="position:relative; width:100vw; height:100vh;">
            <img src="/logobaru.png" alt="Logo UNNES" style="position:absolute; top:48px; left:48px; width:551px; height:126px; max-width:none; z-index:2;">
            <div style="position:absolute; top:50%; left:48px; width:793px; height:191px; transform:translateY(-50%); text-align:left; z-index:2; display:flex; align-items:center;">
                <span style="color:white; font-size:130px; margin:0; line-height:1.05; text-align:left; width:100%; height:100%; display:flex; align-items:center; font-family:'Poppins',sans-serif; font-weight:800;">Dewan<br>Penyantun<br>Pendidikan</span>
            </div>
            <span style="position:absolute; left:0; top:70%; width:997px; height:119px; color:white; background:#b71c1c; display:flex; align-items:center; padding:0 48px; border-top-right-radius:225px; border-bottom-right-radius:225px; border-top-left-radius:0; border-bottom-left-radius:0; font-size:54px; z-index:2; justify-content:flex-start; writing-mode:unset; text-orientation:unset; transform:translateY(-50%); font-family:'Poppins',sans-serif; font-weight:800;">Universitas Negeri Semarang</span>
        </div>
    </div>
    <div class="bg-gradient"></div>
    <div class="bg-pattern"></div>
    <img src="/airlangga.png" alt="Background" class="bg-image" id="bgImage">
    <div class="overlay"></div>
    <div class="content">
        <div class="congrats">SELAMAT KEPADA DEWAN PENYANTUN</div>
        <div class="names">AIRLANGGA HARTATO</div>
        <div class="event-detail">TOKOH MASYARAKAT</div>
        <div class="desc">Universitas Negeri Semarang</div>
    </div>
    <script>
        // Untuk slideshow background, ganti src gambar tiap beberapa detik
        const images = [
            '/airlangga.png',
            '/gunawan.png',
            '/ivan.png'
        ];
        let idx = 0;
        setInterval(() => {
            idx = (idx + 1) % images.length;
            document.getElementById('bgImage').src = images[idx];
            // Ganti juga nama dan detail jika ingin dinamis
            const names = [
                'AIRLANGGA HARTATO',
                'GUNAWAN TJOKRO',
                'IVAN COKRO SAPUTRA'
            ];
            const details = [
                'TOKOH MASYARAKAT',
                'MAJELIS WALI AMANAT',
                'PT. GUNANUSA ERAMANDIRI TBK.'
            ];
            document.querySelector('.names').textContent = names[idx];
            document.querySelector('.event-detail').textContent = details[idx];
        }, 7000);
        // Sembunyikan opening slide setelah 7 detik dengan animasi fade out
        setTimeout(() => {
            const opening = document.getElementById('openingSlide');
            if (opening) {
                opening.classList.add('fade-out');
            }
        }, 7000);
    </script>
</body>
</html> 