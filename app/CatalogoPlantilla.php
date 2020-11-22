<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogoPlantilla extends Model
{
   protected $table = 'calogo_plantilla';
   protected $primaryKey = 'id_plantilla';
   // public $incrementing = false;
   public $timestamps = false;
}
