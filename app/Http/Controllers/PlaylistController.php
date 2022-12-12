<?php

namespace App\Http\Controllers;

use App\Models\Cancion;
use Illuminate\Http\Request;
use App\Models\Playlist;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        $playLists = Playlist::where('user_id', $request->user()->_id)->with('canciones')->get();
        return $playLists;
    }
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $archivo_foto     = $request->file('foto');
            $fileName_foto   = time() . '.' . $archivo_foto->getClientOriginalExtension();
            Storage::disk('public')->put('/' . $fileName_foto, file_get_contents($archivo_foto));

            $playList = new Playlist();
            $playList->titulo = $request->titulo;
            $playList->foto = $fileName_foto;
            $playList->user_id = $request->user()->_id;
            $playList->save();
            return $playList;
        }
    }
    public function destroy($_id)
    {
        $playList = Playlist::find($_id);
        $playList->delete();
        return response()->json(["result" => "ok"], 200);
    }

    public function update(Request $request, $playListId)
    {
        $playList = Playlist::find($playListId);
        $playList->titulo = $request->titulo;
        $playList->save();
        return response()->json(["result" => "ok"], 201);
    }
    public function addCancionAplayList(Request $request)
    {
        $cancion = Cancion::find($request->cancion_id);
        $playList = Playlist::find($request->playlist_id)->canciones()->attach($cancion);

        return response()->json($playList, 200);
    }
    public function removeCancionAplayList(Request $request)
    {
        $cancion = Cancion::find($request->cancion_id);
        $playList = Playlist::find($request->playlist_id)->canciones()->detach($cancion);

        return response()->json($playList, 200);
    }
    public function show(Request $request, $playListId)
    {
        $playList = Playlist::with('canciones')->get()->find($playListId);

        return response()->json($playList, 200);
    }
}
