<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lingkungan extends Model
{
    protected $table = 'Lingkungan';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_lingkungan', 'id_ketua_lingkungan',
    ];
}
