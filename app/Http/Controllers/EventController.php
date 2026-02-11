<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Player;
use App\Models\User;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Event CRUD and interactions.
 *
 * @author danidev
 */
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function index()
    {
        $query = Event::query();
        $user = Auth::user();

        // Only show visible events to non-admin users.
        if (!($user instanceof User) || !$user->isAdmin()) {
            $query->where('visible', true);
        }

        $events = $query->orderBy('date')->orderBy('hour')->get();

        return view('pages.events', compact('events'));
    }

    /**
     * Show the event details page.
     *
     * @param Event $event
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function show(Event $event)
    {
        $user = Auth::user();
        if (!($user instanceof User) || (!$user->isAdmin() && !$event->visible)) {
            abort(403, 'No tienes permiso para acceder a este evento.');
        }

        $event->load(['players']);
        // Compute like state and total for the current user.
        $isLiked = $event->likes()->where('users.id', $user->id)->exists();
        $likesCount = $event->likes()->count();

        return view('pages.evento-detalle', compact('event', 'isLiked', 'likesCount'));
    }

    /**
     * Show the create event form.
     *
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function create()
    {
        $event = new Event();
        return view('pages.añadir-evento', compact('event'));
    }

    /**
     * Store a new event.
     *
     * @param StoreEventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author danidev
     */
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

    /**
     * Show the edit event form.
     *
     * @param Event $event
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function edit(Event $event)
    {
        return view('pages.añadir-evento', compact('event'));
    }

    /**
     * Update an existing event.
     *
     * @param UpdateEventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author danidev
     */
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

    /**
     * Delete an event.
     *
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author danidev
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events')->with('success', 'Evento eliminado correctamente.');
    }

    /**
     * Remove a player from an event.
     *
     * @param Event $event
     * @param Player $player
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author danidev
     */
    public function detachPlayer(Event $event, Player $player)
    {
        $event->players()->detach($player->id);

        return back()->with('success', 'Jugador eliminado del evento.');
    }

    /**
     * Toggle like for the current user on an event.
     *
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author danidev
     */
    public function toggleLike(Event $event)
    {
        $user = Auth::user();
        if (!($user instanceof User)) {
            abort(403, 'No tienes permiso para realizar esta accion.');
        }

        $alreadyLiked = $event->likes()->where('users.id', $user->id)->exists();
        if ($alreadyLiked) {
            // Toggle off like.
            $event->likes()->detach($user->id);
            return back()->with('success', 'Me gusta eliminado.');
        }

        // Toggle on like.
        $event->likes()->attach($user->id);
        return back()->with('success', 'Me gusta registrado.');
    }

    /**
     * Show the shop page.
     *
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function tienda()
    {
        return view('pages.tienda');
    }

    /**
     * Show the messages page.
     *
     * @return \Illuminate\View\View
     *
     * @author danidev
     */
    public function mensaje()
    {
        return view('pages.mensaje');
    }
}
