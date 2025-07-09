<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PortraitMedia extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'portrait_media';
	protected $primaryKey = 'id';
    protected $fillable = ['nama', 'media', 'media_type', 'durasi', 'is_aktif', 'urutan',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'nama'		=> 'required|string',
            'media'		=> 'required|string',
            'media_type'		=> 'required|string',
            'durasi'		=> 'required|number',
            'is_aktif'		=> 'required',
            'urutan'		=> 'required|number',
            
        ];
    }

	
}
