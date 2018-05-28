<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stan extends Model
{
    //
    public function user(){
        
                return $this->belongsTo('App\User');
            }

            public function mesto(){
                
               return $this->belongsTo('App\Mesto', 'sifra_mesto');
                 }

                 public function naselje(){
                  
                 return $this->belongsTo('App\Naselje', 'sifra_naselje');
                   }
  


                 public function adresa(){
                    
                   return $this->belongsTo('App\Adresa', 'sifra_adresa');
                     }

                     public function photos(){
                      
                     return $this->hasMany('App\Photo');
                       }

                       public function karakters(){
                        
                       return $this->belongsToMany('App\Karakter');
                         }
}
