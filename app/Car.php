<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $table = 'cars';

    public function colors(){
    	return $this->hasOne('App\Color','id','color');
    }
}
