<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Stan;

class PhotosController extends Controller
{
    //

    public function create($stan_id)


    {
        return view('photos.create')->with('stan_id', $stan_id);

    }
   

    public function store(Request $request)  
        {
                  
            
            if ($request->has('files')){
                foreach($request->file('files') as $file){
                        $filenameWithExtention=$file->getClientOriginalName();
                        $filename=pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                        $extension=$file->getClientOriginalExtension();
                        $fileNameToStore=$filename.'_'.time().'.'.$extension;
                        $path=$file->storeAs('public/photos/'.$request->stan_id, $fileNameToStore); 
                        
                
                        $photo=new Photo;
                        $photo->stan_id=$request->stan_id;                                       
                        $photo->photo=$fileNameToStore;               
                        $photo->save();  
                        
                }}
         
                        return redirect('/stans/'.$request->stan_id)->with('success', 'Uneli ste oglas.');
                
       }   
    
 
    
}
