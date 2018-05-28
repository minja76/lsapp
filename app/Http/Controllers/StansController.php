<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Stan;
use App\Mesto;
use App\Adresa;
use App\Naselje;
use App\Photo;
use App\Karakter;
use Session;


class StansController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }


    public function index()
    {
    
        $stans=Stan::orderBy('created_at','desc')->paginate(10);
        return view('stans.index')->withStans($stans);
    }

    public function create()
    {
        $karakters=Karakter::all();
        $mestos=Mesto::orderBy('naziv','asc')->get();
        $naseljes=Naselje::orderBy('naziv','asc')->get();
        $adresas=Adresa::orderBy('naziv','asc')->take(100)->get();
       
        return view('stans.create')->withMestos($mestos)->withNaseljes($naseljes)->withAdresas($adresas)->withKarakters($karakters);
    }



    public function create_adr(Request $request)
    {
    
       
        $data=Naselje::select('id','naziv')->where('sifra_mesto',$request->sifra_mesto)->orderBy('naziv','asc')->get();
      
        return response()->json($data);
       
    }


    public function create_nas(Request $request)
    {
    
       
      
        $data=Adresa::select('id','naziv')->where('sifra_naselje',$request->sifra_naselje)->orderBy('naziv','asc')->get();
        return response()->json($data);
       
    }



    public function store(Request $request)
    {
        //
        $this->validate($request, [
            
            'km' => 'required',
            'cena' => 'required',                 
            'sifra_mesto' => 'required',
            'sifra_naselje' => 'required',
            'sifra_adresa' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ],


      [                    
                    'km.required' => 'Unesite kvadraturu.',
                    'cena.required' => 'Unesite cenu.',
                    'sifra_mesto.required' => 'Unesite mesto.',
                    'sifra_naselje.required' => 'Unesite naselje.',
                    'sifra_adresa.required' => 'Unesite adresu.',            
                ]
            
            );
        if($request->hasFile('cover_image')){
            $filenameWithExtention=$request->file('cover_image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('cover_image')->storeAs('public/stanovi', $fileNameToStore);
            
            

        }else{ 

            $fileNameToStore='noimage.jpg';
        }

        $stan=new Stan;
       
       
        $stan->broj=$request->input('broj'); 
        $stan->km=$request->input('km'); 
        $stan->cena=$request->input('cena'); 
        $stan->opis=$request->input('opis'); 
        $stan->user_id=auth()->user()->id;
        $stan->cover_image=$fileNameToStore;
        $stan->sifra_mesto=$request->input('sifra_mesto'); 
        $stan->sifra_naselje=$request->input('sifra_naselje'); 
        $stan->sifra_adresa=$request->input('sifra_adresa'); 
        $stan->save();

        // return redirect ('/stans')->with('success', 'Uneli ste nekretninu.');
        //  return view('photos.create')->with('stan_id', $stan->id);
     
        
        $stan->karakters()->sync($request->karakters);
          
        //return redirect()->route('photoinsert', $stan->id);

        return redirect()->route('mapaid', $stan->id);

    

    }

    public function show($id)
    {
        //
       
        $stan=Stan::find($id);
        return view('stans.show')->withStan($stan);
    }


    public function edit($id)
    {
        //

        $stan=Stan::find($id);
        $karakters=Karakter::all();
        $mestos=Mesto::orderBy('naziv','asc')->get();
        $naseljes=Naselje::orderBy('naziv','asc')->get();
        $adresas=Adresa::orderBy('naziv','asc')->take(100)->get();
       
     
        if(auth()->user()->id!==$stan->user_id){

            return redirect('/stans')->with('error', 'Unauthorized Page');
        }
        return view('stans.edit')->withStan($stan)->withMestos($mestos)->withNaseljes($naseljes)->withAdresas($adresas)->withKarakters($karakters);
    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
           
            'cover_image' => 'image|nullable|max:1999',
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExtention=$request->file('cover_image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('cover_image')->storeAs('public/stanovi', $fileNameToStore);                    

        }


        $stan->broj=$request->input('broj'); 
        $stan->km=$request->input('km'); 
        $stan->cena=$request->input('cena'); 
        $stan->opis=$request->input('opis'); 
        $stan->user_id=auth()->user()->id;
        $stan->cover_image=$fileNameToStore;
        $stan->sifra_mesto=$request->input('sifra_mesto'); 
        $stan->sifra_naselje=$request->input('sifra_naselje'); 
        $stan->sifra_adresa=$request->input('sifra_adresa'); 

        if($request->hasFile('cover_image')){
            $stan->cover_image=$fileNameToStore;
        }
        $stan->save();

        return redirect ('/')->with('success', 'Izmenjen oglas.');
    


    }

    
    public function destroy($id)
    {
        //
        $stan=Stan::find($id);

       

        if(auth()->user()->id!==$stan->user_id){            
                        return redirect('/stans')->with('error', 'Unauthorized Page');
                    }
                 
         if($stan->cover_image!=='noimage.jpg')  {
             Storage::delete('public/stanovi/'.$stan->cover_image);
             
         }  
          
          

        $stan->photos()->delete(); 
         
        $stan->delete();
        return redirect ('/stans')->with('success', 'Oglas je obrisan.');
        
        }


        public function mapa($id)
        {
            //
           
            $stan=Stan::find($id);
            return view('stans.mapa')->withStan($stan);
        }

        public function latlng(Request $request, $id)
        {
            //
           
            $stan=Stan::find($id);
            $stan->lat=$request->input('lat');
            $stan->lng=$request->input('lng');  
            $stan->save();
    
            return redirect()->route('photoinsert', $stan->id);
        }
 

       
}
