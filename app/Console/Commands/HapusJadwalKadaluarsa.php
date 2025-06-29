<?php

namespace App\Console\Commands;

use App\Modules\digitalSign\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HapusJadwalKadaluarsa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:hapus-kadaluarsa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus data jadwal yang waktu_selesai-nya sudah lewat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = Jadwal::where('waktu_selesai', '<', Carbon::now())->delete();
        $this->info("Total {$deleted} jadwal kadaluarsa dihapus.");
    }
}
