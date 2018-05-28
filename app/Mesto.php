<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesto extends Model
{
    
    protected $table = 'mesto';
    
        public function stans(){
            
                    return $this->hasMany('App\Stan');
                }
  }
  