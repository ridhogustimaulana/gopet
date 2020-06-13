<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'image', 'name', 'price', 'description', 'category', 'id_petshop',
    ];

    public function userPetshop()
    {
        return $this->belongsTo(UserPetshop::class, 'id_petshop', 'id');

    }
}
