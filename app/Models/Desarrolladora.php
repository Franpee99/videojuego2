<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desarrolladora extends Model
{
    /** @use HasFactory<\Database\Factories\DesarrolladoraFactory> */
    use HasFactory;

    public function videojuegos()
    {
        return $this->hasMany(Videojuego::class);
    }

    public function distribuidora()
    {
        return $this->belongsTo(Distribuidora::class);
    }
}
