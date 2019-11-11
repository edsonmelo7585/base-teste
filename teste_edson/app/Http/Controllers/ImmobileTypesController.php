<?php

namespace App\Http\Controllers;

use App\immobiles_types;
use Illuminate\Http\Request;

class ImmobileTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipos = immobiles_types::all();
        return $tipos->toJson();         
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
     * @param  \App\immobile_types  $immobile_types
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $tipos = immobiles_types::find($id);
        if (isset($tipos)) {
            return json_encode($tipos);
        }
        return response('Tipo de Imóvel não encontrado', 404);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\immobile_types  $immobile_types
     * @return \Illuminate\Http\Response
     */
    public function edit(immobile_types $immobile_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\immobile_types  $immobile_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, immobile_types $immobile_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\immobile_types  $immobile_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(immobile_types $immobile_types)
    {
        //
    }
}
