<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    public function canciones()
    {
        return $this->belongsToMany(Cancion::class);
    }

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
