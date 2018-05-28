<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresa extends Model
{
    protected $table = 'adresa';
    
        public function stans(){
            
                    return $this->hasMany('App\Stan');
                }
}
