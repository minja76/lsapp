<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karakter extends Model
{
    //
    public function stans(){
        
       return $this->belongsToMany('App\Stan');
         }

}
