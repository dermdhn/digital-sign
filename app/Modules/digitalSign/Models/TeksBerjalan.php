<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TeksBerjalan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'teks_berjalan';
	protected $primaryKey = 'id';
    protected $fillable = ['konten', 'icon', 'urutan',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'konten'		=> 'required|string',
            'icon'		=> 'required|string',
            'urutan'		=> 'required|numeric',

        ];
    }


}
