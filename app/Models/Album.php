<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    public function Artista()
    {
        return $this->belongsTo(Artista::class);
    }
    public function Cancion()
    {
        return $this->hasMany(Cancion::class);
    }
}
