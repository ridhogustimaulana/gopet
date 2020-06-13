<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'doctor_id', 'user_id', 'pet_name', 'diagnosis'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    //
}
