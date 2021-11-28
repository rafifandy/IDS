<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\buku;
use Validator;

class C_buku extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::latest()->get();
        //dd($customer);
        return response()->json([
            'success' => true,
            'message' => 'List Buku',
            'data' => $buku,
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'author' => 'required',
         ]);
         if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
         }
         $buku = buku::create([
            'nama' => $request->nama,
            'author' => $request->author,
        ]);
        if($buku) {
            return response()->json([
               'success' => true,
               'message' => 'Buku Created',
               'data'    => $buku
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Buku create failed',
             ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrfail($id);
        if($buku){
            return response()->json([
                'success' => true,
                'messege' => 'List Buku',
                'data' => $buku,
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data Not Found',
                
            ],404);
        }
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
        $validator = Validator::make($request->all(), [
            //'nama' => 'required',
            //'author' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $buku = Buku::findOrfail($id);
        if($buku){
            $buku->update([
                'nama' => $request->nama,
                'author' => $request->author,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Buku Updated',
                'data' => $buku
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Buku Not Updated',
                
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrfail($id);
        if($buku){
            $buku->delete();
            return response()->json([
                'success' => true,
                'message' => 'Buku Deleted',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Buku Not Deleted',
                
            ],404);
        }
    }
}
