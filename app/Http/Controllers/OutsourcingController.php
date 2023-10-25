<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutsourcingRequest;
use App\Http\Requests\UpdateOutsourcingRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Models\Outsourcing;
use App\Models\User;

class OutsourcingController extends Controller
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
    public function store(StoreOutsourcingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Outsourcing $outsourcing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outsourcing $outsourcing)
    {
        $user = Auth::user();
        return Inertia::render('outsourcings/edit', [
            'outsourcing' => $outsourcing,
            'user' =>  $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOutsourcingRequest $request, Outsourcing $outsourcing)
    {
        // 選択されたファイル情報よりファイルをアップロードしてパスを保存する
        if($request->comp_file1){
            $directory = 'public/outsourcing/'.$request->id;
            Storage::makeDirectory($directory);
            $file1_name = $request->comp_file1('file')->getClientOriginalName();
            $request->comp_file1('file')->storeAs($directory, $file1_name);
            $request->comp_file1 = $file1_name;
        }

        if($request->comp_file2){
            $directory = 'public/outsourcing/'.$request->id;
            Storage::makeDirectory($directory);
            $file2_name = $request->comp_file2('file')->getClientOriginalName();
            $request->comp_file2('file')->storeAs($directory, $file2_name);
            $request->comp_file2 = $file2_name;
        }

        if($request->comp_file3){
            $directory = 'public/outsourcing/'.$request->id;
            Storage::makeDirectory($directory);
            $file3_name = $request->comp_file3('file')->getClientOriginalName();
            $request->comp_file3('file')->storeAs($directory, $file3_name);
            $request->comp_file3 = $file3_name;
        }

        $outsourcing->comp_name = $request->comp_name;
        $outsourcing->comp_price_exc = $request->comp_price_exc;
        $outsourcing->comp_price_incl = $request->comp_price_incl;
        $outsourcing->remarks = $request->remarks;
        $outsourcing->comp_file1 = $request->comp_file1;
        $outsourcing->comp_file2 = $request->comp_file2;
        $outsourcing->comp_file3 = $request->comp_file3;
        $outsourcing->save();

        $user = Auth::user();
        if ($user->roll === 'admin') {
            return to_route('admin.os_appds.edit', ['os_appd' => $outsourcing->os_appd_id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        } else {
            return to_route('creator.os_appds.edit', ['os_appd' => $outsourcing->os_appd_id])
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outsourcing $outsourcing)
    {
        //
    }
}
