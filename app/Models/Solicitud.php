<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);

    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

}
