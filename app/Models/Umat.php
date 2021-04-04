<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umat extends Model
{
    use SoftDeletes;

    protected $table = 'Umat';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'nama_baptis',
        'alamat',
        'no_telp',
        'pekerjaan',
        'status_meninggal',
        'status_umat_aktif',
        'lingkungan_id',
        'paroki_id',
        'keluarga_id'
    ];
}
