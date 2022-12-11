<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;
use App\Models\Cancion;
use Illuminate\Support\Facades\Storage;

class ArtistaController extends Controller
{
    public function index(Request $request)
    {
        $artistas = Artista::all();
        return $artistas;
    }
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $archivo_foto     = $request->file('foto');
            $fileName_foto   = time() . '.' . $archivo_foto->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_foto, file_get_contents($archivo_foto));

            $artista = new Artista();
            $artista->nombre = $request->nombre;
            $artista->foto = $fileName_foto;
            $artista->save();
            return $artista;
        }
    }
    public function destroy($_id)
    {
        $artista = Artista::find($_id);
        $artista->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(Request $request, $artistaId)
    {
        $artista = Artista::find($artistaId);
        $artista->nombre = $request->nombre;
        $artista->save();
        return response()->json(["result" => "ok"], 201);
    }
    public function subir(Request $request)
    {
        if ($request->hasFile('musica')) {
            $archivo_musica     = $request->file('musica');
            $fileName_musica   = time() . '.' . $archivo_musica->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_musica, file_get_contents($archivo_musica));

            $url = Storage::url($fileName_musica);
            // $file = storage_path() . '/app/musicas' . $fileName_musica;
            Storage::setVisibility($fileName_musica, 'public');
            return $url;
        }

        return "Funciona";
    }
}
