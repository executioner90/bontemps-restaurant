<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KindStoreRequest;
use App\Models\Kind;
use Illuminate\Http\Request;

class KindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kinds = Kind::all();

        return view('admin.kinds.index', compact('kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kinds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KindStoreRequest $request)
    {
        Kind::create([
            'name' => $request->name,
        ]);

        return to_route('admin.kinds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kind $kind)
    {
        return view('admin.kinds.edit', compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kind $kind)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $kind->update([
            'name' => $request->name,
        ]);

        //redirect to index page
        return to_route('admin.kinds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kind $kind)
    {
        $kind->delete();

        //redirect to index page
        return to_route('admin.kinds.index');
    }
}
