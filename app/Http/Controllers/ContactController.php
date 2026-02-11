<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function show()
    {
        return view('pages.contact');
    }

    /**
     * Store a contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'subject' => 'required|string|max:100',
            'text' => 'required|string|min:10',
        ]);

        Message::create([
            'name' => $validated['name'],
            'subject' => $validated['subject'],
            'text' => $validated['text'],
        ]);

        return redirect()->route('contact')->with('success', 'Mensaje enviado correctamente');
    }

    /**
     * Show all contact messages (admin only).
     */
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('pages.contact-messages', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        if (!$message->readed) {
            $message->readed = true;
            $message->save();
        }

        return view('pages.message-detail', compact('message'));
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();

        return redirect()->route('mensaje')->with('success', 'Mensaje eliminado correctamente');
    }
}
