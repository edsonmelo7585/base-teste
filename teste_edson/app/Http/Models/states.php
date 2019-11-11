<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    //
	protected $table = 'states';

	protected $fillable = [
        'nome', 
        'uf'
	];

	// public function jogos()
	// {
	// 	return $this->hasMany(Jogo::class, 'timevisitante_id');
	// }
}

