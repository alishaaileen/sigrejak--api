<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUmat extends Model
{
    protected $table = 'Detail_Umat';

    protected $primaryKey = 'id_umat';

    public $timestamps = false;

    protected $fillable = [
        'id_umat',
        'tgl_baptis',
        'tgl_komuni',
        'tgl_penguatan',
        'cara_menikah',
        'tgl_menikah',
        'file_akta_lahir',
        'file_ktp'
    ];
}
