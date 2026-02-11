<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Player;
use App\Models\User;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\AttachEventPlayerRequest;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query();
        $user = Auth::user();

        if (!($user instanceof User) || !$user->isAdmin()) {
            $query->where('visible', true);
        }

        $events = $query->orderBy('date')->orderBy('hour')->get();

        return view('pages.events', compact('events'));
    }

    public function show(Event $event)
    {
        $user = Auth::user();
        if (!($user instanceof User) || (!$user->isAdmin() && !$event->visible)) {
            abort(403, 'No tienes permiso para acceder a este evento.');
        }

        $event->load(['players']);
        $eventPlayersForView = $event->players;
        if (!$user->isAdmin()) {
            $eventPlayersForView = $event->players->where('visible', true)->values();
        }
        $visiblePlayers = Player::where('visible', true)->orderBy('name')->get();

        return view('pages.evento-detalle', compact('event', 'visiblePlayers', 'eventPlayersForView'));
    }

    public function create()
    {
        $event = new Event();
        return view('pages.añadir-evento', compact('event'));
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $event = new Event();
        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->location = $data['location'];
        $event->map = $data['map'] ?? null;
        $event->date = $data['date'] ?? null;
        $event->hour = $data['hour'];
        $event->type = $data['type'];
        $event->tags = $data['tags'];
        $event->visible = (bool) ($data['visible'] ?? false);

        $event->save();

        return redirect()->route('events')->with('success', 'Evento creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('pages.añadir-evento', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();

        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->location = $data['location'];
        $event->map = $data['map'] ?? null;
        $event->date = $data['date'] ?? null;
        $event->hour = $data['hour'];
        $event->type = $data['type'];
        $event->tags = $data['tags'];
        $event->visible = (bool) ($data['visible'] ?? false);

        $event->save();

        return redirect()->route('events.show', $event)->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events')->with('success', 'Evento eliminado correctamente.');
    }

    public function attachPlayer(AttachEventPlayerRequest $request, Event $event)
    {
        $data = $request->validated();
        $player = Player::where('id', $data['player_id'])->where('visible', true)->firstOrFail();
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
