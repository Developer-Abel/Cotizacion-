<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model{

    protected $table = 'cotizaciones';
    protected $primaryKey = 'id_cotizacion';
    public $timestamps = false;
}
