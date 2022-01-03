<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class C_scoreboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/scoreboard-v',['x'=>'scoreboard']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sse(){
        $scoreboard = DB::table('scoreboard')->get();
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $array = array(
          'name_home' => $scoreboard[0]->name_home,
          'name_away' => $scoreboard[0]->name_away,
          'home' => $scoreboard[0]->score_home,  
          'away' => $scoreboard[0]->score_away,  
          'status' => $scoreboard[0]->status_timer,  
          'menit' => $scoreboard[0]->menit,  
          'detik' => $scoreboard[0]->detik,  
          'foul_home' => $scoreboard[0]->foul_home,  
          'foul_away' => $scoreboard[0]->foul_away,  
        );
        //$time = date('r');
        echo "data:".json_encode($array).PHP_EOL;
        echo "retry: 1000".PHP_EOL;
        echo PHP_EOL;
        ob_end_flush();
        flush();
    }
    public function console()
    {
        $data = '';
        $scoreboard = DB::table('scoreboard')->get();
        //dd($scoreboard);
        return view('/scoreboard-c',compact('data','scoreboard'),['x'=>'console']);
    }
    public function updateHomeName(Request $request){
        DB::table('scoreboard')->update([
            'name_home'=> $request->name
        ]);
        $data = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateHomeFoul(Request $request){
        DB::table('scoreboard')->update([
            'foul_home'=> $request->value
        ]);
        $data['foul'] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateAwayFoul(Request $request){
        DB::table('scoreboard')->update([
            'foul_away'=> $request->value
        ]);
        $data['foul'] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateAwayName(Request $request){
        DB::table('scoreboard')->update([
            'name_away'=> $request->name
        ]);
        $data = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateAwayScore(Request $request){
        DB::table('scoreboard')->update([
            'score_away'=> $request->name
        ]);
        $data["score"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateHomeScore(Request $request){
        DB::table('scoreboard')->update([
            'score_home'=> $request->name
        ]);
        $data["score"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateHomeStatus(Request $request){
        DB::table('scoreboard')->update([
            'status_timer'=> $request->status
        ]);
        $data["status"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function updateTimer(Request $request){
        DB::table('scoreboard')->update([
            'menit'=> $request->menit,
            'detik'=> $request->detik
        ]);
        $data["status"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function update_menit_detik(Request $request){
        DB::table('scoreboard')->update([
            'menit' => $request->input('name_menit'),
            'detik' => $request->input('name_detik')  
       ]);

       return response()->json(
        [
          'success' => true,
          'message' => 'Data inserted successfully'
        ]);
    }
    public function resetHomeScore(Request $request){
        DB::table('scoreboard')->update([
            'score_home'=> 0
        ]);
        $data["score"] = DB::table('scoreboard')->get();
        return response()->json($data);
    }
    public function resetAwayScore(Request $request){
        DB::table('scoreboard')->update([
            'score_away'=> 0
        ]);
        $data["score"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function resetHomeFoul(Request $request){
        DB::table('scoreboard')->update([
            'foul_home'=> 0
        ]);
        $data["foul"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
    }
    public function resetAwayFoul(Request $request){
        DB::table('scoreboard')->update([
            'foul_away'=> 0
        ]);
        $data["foul"] = DB::table('scoreboard')->get();
        //dd($data);
        return response()->json($data);
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
        //
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