<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.events');
    }
    public function jugadores()
    {
        return view('pages.jugadores');
    }
    public function tienda()
    {
        return view('pages.tienda');
    }

    public function añadirJugador()
    {
        return view('pages.añadir-jugador');
    }

    public function añadirEvento()
    {
        return view('pages.añadir-evento');
    }

    public function mensaje()
    {
        return view('pages.mensaje');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
