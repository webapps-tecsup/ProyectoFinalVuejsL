<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    public function Cancion()
    {
        return $this->hasMany(Cancion::class);
    }
}
