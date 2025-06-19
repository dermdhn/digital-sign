@php
    $announcements = [
        [
            'icon' => 'bullhorn',
            'color' => 'red',
            'text' => 'Pengumuman Rektorat: Rapat Koordinasi Pimpinan Universitas Pukul 09.00 WIB'
        ],
        [
            'icon' => 'calendar-check',
            'color' => 'blue',
            'text' => 'Agenda: Pertemuan Dekanat Seluruh Fakultas Pukul 13.30 WIB'
        ],
        [
            'icon' => 'newspaper',
            'color' => 'green',
            'text' => 'Berita Terkini: Penandatanganan MoU UNNES dengan Mitra Internasional'
        ],
        [
            'icon' => 'info-circle',
            'color' => 'yellow',
            'text' => 'Layanan Terpadu Rektorat Buka Pukul 08.00-16.00 WIB'
        ]
    ];
@endphp

@foreach($announcements as $announcement)
    <i class="fas fa-{{ $announcement['icon'] }} text-{{ $announcement['color'] }}-600 mr-3 text-2xl"></i>
    <span class="text-2xl">{{ $announcement['text'] }}</span>
    @if(!$loop->last)
        <span class="mx-8 text-2xl">|</span>
    @endif
@endforeach