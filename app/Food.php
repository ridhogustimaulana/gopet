<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image', 'name', 'price', 'description', 'category', 'id_petshop',
    ];

    public function userPetshop(){
        return $this->belongsTo(UserPetshop::class, 'id_petshop', 'id');
    }
}
