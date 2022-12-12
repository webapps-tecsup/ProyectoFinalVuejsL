<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaccion;
use Illuminate\Support\Facades\Storage;

class ReaccionController extends Controller
{
    public function store(Request $request)
    {
        $reaccion = new Reaccion();
        $reaccion->cancion_id = $request->cancion_id;
        $reaccion->user_id = $request->user()->_id;
        $reaccion->save();
        return $reaccion;
    }
    public function destroy(Request $request, $cancionId)
    {
        $reaccion = Reaccion::where('user_id', $request->user()->_id)->where('cancion_id', $cancionId)->first();
        $reaccion->delete();
        return $reaccion;
    }
}
