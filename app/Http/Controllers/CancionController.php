<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancion;
use App\Models\Reaccion;
use Illuminate\Support\Facades\Storage;

class CancionController extends Controller
{
    public function index(Request $request)
    {
        $canciones = [];
        if ($request->search == NULL) {
            $canciones = Cancion::with('Artista', 'Genero', 'reacciones')->get();
        } else {
            $canciones = Cancion::with('Artista', 'Genero', 'reacciones')->where('titulo', 'like', '%' . $request->search . '%')->get();
        }
        return $canciones;
    }
    public function miMusica(Request $request)
    {
        $canciones = Reaccion::where('user_id', $request->user()->_id)->with('cancion', 'cancion.reacciones', 'cancion.artista')->get();

        return $canciones;
    }
    public function store(Request $request)
    {
        if ($request->hasFile('musica')) {
            $archivo_musica     = $request->file('musica');
            $fileName_musica   = time() . '.' . $archivo_musica->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_musica, file_get_contents($archivo_musica));
            $archivo_foto     = $request->file('foto');
            $fileName_foto   = time() . '.' . $archivo_foto->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_foto, file_get_contents($archivo_foto));

            $cancion = new Cancion();
            $cancion->titulo = $request->titulo;
            $cancion->artista_id = $request->artistaId;
            $cancion->genero_id = $request->generoId;
            $cancion->ruta_cancion = $fileName_musica;
            $cancion->foto = $fileName_foto;
            $cancion->save();
            return $cancion;
        }
    }
    public function destroy($_id)
    {
        $cancion = Cancion::find($_id);
        $cancion->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(Request $request, $cancionId)
    {
        $cancion = Cancion::find($cancionId);
        $cancion->titulo = $request->titulo;
        $cancion->save();
        return response()->json(["result" => "ok"], 201);
    }
    public function cancionesPorArtista(Request $request, $id)
    {
        $canciones = Cancion::where('artista_id', $id)->get();
        return response()->json($canciones, 200);
    }
}
