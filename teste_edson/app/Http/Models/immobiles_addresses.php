<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class immobiles_addresses extends Model
{
    //
	protected $table = 'immobiles_addresses';

	protected $fillable = [
		'logradouro',
		'numero',
		'bairro',
		'cep',
        'city_id',
        'state_id'
    ];

    public function city()
    {
        return $this->belongsTo(cities::class, 'city_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(states::class, 'state_id', 'id');
    }
}
