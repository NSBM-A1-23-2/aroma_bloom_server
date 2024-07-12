<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Function to save a contact
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new contact
        $contact = Contact::create([
            'email' => $request->email,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        // Return a response
        return response()->json(['message' => 'Contact saved successfully', 'contact' => $contact], 201);
    }
}
