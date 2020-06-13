<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WashingAndSpa extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image', 'name', 'description', 'street', 'districts', 'city', 'latitude', 'longitude'
    ];
}
