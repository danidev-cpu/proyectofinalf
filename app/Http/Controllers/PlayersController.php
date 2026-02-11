<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\User;
use App\Http\Requests\StorePlayerRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Player::query();
        $user = Auth::user();

        if (!($user instanceof User) || !$user->isAdmin()) {
            $query->where('visible', true);
        }

        $search = trim((string) $request->get('q', ''));
        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('number', $search);
            });
        }

        $players = $query->get();
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
    public function store(StorePlayerRequest $request)
    {
        $player = new Player();
        $player->name = $request->name;
        $player->number = $request->number;
        $player->slug = Str::slug($request->name);
        $player->twitter = $request->twitter;
        $player->instagram = $request->instagram;
        $player->twitch = $request->twitch;
        $player->position = $request->position;
        $player->country = $request->country;
        $player->visible = (bool) $request->get('visible', false);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if (!$file instanceof UploadedFile || !$file->isValid() || $file->getPathname() === '') {
                return back()->withErrors(['photo' => 'No se pudo subir la imagen.'])->withInput();
            }
            Storage::disk('public')->makeDirectory('players');
            $path = $file->store('players', 'public');
            $player->photo = $path;
        }

        $player->save();
        return redirect()->route('jugadores.index')->with('success', 'Jugador añadido correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = Player::findOrFail($id);
        return view('pages.jugador-detalle', compact('player'));
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

    /**
     * Toggle player visibility.
     */
    public function toggleVisibility(string $id)
    {
        $player = Player::findOrFail($id);
        $player->visible = !$player->visible;
        $player->save();

        return redirect()->route('jugadores.index')->with('success', 'Visibilidad actualizada correctamente');
    }
}
