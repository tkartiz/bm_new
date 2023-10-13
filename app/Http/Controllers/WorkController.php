<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use Inertia\Inertia;

use App\Models\Work;
use App\Models\Application;

use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(application $application)
    {
        
        return Inertia::render('works/index', [
            'works' => Work::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = (Integer)$_GET['application'];
        $application = Application::where('id', $id)->get();
        $application = $application[0];

        return Inertia::render('works/create', [
            'user' => Auth::user(),
            'application' => $application,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return Inertia::render('works/index', [

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }
}
