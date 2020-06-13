<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_user', 'id_petshop', 'id_item', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function userPetshop(){
        return $this->belongsTo(UserPetshop::class, 'id_petshop', 'id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'id_item', 'id');
    }
}
