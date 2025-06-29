<?php

namespace App\Modules\digitalSign\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Lantai extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $table = 'lantai';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'label', 'urutan', 'is_aktif',  'created_by', 'updated_by', 'deleted_by'];

    public static function validation_data($update_id = "NULL")
    {
        return [
            'nama'        => 'required|string',
            'label'        => 'required|string',
            'urutan'        => 'required|numeric',
            'is_aktif'        => 'required',

        ];
    }

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, "id_lantai", 'id');
    }
}
