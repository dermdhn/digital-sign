<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kehadiran')->insert([
            [
                'id' => Str::uuid(),
                'nama_jabatan' => 'Direktur',
                'status' => 'Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jabatan' => 'Manager Pemasaran',
                'status' => 'Tidak Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jabatan' => 'Staf HRD',
                'status' => 'Cuti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}