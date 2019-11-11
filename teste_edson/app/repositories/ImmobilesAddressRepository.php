<?php

namespace App\repositories;

use App\ImmobilesAddress;

class ImmobilesAddressRepository
{
    //
    public function storeImobileAddress($params){


        $end = ImmobilesAddress::create($params);
        dd($end);

        // // dd($params);
        // $endereco = new ImmobilesAddress();
        // $endereco->logradouro = $params->logradouro;
        // $endereco->numero = $params->numero;
        // $endereco->bairro = $params->bairro;
        // $endereco->cep = $params->cep;
        // $endereco->city_id = $params->city_id;
        // $endereco->save();
        // return $endereco;
    }
}
