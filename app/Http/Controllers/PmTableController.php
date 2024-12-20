<?php

namespace App\Http\Controllers;

use App\Models\PmTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PmTableController extends Controller
{
    function fetch()  {
        return PmTable::paginate(100);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PmTable::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PmTable  $pmTable
     * @return \Illuminate\Http\Response
     */
    public function show(PmTable $pmTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PmTable  $pmTable
     * @return \Illuminate\Http\Response
     */
    public function edit(PmTable $pmTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PmTable  $pmTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        PmTable::whereId($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     */
    public function destroy($id)
    {
        PmTable::destroy($id);
    }
}
