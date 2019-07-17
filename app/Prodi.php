<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $fillable = [
        'prodi_id', 'prodi_name', 'fakultas_id',
    ];
    protected $table = "prodi";
}
