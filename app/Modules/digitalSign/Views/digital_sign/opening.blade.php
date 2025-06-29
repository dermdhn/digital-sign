<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Gedung Rektorat UNNES</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            min-width: 100vw;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }
        .bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            object-fit: cover;
        }
        .main-content {
            position: relative;
            width: 1080px;
            height: 1920px;
            margin: 0 auto;
            z-index: 1;
        }
        .logo-unnes {
            position: absolute;
            left: 305px;
            top: 272px;
            width: 469px;
            height: 465px;
            object-fit: contain;
        }
        .unnes-text {
            position: absolute;
            left: 318px;
            top: 737px;
            width: 444px;
            height: 148px;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 130px;
            color: #fff;
            text-align: center;
            text-shadow: 0 4px 16px #000a, 0 2px 4px #0008;
            line-height: 148px;
            letter-spacing: 2px;
        }
        .welcome-text {
            position: absolute;
            left: 70px;
            top: 1118px;
            width: 939px;
            height: 291px;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 86px;
            color: #fff;
            text-align: center;
            line-height: 1.1;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #0007;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .footer-text {
            position: absolute;
            left: 63px;
            top: 1751px;
            width: 952px;
            height: 66px;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 58px;
            color: #fff;
            text-align: center;
            line-height: 66px;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px #0007;
        }
    </style>
</head>
<body>
    <img src="/background5.jpg" alt="Background" class="bg">
    <div class="main-content">
        <img src="/UNNES2.png" alt="Logo UNNES" class="logo-unnes">
        <div class="unnes-text">UNNES</div>
        <div class="welcome-text">SELAMAT DATANG<br>DI GEDUNG REKTORAT<br>UNNES</div>
        <div class="footer-text">UNIVERSITAS NEGERI SEMARANG</div>
    </div>
</body>
</html>
