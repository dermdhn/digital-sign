<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage UNNES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    :root {
        --primary-blue: #1e3799;
        --secondary-blue: #4a69bd;
        --primary-yellow: #ffd32a;
        --light-yellow: #fff3b5;
    }

    @font-face {
        font-family: 'Montserrat';
        src: url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .signage-container {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .header {
        background: var(--primary-blue);
        padding: 20px;
        color: white;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .header-logo {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-logo img {
        height: 80px;
        filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
        transition: all 0.3s ease;
    }

    .header-logo img:hover {
        filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.8));
        transform: scale(1.05);
    }

    .header-title {
        font-size: 2rem;
        font-weight: bold;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .header-title small {
        font-size: 1.1rem;
        opacity: 0.9;
        display: block;
        margin-top: 5px;
    }

    .datetime {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--primary-yellow);
        text-align: right;
    }

    .news-ticker {
        background-color: var(--primary-yellow);
        padding: 8px;
        font-size: 1rem;
        color: var(--primary-blue);
        font-weight: 600;
    }

    .content-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: linear-gradient(180deg, #fff 0%, var(--light-yellow) 100%);
        overflow-y: auto;
    }

    .main-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 15px;
        gap: 15px;
    }

    .info-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary-blue);
    }

    .card-title {
        color: var(--primary-blue);
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .announcement {
        background: var(--primary-blue);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        font-size: 1.3rem;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .schedule-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .schedule-item {
        padding: 12px;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
    }

    .schedule-time {
        background: var(--primary-yellow);
        color: var(--primary-blue);
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.8rem;
        margin-right: 8px;
    }

    .quick-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .quick-info-item {
        background: var(--secondary-blue);
        color: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        font-size: 0.9rem;
    }

    .quick-info-item i {
        font-size: 1.5rem;
        color: var(--primary-yellow);
        margin-bottom: 8px;
    }

    .footer {
        background: var(--primary-blue);
        padding: 10px;
        text-align: center;
        color: white;
        font-size: 0.8rem;
    }

    .social-media {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 8px;
    }

    .social-media i {
        color: var(--primary-yellow);
        font-size: 1.2rem;
    }

    /* Optimasi untuk Portrait */
    @media screen and (orientation: portrait) {
        .header {
            padding: 15px;
        }

        .header-logo img {
            height: 60px;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .header-title small {
            font-size: 0.9rem;
        }

        .datetime {
            font-size: 1rem;
        }

        .main-content {
            padding: 10px;
        }

        .announcement {
            font-size: 1.1rem;
            padding: 15px;
        }

        .quick-info-item {
            padding: 10px;
        }
    }
    </style>
</head>

<body>
    <div class="signage-container">
        <div class="header">
            <div class="header-content">
                <div class="header-logo">
                    <img src="unnes.png" alt="UNNES Logo">
                    <div class="header-title">
                        Universitas Negeri Semarang<br>
                        <small>Konservasi dan Bereputasi Internasional</small>
                    </div>
                </div>
                <div class="datetime" id="datetime"></div>
            </div>
        </div>

        <div class="news-ticker">
            <marquee behavior="scroll" direction="left">
                PENGUMUMAN PENTING: Pendaftaran Wisuda Periode IV Tahun 2024 telah dibuka |
                Pekan Ilmiah Mahasiswa akan diselenggarakan pada tanggal 15-20 April 2024 |
                Selamat kepada Tim Robotika UNNES atas prestasi Juara 1 Nasional |
                Pembukaan Program Pertukaran Mahasiswa Merdeka periode 2024
            </marquee>
        </div>

        <div class="content-area">
            <div class="main-content">
                <div class="announcement">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Selamat Datang di Universitas Negeri Semarang
                </div>

                <div class="info-card">
                    <div class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Info Penting
                    </div>
                    <div class="quick-info">
                        <div class="quick-info-item">
                            <i class="fas fa-virus"></i>
                            <div>Status COVID-19</div>
                            <strong>Level 1</strong>
                        </div>
                        <div class="quick-info-item">
                            <i class="fas fa-temperature-high"></i>
                            <div>Cuaca</div>
                            <strong>28°C</strong>
                        </div>
                        <div class="quick-info-item">
                            <i class="fas fa-users"></i>
                            <div>Mahasiswa Aktif</div>
                            <strong>35,420</strong>
                        </div>
                        <div class="quick-info-item">
                            <i class="fas fa-award"></i>
                            <div>Akreditasi</div>
                            <strong>A</strong>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="card-title">
                        <i class="fas fa-calendar-alt"></i>
                        Agenda Hari Ini
                    </div>
                    <ul class="schedule-list">
                        <li class="schedule-item">
                            <span class="schedule-time">09:00</span>
                            Seminar Internasional (Auditorium UNNES)
                        </li>
                        <li class="schedule-item">
                            <span class="schedule-time">10:30</span>
                            Workshop Kewirausahaan (Gedung PKM)
                        </li>
                        <li class="schedule-item">
                            <span class="schedule-time">13:00</span>
                            Kuliah Umum Fakultas Teknik (Gedung E1)
                        </li>
                        <li class="schedule-item">
                            <span class="schedule-time">15:00</span>
                            Latihan Paduan Suara (Gedung Kesenian)
                        </li>
                    </ul>
                </div>

                <div class="info-card">
                    <div class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        Pengumuman Terkini
                    </div>
                    <ul class="schedule-list">
                        <li class="schedule-item">Pembukaan Beasiswa Unggulan 2024</li>
                        <li class="schedule-item">Pendaftaran KKN Periode Juli 2024</li>
                        <li class="schedule-item">Kompetisi Karya Ilmiah Mahasiswa</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>UNIVERSITAS NEGERI SEMARANG - KONSERVASI DAN BEREPUTASI INTERNASIONAL</div>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('datetime').textContent = now.toLocaleDateString('id-ID', options);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();

    setTimeout(() => {
        window.location.reload();
    }, 3600000);
    </script>
</body>

</html>