<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Modules\digitalSign\Models\Lantai; // Assuming you have a Lantai model

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lantai1Id = Lantai::where('nama', 'Lantai 1')->first()->id ?? Str::uuid(); // Get ID or create a dummy
        $lantai2Id = Lantai::where('nama', 'Lantai 2')->first()->id ?? Str::uuid();
        $lantai3Id = Lantai::where('nama', 'Lantai 3')->first()->id ?? Str::uuid();


        DB::table('ruangan')->insert([
            [
                'id' => Str::uuid(),
                'id_lantai' => $lantai1Id,
                'nama' => 'Ruang Rapat A',
                'urutan' => 1,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'id_lantai' => $lantai1Id,
                'nama' => 'Ruang Kelas 101',
                'urutan' => 2,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'id_lantai' => $lantai2Id,
                'nama' => 'Auditorium',
                'urutan' => 1,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'id_lantai' => $lantai3Id,
                'nama' => 'Lab Komputer',
                'urutan' => 1,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}