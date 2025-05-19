<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contents extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'contents';
	protected $primaryKey = 'id';
    protected $fillable = ['nama', 'keterangan', 'kode_template', 'order', 'is_active',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'nama'		=> 'required|string',
            'keterangan'		=> 'required|string',
            'kode_template'		=> 'required|string',
            'order'		=> 'required|numeric',
            'is_active'		=> 'required|boolean',
            
        ];
    }

	
}
