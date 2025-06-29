<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\digitalSign\Models\Ruangan;


class Jadwal extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'jadwal';
	protected $primaryKey = 'id';
    protected $fillable = ['nama_kegiatan', 'icon', 'id_ruangan', 'waktu_mulai', 'waktu_selesai',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'nama_kegiatan'		=> 'required|string',
            'icon'		=> 'required|string',
            'id_ruangan'		=> 'required|string',
            'waktu_mulai'		=> 'required',
            'waktu_selesai'		=> 'required',
            
        ];
    }

	public function ruangan()
                {
		return $this->belongsTo(Ruangan::class,"id_ruangan", 'id');
	}

    
}
