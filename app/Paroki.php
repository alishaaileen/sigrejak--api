<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paroki extends Model
{
    protected $table = 'Paroki';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_paroki', 'id_romo_paroki',
    ];
}
