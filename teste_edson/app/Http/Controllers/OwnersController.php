<?php

namespace App\Http\Controllers;

use App\owners;
use Illuminate\Http\Request;

class OwnersController extends Controller
{
    public function indexView()
    {
        return view('proprietarios.index');
    }

    public function index()
    {
        $proprietarios = owners::all();
        return $proprietarios->toJson();
    }
    // public function index()
    // {
    //     //
    //     return view('proprietarios.index');
    // }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proprietarios.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prop = new owners();
        $prop->nome = $request->input('nome');
        $prop->save();
        return json_encode($prop);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prop = owners::find($id);
        if (isset($prop)) {
            return json_encode($prop);
        }
        return response('Proprietario não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prop = owners::find($id);
        if (isset($prop)) {
            $prop->nome = $request->input('nome');
            $prop->save();
            return json_encode($prop);
        }
        return response('Proprietario não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prop = owners::find($id);
        if (isset($prop)) {
            $prop->delete();
            return response('OK', 200);
        }
        return response('Proprietario não encontrado', 404);
    }
}