<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        // $id = auth()->user()->id;
        $albums = Album::with('Artista')->get();

        return $albums;
    }
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $archivo_foto     = $request->file('foto');
            $fileName_foto   = time() . '.' . $archivo_foto->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_foto, file_get_contents($archivo_foto));

            // $id = auth()->user()->id;
            // $albums = Album::all();
            $album = new Album();
            // $album->user_id = $id;
            $album->titulo = $request->titulo;
            $album->canciones = json_decode($request->canciones);
            $album->foto = $fileName_foto;
            $album->artista_id = $request->artistaId;
            $album->save();
            return $album;
        }
    }
    public function destroy($_id)
    {
        $album = Album::find($_id);
        $album->delete();
        return response()->json(["result" => "ok"], 200);
    }

    public function update(Request $request, $albumId)
    {
        $album = Album::find($albumId);
        $album->titulo = $request->titulo;
        $album->canciones = $request->canciones;
        $album->artista_id = $request->artistaId;
        $album->save();
        return response()->json(["result" => "ok"], 201);
    }
    public function show(Request $request, $albumId)
    {
        $album = Album::with('Artista')->get()->find($albumId);
        // ->with('Artista')->get();
        // return response()->json($album, 200);
        return response()->json($album, 200);
    }
    public function subir(Request $request)
    {
        if ($request->hasFile('musica')) {
            // $id = auth()->user()->id;
            $archivo_musica     = $request->file('musica');
            $fileName_musica   = time() . '.' . $archivo_musica->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_musica, file_get_contents($archivo_musica));

            // $archivo_imagen     = $request->file('imagen');
            // $fileName_imagen   = time() . '.' . $archivo_imagen->getClientOriginalExtension();
            // Storage::disk('fotos')->put('/' . $fileName_imagen, file_get_contents($archivo_imagen));

            // $musica = new Musica;
            // $musica->user_id = $id;
            // $musica->nombre_musica = $request->nombre_musica;
            // $musica->ruta_mp3 = $fileName_musica;
            // $musica->ruta = $fileName_imagen;
            // $musica->save();
            $url = Storage::url($fileName_musica);
            // $file = storage_path() . '/app/musicas' . $fileName_musica;
            Storage::setVisibility($fileName_musica, 'public');
            return $url;
            // return response()->file($file);
        }
        // // $id = auth()->user()->id;
        // // $albums = Album::all();
        // $album = new Album();
        // // $album->user_id = $id;
        // $album->titulo = $request->titulo;
        // $album->save();
        return "Funciona";
    }
}
