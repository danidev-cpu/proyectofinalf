<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Str;


class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();
        return view("pages.jugadores" , compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.añadir-jugador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $player = new Player();
        $player->name = $request->name;
        $player->number = $request->number;
        $player->slug = Str::slug($request->name);

        // Aquí es donde procesas el archivo que viene del $request
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('players', 'public');
            $player->image = $path; // Guardamos la ruta en el objeto
        }

        $player->save(); // Se guarda en la BD
        return redirect()->route('players.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
