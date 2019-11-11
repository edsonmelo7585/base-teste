<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    //
    protected $table = 'cities';

	protected $fillable = [
		'nome',
		'uf',
		'codigo_municipio',
		'state_id'
    ];


}
