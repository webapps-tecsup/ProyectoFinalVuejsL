<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function index(Request $request)
    {
        $generos = Genero::all();
        return $generos;
    }
    public function store(Request $request)
    {

        $genero = new Genero();
        $genero->nombre = $request->nombre;
        $genero->save();
        return $genero;
    }
    public function destroy($_id)
    {
        $genero = Genero::find($_id);
        $genero->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(Request $request, $generoId)
    {
        $genero = Genero::find($generoId);
        $genero->nombre = $request->nombre;
        $genero->save();
        return response()->json(["result" => "ok"], 201);
    }
}
