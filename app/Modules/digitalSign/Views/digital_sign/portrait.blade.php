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
        }

        .subtitle {
            font-size: 40px;
            margin-bottom: 4%;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .profile-section {
            position: absolute;
            right: 0;
            bottom: 193px;
            z-index: 1;
        }

        .profile-image {
            width: 860px;
            height: 971px;
            object-fit: cover;
        }

        .name-box {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 1080px;
            height: 193px;
            background-color: var(--primary-red);
            border-top-right-radius: 225px;
            border-bottom-right-radius: 225px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 50px;
            z-index: 1;
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

        @media (max-aspect-ratio: 9/16) {
            .container {
                width: 100%;
                height: auto;
            }
        }

        @media (min-aspect-ratio: 9/16) {
            .container {
                height: 100%;
                width: auto;
            }
        }
    </style>
</head>
<body>
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
</body>
</html>

