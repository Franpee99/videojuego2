<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posesion extends Model
{
    /** @use HasFactory<\Database\Factories\PosesionFactory> */
    use HasFactory;

    protected $table = 'posesiones'; // Indica el nombre correcto de la tabla

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }
}
