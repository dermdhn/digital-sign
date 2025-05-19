<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TemplateDetail extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'template_detail';
	protected $primaryKey = 'id';
    protected $fillable = ['kode_template', 'kode_template_detail', 'keterangan',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'kode_template'		=> 'required|string',
            'kode_template_detail'		=> 'required|string',
            'keterangan'		=> 'required|string',
            
        ];
    }

	
}
