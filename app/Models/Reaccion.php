<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Reaccion extends Model
{
    use HasFactory;
    public function cancion()
    {
        return $this->belongsTo(Cancion::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
