<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterContact;
use Illuminate\Support\Facades\Mail;

class FooterContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'lang' => 'required|string|max:5',
        ]);

        // Guardar en base de datos
        $contact = FooterContact::create($validated);

        // Enviar email
        Mail::to('austin.beltran@refineria.es')->send(new \App\Mail\FooterContactReceived($contact));

        return back()->with('success', __('Saved.'));
    }
}
