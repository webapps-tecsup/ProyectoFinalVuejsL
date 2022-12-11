<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;
    public function Album()
    {
        return $this->hasMany(Album::class);
    }
    public function Cancion()
    {
        return $this->hasMany(Cancion::class);
    }
}
