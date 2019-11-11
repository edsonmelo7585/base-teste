<?php

namespace App\Http\Controllers;

use App\cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = cities::all();
        return $cities->toJson();        
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
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cidade = cities::find($id);
        if (isset($cidade)) {
            return json_encode($cidade);
        }
        return response('Cidade não encontrada', 404);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(cities $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cities $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(cities $cities)
    {
        //
    }
}
