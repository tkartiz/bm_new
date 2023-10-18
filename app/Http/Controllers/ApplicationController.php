<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Workspec;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreapplicationRequest;
use App\Http\Requests\UpdateapplicationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $application = Application::where('user_id', $user)->get();

        return Inertia::render('applications/index', [
            'applications' => $application
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('applications/create', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreapplicationRequest $request)
    {
        Application::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'works_quantity' => $request->works_quantity,
            'severity' => $request->severity,
            'applicated_at' => null,
            'desired_dlvd_at' => $request->desired_dlvd_at,
        ]);

        return to_route('applications.index')
            ->with([
                'message' => '登録しました。',
                'status' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(application $application)
    {
        $user = Auth::user();
        return Inertia::render('applications/show', [
            'application' => $application,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(application $application)
    {
        $user = Auth::user();
        return Inertia::render('applications/edit', [
            'application' => $application,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateapplicationRequest $request, application $application)
    {
        $application->user_id = $request->user_id;
        $application->subject = $request->subject;
        $application->works_quantity = $request->works_quantity;
        $application->severity = $request->severity;
        if($request->check === true){
            $application->applicated_at = date("Y-m-d");
        } else {
            $application->applicated_at = null;
        }
        $application->desired_dlvd_at = $request->desired_dlvd_at;
        $application->save();

        return to_route('applications.index')
            ->with([
                'message' => '更新しました。',
                'status' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(application $application)
    {
        $application->delete();

        return to_route('applications.index')
            ->with([
                'message' => '削除しました。',
                'status' => 'danger'
            ]);
    }
}
