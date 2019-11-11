<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class immobiles extends Model
{
    //

// protected $table = 'immobiles';

// public function __construct()
// {
// }

protected $casts = [
    'immobiles_addresses_id' => 'int',
    'owner_id' => 'int',
    'immobiles_type_id' => 'int'
];

protected $fillable = [
    'descricao',
    'immobiles_addresses_id',
    'owner_id',
    'immobiles_type_id'
];

public function owners()
{
    return $this->belongsTo(owners::class, 'owner_id', 'id');
}

public function immobiles_addresses()
{
    return $this->belongsTo(immobiles_addresses::class, 'immobiles_addresses_id');
}
public function immobiles_type()
{
    return $this->belongsTo(immobiles_types::class, 'immobiles_type_id');
}
}
