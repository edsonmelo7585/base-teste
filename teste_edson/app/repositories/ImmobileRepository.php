<?php

namespace App\repositories;

use App\Immobiles;

class ImmobileRepository
{
    //
    public function storeImobile($params){


        $imovel = Immobiles::create($params);
        dd($imovel);

        // dd($params);
        // $imovelereco = new ImmobilesAddress();
        // $imovelereco->logradouro = $params->logradouro;
        // $imovelereco->numero = $params->numero;
        // $imovelereco->bairro = $params->bairro;
        // $imovelereco->cep = $params->cep;
        // $imovelereco->city_id = $params->city_id;
        // $imovelereco->save();
        // return $imovelereco;
    }
}
