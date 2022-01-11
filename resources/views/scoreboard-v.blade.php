@extends('layout/master')
@section('title','Scoreboard')
@section('content')
<style>
#clockdiv{
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
}
#clockdiv > div{
    padding: 10px;
    border-radius: 3px;
    background: #ABABAB;
    display: inline-block;
}
#clockdiv div > span{
    padding: 15px;
    border-radius: 3px;
    background: #313131;
    display: inline-block;
}
.smalltext{
    padding-top: 5px;
    font-size: 16px;
}
input { 
    text-align: center; 
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Content Body place -->
<h1 class="text-center font-weight-bold text-capitalize">Scoreboard</h1>
<div class="container text-center">
<div id="clockdiv">
    <!-- <div>
        <span class="days"></span>
        <div class="smalltext">Days</div>
    </div> -->
    <!-- <div>
        <span class="hours"></span>
        <div class="smalltext">Hours</div>
    </div> -->
    <!-- <div class="timer"></div> -->
    <div>
        <span class="minutes" id="timer_menit"></span>
        :
        <span class="seconds" id="timer_detik"></span>
    </div>
</div>
<!-- <div class="timer"></div>
  <div class="twodigit" style="color:red; font-size:25px;" id="timer_menit">09</div>
  <div class="nexttwodigit" style="color:red; font-size:25px;" id="timer_detik">59</div> -->
</div>
<br>
    
<div class="row text-center">
    <div class="col-lg-12">
        <div class="home py-3" id="period_"></div>
        <input class="score" type="number" id="period" width="20" hidden/>
    </div>
    <div class="col-lg-5">
        <div class="home py-3" id="name_home"></div>
        <input class="score" type="number" id="home" width="20" disabled/>
    </div>
    <div class="col-lg-2 spasi"></div>
    <div class="col-lg-5">
        <div class="home py-3 " id="name_away"></div>
        <input class="score" type="number" id="away" width="20" disabled/>
    </div>
</div>
<div class="row text-center">
    <div class="col-lg-5">
        <div class="home py-3">Foul</div>
        <input class="score" type="number" id="foul_home" width="20" disabled/>
    </div>
    <div class="col-lg-2 spasi"></div>
    <div class="col-lg-5">
        <div class="home py-3">Foul</div>
        <input class="score" type="number" id="foul_away" width="20" disabled/>
    </div>
</div>
<div class="test" id="timer" style="color:white;"></div>




@section('script')     
    <script>
    var stop;
    var menit;
    var detik;
    //sse
        if(typeof(EventSource) !== "undefined") {
        var source = new EventSource("/scoreboard-sse");
            source.onmessage = function(event) {
            console.log(event.data);
            $val = JSON.parse(event.data);
            console.log($val.status);
            document.getElementById("period").value= $val.period;
            document.getElementById("home").value= $val.home;
            document.getElementById("name_home").innerHTML= 'Score Tim '+ $val.name_home;
            document.getElementById("foul_home").value= $val.foul_home;
            document.getElementById("foul_away").value= $val.foul_away;
            document.getElementById("away").value= $val.away;
            document.getElementById("name_away").innerHTML= 'Score Tim '+ $val.name_away;
            document.getElementById('timer_menit').innerHTML = $val.menit;
            document.getElementById('timer_detik').innerHTML = $val.detik;
            document.getElementById('timer').innerHTML = $val.menit + ":" + $val.detik;
                //time
                if($val.status==1){
                    startTimer();
                    function startTimer() {
                    // console.log('masuk startimer');
                            var presentTime = document.getElementById('timer').innerHTML;
                            var timeArray = presentTime.split(/[:]+/);
                            var m = timeArray[0];
                            var s = checkSecond((timeArray[1] - 1));
                            if(s==59){m=m-1}
                            if(m<0){
                                if(data_json[0].menit==0 && data_json[0].detik==00){
                                    var audio4 = document.getElementById("audio4");
                                    audio4.play();
                                    console.log('timer completed');
                                }
                                // console.log(stop);
                            }
                            else{
                                // document.getElementById('timer').innerHTML =
                                // m + ":" + s;
                                menit = m;
                                detik = s;
                                insert_menit_detik();
                                console.log(m);
                                console.log(s);
                                setTimeout(startTimer, 1000*1000);
                            }
                        }
                        function checkSecond(sec) {
                                if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
                                if (sec < 0) {sec = "59"};
                                return sec;
                        }
                }
            }
            
        } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
        }
    function insert_menit_detik(){
                // console.log(menit);
                // console.log(detik);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            var url = "{{ url('/update-menit-detik') }}";
            $.ajax({
            url:url,
            method:'POST',
            data:{
                name_menit:menit, 
                name_detik:detik, 
            },
            success:function(response){
                if(response.success){
                    // console.log(response.message);
                }else{
                    alert("Error")
                }
            },
            error:function(error){
                console.log(error)
            }
            });
    }
    </script>
@endsection
                      
@endsection