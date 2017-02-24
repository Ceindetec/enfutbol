<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos_torneo extends Model
{
    public function getEquipo()
    {
        return $this->belongsTo('App\Equipo', 'equipo_id');
    }
}
