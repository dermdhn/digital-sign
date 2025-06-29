<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\digitalSign\Models\Lantai;


class Ruangan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'ruangan';
	protected $primaryKey = 'id';
    protected $fillable = ['id_lantai', 'nama', 'urutan', 'is_aktif',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'id_lantai'		=> 'required|string',
            'nama'		=> 'required|string',
            'urutan'		=> 'required|numeric',
            'is_aktif'		=> 'required',

        ];
    }

	public function lantai()
                {
		return $this->belongsTo(Lantai::class,"id_lantai", 'id');
	}


}
