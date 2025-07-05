<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeksBerjalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teks_berjalan')->insert([
            [
                'id' => Str::uuid(),
                'konten' => 'Selamat datang di Gedung Utama!',
                'icon' => 'fa-bell',
                'is_aktif' => true,
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'konten' => 'Informasi terbaru dapat dilihat di papan pengumuman.',
                'icon' => 'fa-info-circle',
                'is_aktif' => true,
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'konten' => 'Harap jaga kebersihan lingkungan sekitar.',
                'icon' => 'fa-leaf',
                'is_aktif' => true,
                'urutan' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}