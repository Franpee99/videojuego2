<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidora extends Model
{
    /** @use HasFactory<\Database\Factories\DistribuidoraFactory> */
    use HasFactory;

    public function desarrolladoras()
    {
        return $this->hasMany(Desarrolladora::class);
    }
}
