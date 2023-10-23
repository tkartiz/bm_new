<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use Inertia\Inertia;

use App\Models\Work;
use App\Models\Admin;
use App\Models\User;
use App\Models\Creator;
use App\Models\Application;
use App\Models\Workspec;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $work = Work::all();
        $Work2Workspec = Workspec::all();
        $Workspec2Application = Application::all();
        return Inertia::render('works/index', [
            'works' => $work,
            'workspecs' => $Work2Workspec,
            'applications' => $Workspec2Application,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $Work2Workspec = Workspec::find($work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $user = User::where('id', '=', $Workspec2Application->user_id)->get();
        $user = $user[0];
        $creator = Creator::find($work->creator_id);
        return Inertia::render('works/show', [
            'work' => $work,
            'workspec' => $Work2Workspec,
            'application' => $Workspec2Application,
            'user' => $user,
            'creator' => $creator,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        $Work2Workspec = Workspec::find($work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $user = User::where('id', '=', $Workspec2Application->user_id)->get();
        $user = $user[0];
        $creators = Creator::all();
        return Inertia::render('works/edit', [
            'work' => $work,
            'workspec' => $Work2Workspec,
            'application' => $Workspec2Application,
            'user' => $user,
            'creators' => $creators,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->creator_id = $request->creator_id;
        if ($request->outsourcing === "0") {
            $work->outsourcing = false;
        } else {
            $work->outsourcing = true;
        }
        $work->started_at = $request->started_at;
        $work->completed_at = $request->completed_at;
        $work->message = $request->message;
        $work->save();

        return to_route('admin.works.show', ['work' => $request->work_id])
            ->with([
                'message' => '更新しました。',
                'status' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }
}
