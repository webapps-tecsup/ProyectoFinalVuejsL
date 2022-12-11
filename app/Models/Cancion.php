<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Cancion extends Model
{
    use HasFactory;
    public function Genero()
    {
        return $this->belongsTo(Genero::class);
    }
    public function Artista()
    {
        return $this->belongsTo(Artista::class);
    }
    public function Album()
    {
        return $this->hasMany(Album::class);
    }
    public function Playlist()
    {
        return $this->hasMany(Playlist::class);
    }
    protected $table = 'canciones';
}
