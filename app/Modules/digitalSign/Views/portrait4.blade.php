<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage UNNES - Concert Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            min-width: 100vw;
            position: relative;
            font-family: 'Montserrat', sans-serif;
            background: #181d2b;
            overflow: hidden;
        }
        .bg-background {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 0;
        }
        .bg-image {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 1;
            /* filter: none; */
            object-position: center 65%;
        }

        .main-content {
            position: absolute;
            top: 75%;
            left: 0;
            width: 100vw;
            transform: translateY(-50%);
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .congrats {
            color: #ffb347;
            font-size: 2.5rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 2.2rem;
            opacity: 0.92;
            font-weight: 700;
            text-align: center;
            text-shadow: 0 4px 24px rgba(0,0,0,0.7), 0 2px 8px rgba(0,0,0,0.5);
        }
        .main-title {
            font-size: 5.5rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 6px;
            text-shadow: 0 4px 24px rgba(0,0,0,0.7), 0 2px 8px rgba(0,0,0,0.5);
            line-height: 1;
            text-align: center;
        }
        .subtitle {
            font-family: 'Pacifico', cursive;
            font-size: 2.8rem;
            color: #ffb347;
            margin-top: -1.5rem;
            margin-bottom: 2.5rem;
            letter-spacing: 2px;
            text-shadow: 0 4px 24px rgba(0,0,0,0.7), 0 2px 8px rgba(0,0,0,0.5);
            text-align: center;
        }
        .desc {
            color: #fff;
            font-size: 2.3rem;
            font-weight: 400;
            letter-spacing: 1.5px;
            opacity: 0.90;
            text-align: center;
            text-shadow: 0 4px 24px rgba(0,0,0,0.7), 0 2px 8px rgba(0,0,0,0.5);
        }
        @media (max-width: 700px) {
            .main-title { font-size: 2.5rem; }
            .subtitle { font-size: 1.3rem; }
            .congrats { font-size: 1.1rem; }
            .desc { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <img src="/bg5.png" alt="Background" class="bg-background">
    <img src="/airlangga.png" alt="Background" class="bg-image" id="bgImage">
    <div class="bg-gradient"></div>
    <div class="main-content">
        <div class="congrats" id="congrats">SELAMAT KEPADA DEWAN PENYANTUN</div>
        <div class="main-title" id="mainTitle">AIRLANGGA HARTATO</div>
        <div class="subtitle" id="subtitle">Tokoh Masyarakat</div>
        <div class="desc" id="desc">Universitas Negeri Semarang</div>
    </div>
    <script>
        // Untuk slideshow background dan data event
        const images = [
            '/airlangga.png',
            '/gunawan.png',
            '/ivan.png'
        ];
        const names = [
            'AIRLANGGA HARTATO',
            'GUNAWAN TJOKRO',
            'IVAN COKRO SAPUTRA'
        ];
        const subtitles = [
            'Tokoh Masyarakat',
            'Majelis Wali Amanat',
            'PT. Gunanusa Eramandiri Tbk.'
        ];
        let idx = 0;
        setInterval(() => {
            idx = (idx + 1) % images.length;
            document.getElementById('bgImage').src = images[idx];
            document.getElementById('mainTitle').textContent = names[idx];
            document.getElementById('subtitle').textContent = subtitles[idx];
        }, 7000);
    </script>
</body>
</html> 