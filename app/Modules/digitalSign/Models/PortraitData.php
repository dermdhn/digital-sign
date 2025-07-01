<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PortraitData extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $table = 'portrait_data';
    protected $primaryKey = 'id';
    protected $fillable = ['heading', 'subheading', 'nama_tokoh', 'jabatan_tokoh', 'gambar_tokoh', 'nama_template', 'urutan', 'is_aktif',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL")
    {
        return [
            'heading'        => 'required|string',
            'subheading'        => 'required|string',
            'nama_tokoh'        => 'required|string',
            'jabatan_tokoh'        => 'required|string',
            'gambar_tokoh'        => 'required|string',
            'nama_template'        => 'required|string',
            'urutan'        => 'required|numeric',
            'is_aktif'        => 'required',

        ];
    }
}
