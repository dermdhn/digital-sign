<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Modules\digitalSign\Models\Ruangan;


class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruanganAId = Ruangan::where('nama', 'Ruang Rapat A')->first()->id ?? Str::uuid();
        $auditoriumId = Ruangan::where('nama', 'Auditorium')->first()->id ?? Str::uuid();

        DB::table('jadwal')->insert([
            [
                'id' => Str::uuid(),
                'nama_kegiatan' => 'Rapat Bulanan',
                'icon' => 'fa-calendar-check',
                'id_ruangan' => $ruanganAId,
                'waktu_mulai' => now()->addDays(1)->setTime(9, 0, 0),
                'waktu_selesai' => now()->addDays(1)->setTime(11, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kegiatan' => 'Seminar Teknologi',
                'icon' => 'fa-calendar-check',
                'id_ruangan' => $auditoriumId,
                'waktu_mulai' => now()->addDays(2)->setTime(13, 0, 0),
                'waktu_selesai' => now()->addDays(2)->setTime(16, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kegiatan' => 'Workshop Desain Grafis',
                'icon' => 'fa-calendar-check',
                'id_ruangan' => $ruanganAId,
                'waktu_mulai' => now()->addDays(3)->setTime(10, 0, 0),
                'waktu_selesai' => now()->addDays(3)->setTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}