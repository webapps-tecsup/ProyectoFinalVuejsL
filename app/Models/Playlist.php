<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    public function Cancion(){
        return $this->hasMany(Cancion::class);
    }
    public function Usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
