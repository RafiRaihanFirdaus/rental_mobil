<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_model extends Model
{
    protected $table="transaksi";
    protected $primarykey="id_transaksi";
    public $timestamps=false;
}
