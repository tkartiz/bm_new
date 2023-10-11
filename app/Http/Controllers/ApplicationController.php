<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Http\Requests\StoreapplicationRequest;
use App\Http\Requests\UpdateapplicationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('applications/index', [
            'applications' => application::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('applications/create', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreapplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreapplicationRequest $request)
    {
        Application::create([
            'client_id' => $request->client_id,
            'subject' => $request->subject,
            'works_quantity' => $request->works_quantity,
            'severity' => $request->severity,
            'revision' => $request->revision,
            'applicated_at' => $request->applicated_at,
            'desired_dlvd_at' => $request->desired_dlvd_at,
        ]);

        // return to_route('workspecs.create');
        return to_route('applications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateapplicationRequest  $request
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateapplicationRequest $request, application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(application $application)
    {
        //
    }
}
