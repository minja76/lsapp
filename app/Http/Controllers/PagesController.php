<?php

namespace App\Http\Controllers;
use App\Street;
use App\Stan;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }


    public function nis(Request $request){        
                  
        $streets=Street::all();
        return view('pages.nis', compact('streets'));
            
    }


    public function show($id){

        $street=Street::find($id);
        $streets=Street::where ('id', '!=', $id)->get();                                          
        return view('pages.show', compact('street'), compact('streets'));
                 
    }

    public function mapa(Request $request){  

        $stans=Stan::all();
        return view('pages.mapa')->withStans($stans);
  
    }
}
