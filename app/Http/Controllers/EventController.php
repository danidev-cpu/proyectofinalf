<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query();

        if (!Auth::check() || !Auth::user()->isAdmin()) {
            $query->where('visible', true);
        }

        $events = $query->orderBy('date')->orderBy('hour')->get();
        $likedEventIds = [];

        if (Auth::check()) {
            $likedEventIds = Auth::user()->likedEvents()->pluck('events.id')->all();
        }

        return view('pages.events', compact('events', 'likedEventIds'));
    }

    public function show(Event $event)
    {
        if (!Auth::check() || (!Auth::user()->isAdmin() && !$event->visible)) {
            abort(403, 'No tienes permiso para acceder a este evento.');
        }

        $event->load(['players', 'likes']);
        $visiblePlayers = Player::where('visible', true)->orderBy('name')->get();
        $liked = Auth::check() ? $event->likes->contains(Auth::id()) : false;

        return view('pages.evento-detalle', compact('event', 'visiblePlayers', 'liked'));
    }

    public function create()
    {
        $event = new Event();
        return view('pages.añadir-evento', compact('event'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string',
            'location' => 'required|string',
            'map' => 'nullable|string',
            'date' => 'nullable|date',
            'hour' => 'required|date_format:H:i',
            'type' => 'required|in:official,exhibition,charity',
            'tags' => 'required|string',
            'visible' => 'nullable|boolean',
        ]);

        $event = new Event();
        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->location = $validated['location'];
        $event->map = $validated['map'] ?? null;
        $event->date = $validated['date'] ?? null;
        $event->hour = $validated['hour'];
        $event->type = $validated['type'];
        $event->tags = $validated['tags'];
        $event->visible = (bool) ($validated['visible'] ?? false);

        $event->save();

        return redirect()->route('events')->with('success', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('pages.añadir-evento', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string',
            'location' => 'required|string',
            'map' => 'nullable|string',
            'date' => 'nullable|date',
            'hour' => 'required|date_format:H:i',
            'type' => 'required|in:official,exhibition,charity',
            'tags' => 'required|string',
            'visible' => 'nullable|boolean',
        ]);

        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->location = $validated['location'];
        $event->map = $validated['map'] ?? null;
        $event->date = $validated['date'] ?? null;
        $event->hour = $validated['hour'];
        $event->type = $validated['type'];
        $event->tags = $validated['tags'];
        $event->visible = (bool) ($validated['visible'] ?? false);

        $event->save();

        return redirect()->route('events.show', $event)->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events')->with('success', 'Evento eliminado correctamente.');
    }

    public function toggleLike(Event $event)
    {
        $user = Auth::user();

        if ($event->likes()->where('user_id', $user->id)->exists()) {
            $event->likes()->detach($user->id);
        } else {
            $event->likes()->attach($user->id);
        }

        return back();
    }

    public function attachPlayer(Request $request, Event $event)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
        ]);

        $player = Player::where('id', $validated['player_id'])->where('visible', true)->firstOrFail();
        $event->players()->syncWithoutDetaching([$player->id]);

        return back()->with('success', 'Jugador añadido al evento.');
    }

    public function detachPlayer(Event $event, Player $player)
    {
        $event->players()->detach($player->id);

        return back()->with('success', 'Jugador eliminado del evento.');
    }

    public function tienda()
    {
        return view('pages.tienda');
    }

    public function mensaje()
    {
        return view('pages.mensaje');
    }
}
