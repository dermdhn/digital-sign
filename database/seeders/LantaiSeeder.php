<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LantaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lantai')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'Lantai 1',
                'label' => 'Lt. 1',
                'urutan' => 1,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Lantai 2',
                'label' => 'Lt. 2',
                'urutan' => 2,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Lantai 3',
                'label' => 'Lt. 3',
                'urutan' => 3,
                'is_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}