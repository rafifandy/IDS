<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Barang;
use PDF;

class C_barang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('/barang',compact('barang'),['x'=>'barang']);
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
            //'id_kategori' => 'required|unique:kategori_about|size:10',
            'nama' => 'required|max:50',
        ]);
        Barang::create($request->all());
        return redirect('/barang')->with('status','Data Berhasil Ditambahkan!!!'); 
    }

    public function cetak(Request $request){
        //dd($barang);
        //$data = Barang::all();
        $data = Barang::where("id_barang",'>=',$request->from)->where("id_barang",'<=',$request->to)->get();
        $baris = $request->baris_barang;
        $kolom = $request->kolom_barang;
        $long = count($data);
        $long =intval($long/5);
        $long++;
        //dd($baris,$kolom);
        $pdf = PDF::loadView('barangpdf', compact('data','long','baris','kolom'));
    
       return $pdf->stream('barangBarcode.pdf',array("Attachment" => 0));
        
        //return view('barang.barcodePDF',compact('data','long','baris','kolom'));
    }
    public function getTo(Request $request){
        $to = Barang::where("id_barang",'>=',$request->id)->pluck('id_barang','nama');
        return response()->json($to);
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