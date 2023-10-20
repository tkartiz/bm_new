<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $application = Application::find(1);
        return Inertia::render('contacts/create', [
            'user' => Auth::user(),
            'application' => $application,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        Contact::create([
            'user_id' => $request->user_id,
            'application_id' => $request->application_id,
            'email' => $request->email,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return to_route('applications.index')
            ->with([
                'message' => '発信しました。',
                'status' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
