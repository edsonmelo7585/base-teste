<?php

namespace App\Http\Controllers;

use App\cities;
use App\immobiles;
use App\immobiles_addresses;
use App\repositories\ImmobileRepository;
use App\repositories\ImmobilesAddressRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImmobileController extends Controller
{
    public function __construct(ImmobileRepository $immobilerepository,
        ImmobilesAddressRepository $immobilesaddressrepository)
    {
        $this->immobilerepository = $immobilerepository;
    }
    public function indexView()
    {
        return view('imoveis.index');
    }

    public function index()
    {
        $imoveis = immobiles::with(['owners', 'immobiles_type', 'immobiles_addresses'])->get();
        return $imoveis->toJson();
    }
    private function  getImoveisFiltro($nome, $order, $campo){

        if (isset($order))
            if ($order == 'municipio'){
                $ordenacao = 'cities.nome';
            } else {
                $ordenacao = 'immobiles_addresses.bairro';
            }
        if(!isset($nome))
            $imoveis = immobiles::with(['owners', 'immobiles_type', 'immobiles_addresses'])->paginate(10);
        else
        if(!isset($order))
            $imoveis = DB::table('immobiles')
            ->join('immobiles_addresses', 'immobiles.immobiles_addresses_id', '=', 'immobiles_addresses.id')
            ->join('cities', 'immobiles_addresses.city_id', '=', 'cities.id')
            ->where($campo, '=', $nome)
            ->paginate(10);
        else
            $imoveis = DB::table('immobiles')
            ->join('immobiles_addresses', 'immobiles.immobiles_addresses_id', '=', 'immobiles_addresses.id')
            ->join('cities', 'immobiles_addresses.city_id', '=', 'cities.id')
            ->where($campo, '=', $nome)->orderBy($ordenacao)
            ->paginate(10);

        return $imoveis;
    }
    public function imoveisBairro($nome, $order){
        $imoveis = $this->getImoveisFiltro($nome, $order, 'immobiles_addresses.bairro');
        return $imoveis->toJson();
    }    
    public function imoveisMunicipio($nome, $order){
        $imoveis = $this->getImoveisFiltro($nome, $order, 'cities.nome');
        return $imoveis->toJson();        
    }    
    public function create()
    {
        return view('imoveis.index');
    }

    private function validarCep($cep) {
        $cep = trim($cep);
        return preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep);
    }

    public function store(Request $request)
    {        
        if (!$this->validarCep($request->immobiles_addresses['cep']))
        {
            return response('CEP Inválido', 404);
        }
        // $imovel = $this->immobilerepository->storeImobile($request->all());
        $endereco = new immobiles_addresses();
        $endereco->logradouro = $request->immobiles_addresses['logradouro'];
        $endereco->numero = $request->immobiles_addresses['numero'];
        $endereco->bairro = $request->immobiles_addresses['bairro'];
        $endereco->cep = $request->immobiles_addresses['cep'];
        $endereco->city_id = $request->immobiles_addresses['city_id'];
        $endereco->state_id = $request->immobiles_addresses['state_id'];
        $endereco->save();
        $imovel = new immobiles();
        $imovel->descricao = $request->input('descricao');
        $imovel->immobiles_addresses_id = $endereco->id;
        $imovel->owner_id = $request->input('owner_id');
        $imovel->immobiles_type_id = $request->input('immobiles_type_id');
        $imovel->save();
        return json_encode($imovel);                       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imovel = immobiles::find($id)::with(['owners', 'immobiles_type', 'immobiles_addresses'])->get();
        if (isset($imovel)) {
            return json_encode($imovel);
        }
        return response('Imóvel não encontrado', 404);
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
        $cep = $request->immobiles_addresses['cep'];

        if (!$this->validarCep($request->immobiles_addresses['cep']))
        {
            return response('CEP Inválido', 404);
        }
        $imovel = immobiles::find($id);
        if (isset($imovel)) {
            $id_end = $request->immobiles_addresses['id'];
            $endereco = immobiles_addresses::find($id_end);
            if(isset($endereco)){
                $endereco->id = $request->immobiles_addresses['id'];
                $endereco->logradouro = $request->immobiles_addresses['logradouro'];
                $endereco->numero = $request->immobiles_addresses['numero'];
                $endereco->bairro = $request->immobiles_addresses['bairro'];
                $endereco->cep = $request->immobiles_addresses['cep'];
                $endereco->city_id = $request->immobiles_addresses['city_id'];
                $endereco->state_id = $request->immobiles_addresses['state_id'];
                $endereco->save();
            }
            $imovel->descricao = $request->input('descricao');
            $imovel->owner_id = $request->input('owner_id');
            $imovel->immobiles_type_id = $request->input('immobiles_type_id');
            $imovel->save();
            return json_encode($imovel);
        }
        return response('Imóvel não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imovel = immobiles::find($id);
        if (isset($imovel)) {
            $imovel->delete();
            return response('OK', 200);
        }
        return response('Imóvel não encontrado', 404);
    }
}
