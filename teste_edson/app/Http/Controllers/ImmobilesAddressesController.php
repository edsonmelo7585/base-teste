<?php

namespace App\Http\Controllers;

use App\immobiles_addresses;
use App\repositories\ImmobilesAddressRepository;
use Illuminate\Http\Request;

class ImmobilesAddressesController extends Controller
{
    // public function __construct(ImmobilesAddressRepository $immobileaddressrepository)
    // {
    //     $this->immobileaddressrepository = $immobileaddressrepository;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $endereco = immobiles_addresses::with(['city', 'state'])->get();
        return json_encode($endereco);
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
        // $endereco = $this->immobileaddressrepository->storeImobile($request->all());
        // return json_encode($endereco);
        $endereco = new immobiles_addresses();
        $endereco->logradouro = $request->input('logradouro');
        $endereco->numero = $request->input('numero');
        $endereco->bairro = $request->input('bairro');
        $endereco->cep = $request->input('cep');
        $endereco->city_id = $request->input('city_id');
        $endereco->state_id = $request->input('state_id');
        $endereco->save();
        return json_encode($endereco);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\immobiles_addresses  $immobiles_addresses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $endereco = immobiles_addresses::find($id)::with(['city', 'state'])->get();
        if (isset($endereco)) {
            return json_encode($endereco);
        }
        return response('Endereço não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\immobiles_addresses  $immobiles_addresses
     * @return \Illuminate\Http\Response
     */
    public function edit(immobiles_addresses $immobiles_addresses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\immobiles_addresses  $immobiles_addresses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $endereco = immobiles_addresses::find($id);
        if(isset($endereco)){
            $endereco->logradouro = $request->input('logradouro');
            $endereco->numero = $request->input('numero');
            $endereco->bairro = $request->input('bairro');
            $endereco->cep = $request->input('cep');
            $endereco->city_id = $request->input('city_id');
            $endereco->state_id = $request->input('state_id');
            $endereco->save();
        }
        return response('Endereço não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\immobiles_addresses  $immobiles_addresses
     * @return \Illuminate\Http\Response
     */
    public function destroy(immobiles_addresses $immobiles_addresses)
    {
        //
    }
}
