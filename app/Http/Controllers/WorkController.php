<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;

use App\Models\Work;
use App\Models\Admin;
use App\Models\User;
use App\Models\Creator;
use App\Models\Application;
use App\Models\Workspec;
use App\Models\Os_appd;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->roll === 'admin') {
            return Inertia::render('Admin/works/index', [
                'works' => Work::all(),
                'workspecs' => Workspec::all(),
                'applications' => Application::all(),
                'os_appd' => Os_appd::all(),
                'creators' => Creator::all(),
                'user' => $user,
            ]);
        } else {
            $creators = Creator::where('id', '=', $user->id)->first();
            $work = Work::where('creator_id', '=', $user->id)->get();
            $os_appd = Os_appd::all();

            return Inertia::render('Creator/works/index', [
                'works' => $work,
                'workspecs' => Workspec::all(),
                'applications' => Application::all(),
                'os_appd' => $os_appd,
                'creators' => $creators,
                'user' => $user,
            ]);
        };
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
        $Work2Os_appd = Os_appd::where('work_id', '=', $work->id)->first();
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        if($work->creator_id !== null){
            $creator = Creator::find($work->creator_id);
        } else {
            $creator = null;
        }
        $user = Auth::user();

        if($user->roll == 'admin'){

            return Inertia::render('Admin/works/show', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $Work2Os_appd,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
            ]);
        } else {
            return Inertia::render('Creator/works/show', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $Work2Os_appd,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        $user = Auth::user();
        if ($user->roll === 'admin') {
            $Work2Workspec = Workspec::find($work->work_spec_id);
            $Workspec2Application = Application::find($Work2Workspec->application_id);
            $client = User::where('id', '=', $Workspec2Application->user_id)->first();
            $creators = Creator::all();

            return Inertia::render('Admin/works/edit', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'client' => $client,
                'creators' => $creators,
                'user' => $user,
            ]);
        } else {
            $Work2Workspec = Workspec::find($work->work_spec_id);
            $Workspec2Application = Application::find($Work2Workspec->application_id);
            $client = User::where('id', '=', $Workspec2Application->user_id)->first();
            $creators = Creator::where('id', '=', $user->id)->first();

            return Inertia::render('Creator/works/edit', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'client' => $client,
                'creators' => $creators,
                'user' => $user,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->creator_id = $request->creator_id;
        if ($request->outsourcing === "1") {
            $work->outsourcing = true;
            $os_appd = Os_appd::where('work_id', '=', $work->id)->first();
            if (empty($os_appd)) {
                Os_appd::create([
                    'work_id' => $work->id,
                ]);
            }
        } elseif ($request->outsourcing === "0") {
            $work->outsourcing = false;
        }

        $work->started_at = $request->started_at;
        $work->completed_at = $request->completed_at;
        $work->message = $request->message;
        $work->save();

        $user = Auth::user();
        if ($user->roll === 'admin') {
            return to_route('admin.works.index', ['work' => $request->work_id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        } else {
            return to_route('creator.works.index', ['work' => $request->work_id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }
}
