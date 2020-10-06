<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guard = [];

    public function quote()
    {
        return $this->belongsTo('App\Quote');
    }
}
