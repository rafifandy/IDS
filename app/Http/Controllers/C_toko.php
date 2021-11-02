<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Toko;
use PDF;

class C_toko extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = toko::all();
        return view('/toko',compact('toko'),['x'=>'toko']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           
            'nama_toko' => 'max:50',
        ]);
        Toko::create([
            'id_toko' => $request->id_toko,
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'accuracy' => $request->accuracy,
        ]);
        return redirect('/toko')->with('status','Data Berhasil Ditambahkan!!!');  
    }

    public function cetak($id)
    {
        $pdf = PDF::loadView('tokopdf', compact('id'));
    
       return $pdf->stream('barcodeToko-'.$id.'.pdf');
    }

    public function getLocationToko(Request $request){
        $data['location'] = toko::where("id_toko",$request->id_toko)->get(["id_toko","nama_toko","latitude", "longitude","accuracy"]);
        //dd($data);
        return response()->json($data);
    }

    public function getDistanceFromLatLonInKm(Request $request) {
        //dd($request->barcode);
        $toko = DB::table('toko')->where('id_toko',$request->barcode)->get();
        //$toko = lokasi_toko::where('barcode',$request->barcode);
        //dd($toko);
        foreach($toko as $value){
            $lat = $value->latitude;
            $long = $value->longitude;
            $acc = $value->accuracy;
        }
        //dd($lat,$long,$acc);
        $earthRadius = 6371000; // Radius of the earth in meter
        //dd($dlat,$dlon);
        $lat_a = $request->latitude;
         $lon_a = $request->longitude;
         $lat_b = $lat;
         $lon_b = $long;
//dd($lat_a,$lon_a,$lat_b,$lat_b);
         $latFrom = deg2rad($lat_a);
         $lonFrom = deg2rad($lon_a);
         $latTo = deg2rad($lat_b);
         $lonTo = deg2rad($lon_b);
        //dd($latFrom,$lonFrom,$latTo,$lonTo);
         $latDelta = $latTo - $latFrom;
         $lonDelta = $lonTo - $lonFrom;
            //dd($latDelta,$lonDelta);
         $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
           cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
           //dd($angle);
         $betwenPoin = $angle * $earthRadius;
         dd($betwenPoin);
      
    }

    public function store2(Request $request)
    {
        
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}