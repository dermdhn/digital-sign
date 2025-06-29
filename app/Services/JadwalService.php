<?php

namespace App\Modules\DigitalSign\Services;

use App\Modules\digitalSign\Models\Jadwal;
use App\Modules\digitalSign\Models\Kehadiran;
use App\Modules\digitalSign\Models\TeksBerjalan;

class JadwalService
{
    public function getTodayJadwal()
    {
        return Jadwal::with('ruangan.lantai')
            ->orderBy('waktu_mulai')
            ->get();
    }

    public function getKehadiran()
    {
        return Kehadiran::all();
    }

    public function getTeksBerjalan()
    {
        return TeksBerjalan::orderBy('urutan')->get();
    }
}
