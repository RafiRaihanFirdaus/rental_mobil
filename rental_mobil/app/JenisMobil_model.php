<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMobil_model extends Model
{
    protected $table="jenis_mobil";
    protected $primarykey="id_jenis_mobil";
    public $timestamps=false;
    protected $fillable = [
        'jenis_mobil', 
    ];
}
