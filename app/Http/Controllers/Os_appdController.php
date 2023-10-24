<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOs_appdRequest;
use App\Http\Requests\UpdateOs_appdRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Models\Work;
use App\Models\Admin;
use App\Models\User;
use App\Models\Creator;
use App\Models\Application;
use App\Models\Workspec;
use App\Models\Os_appd;
use App\Models\Outsourcing;

class Os_appdController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOs_appdRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Os_appd $os_appd)
    {
        $Os_appd2Work = Work::where('id', '=', $os_appd->work_id)->first();
        $Work2Workspec = Workspec::find($Os_appd2Work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        $creator = Creator::find($Os_appd2Work->creator_id);
        $user = Auth::user();

        return Inertia::render('os_appds/show', [
            'work' => $Os_appd2Work,
            'workspec' => $Work2Workspec,
            'application' => $Workspec2Application,
            'os_appd' => $os_appd,
            'client' => $client,
            'creator' => $creator,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Os_appd $os_appd)
    {
        $Os_appd2Work = Work::where('id', '=', $os_appd->work_id)->first();
        $Work2Workspec = Workspec::find($Os_appd2Work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        $creator = Creator::find($Os_appd2Work->creator_id);
        $user = Auth::user();

        return Inertia::render('os_appds/edit', [
            'work' => $Os_appd2Work,
            'workspec' => $Work2Workspec,
            'application' => $Workspec2Application,
            'os_appd' => $os_appd,
            'client' => $client,
            'creator' => $creator,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOs_appdRequest $request, Os_appd $os_appd)
    {
        $os_appd->work_id = $request->work_id;
        $os_appd->comment = $request->comment;
        $os_appd->spec = $request->spec;
        // $os_appd->order_recipient = $request->order_recipient;
        // $os_appd->price_exc = $request->price_exc;
        // $os_appd->price_incl = $request->price_incl;
        $os_appd->price_list = $request->price_list;
        $os_appd->remarks = $request->remarks;
        $os_appd->comp_num = $request->comp_num;
        $os_appd->save();

        $user = Auth::user();
        if ($user->roll === 'admin') {
            return to_route('admin.os_appds.show', ['os_appd' => $request->id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        } else {
            return to_route('creator.os_appds.show', ['os_appd' => $request->id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Os_appd $os_appd)
    {
        //
    }
}
