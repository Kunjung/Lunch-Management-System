<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    // Primary Key
    public $primaryKey = 'id';

    public function menu(){
        return $this->hasMany('App\Menu');
    }
}
