<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jabatan extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'jabatan';
	protected $primaryKey = 'uuid';
    protected $fillable = ['uuid', 'name', 'is_presence', 'order', 'is_active',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'uuid'		=> 'required|string',
            'name'		=> 'required|string',
            'is_presence'		=> 'required',
            'order'		=> 'required|number',
            'is_active'		=> 'required',
            
        ];
    }

	
}
