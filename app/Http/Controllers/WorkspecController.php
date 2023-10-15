<?php

namespace App\Http\Controllers;

use App\Models\Workspec;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkspecRequest;
use App\Http\Requests\UpdateWorkspecRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Models\Application;

class WorkspecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = (Integer)$_GET['application'];
        $Workspec2Application = Application::find($id);
        $workspecs = Workspec::where('application_id', '=', $id)->get();

        return Inertia::render('workspecs/index', [
            'workspecs' => $workspecs,
            'application' => $Workspec2Application,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = (Integer)$_GET['application'];
        $Workspec2Application = Application::find($id);

        return Inertia::render('workspecs/create', [
            'user' => Auth::user(),
            'application' => $Workspec2Application,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkspecRequest $request)
    {
        $id = (Integer)$_GET['application'];
        $application = Application::where('id', $id)->get();
        $application = $application[0];
        dd($application);

        Workspec::create([
            'size' => $request->works1_size,
            'format' => $request->works1_format,
            'article' => $request->works1_article,
            'content' => $request->works1_content,
            'file' => $request->works1_file,
            'quantity' => $request->works1_quantity,

            // 'size' => $request->'works'+ n +'_size',
            // 'format' => $request->'works'+ n +'_format',
            // 'article' => $request->'works'+ n +'_article',
            // 'content' => $request->'works'+ n +'_content',
            // 'file' => $request->'works'+ n +'_file',
            // 'quantity' => $request->'works'+ n +'_quantity',
        ]);

        return to_route('workspecs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspec $workspec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspec $workspec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkspecRequest $request, Workspec $workspec)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspec $workspec)
    {
        //
    }
}
