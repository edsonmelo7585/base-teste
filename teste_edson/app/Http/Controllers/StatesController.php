<?php

namespace App\Http\Controllers;

use App\states;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $states = states::all();
        return $states->toJson();        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\states  $states
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $estado = states::find($id);
        if (isset($estado)) {
            return json_encode($estado);
        }
        return response('Estado não encontrado', 404);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\states  $states
     * @return \Illuminate\Http\Response
     */
    public function edit(states $states)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\states  $states
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, states $states)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\states  $states
     * @return \Illuminate\Http\Response
     */
    public function destroy(states $states)
    {
        //
    }
}
