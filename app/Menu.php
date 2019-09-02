<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public function posts(){
        return $this->hasMany('App\Food');
    }
}
