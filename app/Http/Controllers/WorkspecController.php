<?php

namespace App\Http\Controllers;

use App\Models\Workspec;
use App\Models\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkspecRequest;
use App\Http\Requests\UpdateWorkspecRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'user' => Auth::user(),
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
        // 選択されたファイル情報よりファイルをアップロードしてパスを保存する
        if($request->file){
            $directory = 'public/'.$request->application_id;
            Storage::makeDirectory($directory);
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($directory, $file_name);
            $request->file = $file_name;
        }

        Workspec::create([
            'application_id' => $request->application_id,
            'size' => $request->size,
            'format' => $request->format,
            'article' => $request->article,
            'content' => $request->content,
            'file' => $request->file,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
        ]);

        // 親の申請書の制作物点数を更新する
        $id = $request->application_id;
        $workspecs = Workspec::where('application_id', '=', $id)->get();
        $works_quantity = count($workspecs); 
        $Workspec2Application = Application::find($id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();

        return to_route('workspecs.index', ['application' => $request->application_id])
            -> with([
                'message' => '登録しました。',
                'status' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspec $workspec)
    {
        $user = Auth::user();
        $id = $workspec->application_id;
        $Workspec2Application = Application::find($id);

        return Inertia::render('workspecs/show', [
            'user' => $user,
            'workspec' => $workspec,
            'application' => $Workspec2Application,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspec $workspec)
    {
        $user = Auth::user();
        $id = $workspec->application_id;
        $Workspec2Application = Application::find($id);

        return Inertia::render('workspecs/edit', [
            'user' => $user,
            'workspec' => $workspec,
            'application' => $Workspec2Application,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkspecRequest $request, Workspec $workspec)
    {
        $workspec->application_id = $request->application_id;
        $workspec->size = $request->size;
        $workspec->format = $request->format;
        $workspec->article = $request->article;
        $workspec->content = $request->content;
        $workspec->file = $request->file;
        $workspec->quantity = $request->quantity;
        $workspec->unit = $request->unit;
        $workspec->save();

        return to_route('workspecs.index', ['application' => $request->application_id])
            -> with([
                'message' => '更新しました。',
                'status' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspec $workspec)
    {
        $id = $workspec->application_id;

        if($workspec->file){
            $directory = 'public/'.$workspec->application_id;
            $files = Storage::files($directory);
            if(count($files) < 2 ){
                Storage::deleteDirectory($directory);
            } else {
                Storage::disk('public')->delete($workspec->application_id.'/'.$workspec->file);
            }
        }

        $workspec->delete();

        // 親の申請書の制作物点数を更新する
        $workspecs = Workspec::where('application_id', '=', $id)->get();
        $works_quantity = count($workspecs); 
        $Workspec2Application = Application::find($id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();

        return to_route('workspecs.index', ['application' => $id])
            ->with([
                'message' => '削除しました。',
                'status' => 'danger'
            ]);
    }
}
