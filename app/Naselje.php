<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Naselje extends Model
{
    //

    protected $table = 'naselje';

    public function stans(){
        
                return $this->hasMany('App\Stan');
            }
    
        public function adresas(){
            
                    return $this->hasMany('App\Adresa');
                }

        public function mesto(){
                    
                    return $this->belongsTo('App\Mesto');
                        }
       
}
