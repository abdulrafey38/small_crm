<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $fillable = ['name','email','phone','is_client'];


    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }



}


