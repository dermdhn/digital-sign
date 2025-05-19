<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContentsTemplate extends Model 
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $table = 'contents_template';
	protected $primaryKey = 'id';
    protected $fillable = ['kode_template_detail', 'type', 'value', 'content_id',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL") {
        return [
	        'kode_template_detail'		=> 'required|string',
            'type'		=> 'required|string',
            'value'		=> 'required|string',
            'content_id'		=> 'required|string',
            
        ];
    }

	
}
