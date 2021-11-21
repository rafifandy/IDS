<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Customer;
use App\Exports\E_customer;
use App\Imports\I_customer;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class C_customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kabupaten = Kabupaten::all();
        $provinsi = Provinsi::all();
        $count = Customer::count();
        return view('/customer',compact('customer','kelurahan','kecamatan','kabupaten','provinsi','count'),['x'=>'customer']);
    }
    public function getKabupaten(Request $request){
        $kabupaten = Kabupaten::where("provinsi_id",$request->id)->pluck('id','kabupaten_kota');
        return response()->json($kabupaten);
    }
    public function getKecamatan(Request $request){
        $kecamatan2 = Kecamatan::where("kabkot_id",$request->id)->pluck('id','kecamatan');
        return response()->json($kecamatan2);
    }
    public function getKelurahan(Request $request){
        $kelurahan2 = Kelurahan::where("kecamatan_id",$request->id)->pluck('id','kelurahan');
        return response()->json($kelurahan2);
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
    public function store2(Request $request)
    {
        $request->validate([
            //'id_kategori' => 'required|unique:kategori_about|size:10',
            'nama' => 'required|max:100',
            'alamat' => 'required|max:100',
            'foto' => 'required',
            //'path' => '',
            'id_kel' => 'required|max:20',
        ]);
        Customer::create($request->all());
        return redirect('/customer')->with('status','Data Berhasil Ditambahkan!!!'); 
    }
    public function store(Request $request)
    {
        $request->validate([
            //'id_kategori' => 'required|unique:kategori_about|size:10',
            'nama' => 'required|max:100',
            'alamat' => 'required|max:100',
            'foto' => 'required',
            //'path' => 'required',
            'id_kel' => 'required|max:20',
        ]);
        $img = str_replace('data:image/png;base64,','', $request->foto);
        $img = str_replace(' ','+', $img);
        $imgname = $request->nama.time().'.png';
        Storage::disk('local')->put($imgname, base64_decode($img));
        Customer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
            'path' => $imgname,
            'id_kel' => $request->id_kel,
        ]);
        return redirect('/customer')->with('status','Data Berhasil Ditambahkan!!!'); 
    }

    public function export()
	{
		return Excel::download(new E_customer, 'cust.xlsx');
	}

    public function import(Request $request)
    {
        // validasi
		$this->validate($request, [
			'excel' => 'required|mimes:xls,xlsx'
		]);
        if($request->excel){
               // menangkap file excel
                $file = $request->file('excel')->store('import');
                // import data
                $import = new I_customer;
                $import->import($file);
                //dd($import->failures());
                if($import->failures()) {
                    return back()->withFailures($import->failures());
                }
                File::delete($files);
                //dd($import->errors());
                //(new CustomerImport)->import($file);
                // alihkan halaman kembali
                //return back()->withStatus('file excel is success imported');
        }
    }
    public function import2(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('excel',$nama_file);
 
		// import data
		Excel::import(new I_customer, public_path('/excel/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/customer');
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