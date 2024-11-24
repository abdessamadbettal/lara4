<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactUs\StoreContactMessageRequest;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactMessageRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        // Create a new contact message record in the database
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'phone' => $validated['phone'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'locale' => $request->getLocale(),
            'user_id' => $request->user() ? $request->user()->id : null,
        ]);

        // Send a confirmation email
        Mail::to($contactMessage->email)->send(new ContactMessageMail());

        // Return an appropriate response
        return response()->json(['message' => 'Contact message sent successfully.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        //
    }
}
