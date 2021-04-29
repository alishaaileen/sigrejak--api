<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paroki extends Model
{
    protected $table = 'Paroki';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_paroki', 'id_romo_paroki',
    ];

    public function romo(){
        return $this->belongsTo('Admin', 'id_romo_paroki');
    }
}
