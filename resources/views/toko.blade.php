@extends('layout/master')
@section('title','Kunjungan Toko')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
  <div class="col">
    <!-- tambah data-->
    <h2 class="text-center">Toko</h2>

<!-- Page Heading -->
<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal">Scan</button>
&nbsp;
<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modaltoko">Tambah Toko</button>
<hr />

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Toko
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th><center>Barcode<center></th>
                                                <th>Nama</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Accuracy</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th><center>Barcode<center></th>
                                                <th>Nama</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Accuracy</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @forelse($toko as $t)
                                                <tr>
                                                @php
                                                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                @endphp
                                                <td align="center"><img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($t->id_toko, $generatorPNG::TYPE_CODE_128)) }}"><br>
                                                {{$t->id_toko}}
                                                <!--<embed src="{{ asset('storage/prak_snapshot.pdf')}}" width="100" height="100"style=margin-left:auto;margin-right:auto />-->
                                                </td>
                                                <td>{{$t->nama_toko}}</td>
                                                <td>{{$t->latitude}}</td>
                                                <td>{{$t->longitude}}</td>
                                                <td>{{$t->accuracy}}</td>
                                                <td><a class="btn btn-outline-success" href="{{url('toko/cetak/'. $t->id_toko)}}">Cetak PDF</a></td>
                                                </tr>
                                            @empty
                                            <div class="alert alert-danger">
                                                        Data Barang belum Tersedia.
                                            </div>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

<!--Modal -->
<div class="modal fade" id="modal" tabindex="-2" role="dialog" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Scan</h5>
                    </div>
                    <div class="modal-body">
                    <div class="card card-default">
                    <div class="row">
                        <div class="col-md-7">
                            <main class="wrapper" style="padding-top:2em">
                                <section class="container" id="demo-content">
                                    <div>
                                        <video id="video" width="300" height="225" style="border: 1px solid gray"></video>
                                    </div>                    
                                    <div id="sourceSelectPanel" style="display:none">
                                        <label for="sourceSelect">Change video source:</label>
                                        <select id="sourceSelect" style="max-width:400px">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success" id="startButton">Start</button>
                                        <button type="button" class="btn btn-success" id="resetButton">Reset</button>
                                    </div>
                                        <br>
                                        <label>Result:</label>
                                        <pre><code id="result"></code></pre>

                                        </section>
                                    </main>
                                </div>
                                <div class="col-md-5">
                                    <div class="hasil" style="margin-top:15px;margin: left 10px;">
                                    <!--<form action="{{ url('/scan-kunjungan-toko/hasil') }}" method="post">
                                    @csrf-->
                                        <div class="form-group">
                                            <label>Barcode ID:</label>
                                            <input type="text" class="form-control barcode" id="barcode" placeholder="Hasil Barcode" name="barcode">
                                        </div>
                                        <div class="form-group">
                                            <label>Latitude Toko :</label>
                                            <input type="text" class="form-control" id="latitude_toko" placeholder="Hasil Barcode" name="barcode" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>longtitude Toko:</label>
                                            <input type="text" class="form-control" id="longitude_toko" placeholder="Hasil Barcode" name="barcode" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Accuracy Toko :</label>
                                            <input type="text" class="form-control" id="accuracy_toko" placeholder="Hasil Barcode" name="barcode" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Latitude:</label>
                                            <input type="text" class="form-control" id="latitude" placeholder="Latitude" name="latitude" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Longitude:</label>
                                            <input type="text" class="form-control" id="longitude" placeholder="Longitude" name="longitude" value="">
                                        </div>
                                        <a class="btn btn-success" id="" href="#" onclick="getLocation()">Generate Location</a>
                                        <button class="btn btn-primary" onclick="hasilJarak()">Submit</button>
                                    <!--</form>-->
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="resetButton" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Modal tambah -->
<div class="modal fade" id="modaltoko" tabindex="-2" role="dialog" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Toko</h5>
                    </div>
                    <div class="modal-body">
                    <form autocomplete='off' action="{{ url('/toko/store') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="nama_toko">Nama Toko</label>
                            <input type="text" class="form-control" id="nama_toko" placeholder="" name="nama_toko" required>
                        </div>
                        <div class="form-group">
                            <label for="latitude">latitude</label>
                            <input type="text" class="form-control" id="lat" placeholder="" name="lat" required>
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="long" placeholder="" name="long" required>
                        </div>
                        <div class="form-group">
                            <label for="accuracy">Accuracy</label>
                            <input type="number" class="form-control" id="accuracy" placeholder="" name="accuracy" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        &nbsp;
                        <a href="http://www.google.com/maps" target="_blank" class="btn btn-secondary">Geolocation</a>
                        &nbsp;
                        <a class="btn btn-success" id="" href="#" onclick="getLocation2()">Generate Location</a>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




                @section('script')     
                <script type="text/javascript" src="https://unpkg.com/@zxing/library@0.18.3-dev.7656630/umd/index.js"></script>
                <script type="text/javascript">

                $('#from').change(function(){
                        var id = $(this).val(); 
                        console.log(id);   
                        if(id){
                            $.ajax({
                            type:"GET",
                            url:"/getto?id="+id,
                            dataType: 'JSON',
                            success:function(res){               
                                if(res){
                                    $("#to").empty();
                                    $("#to").append('<option>---Pilih Data---</option>');
                                    $.each(res,function(nama,kode){
                                        $("#to").append('<option value="'+kode+'">'+kode+' - '+nama+'</option>');
                                    });
                                }else{
                                $("#to").empty();
                                }
                            }
                            });
                        }else{
                            $("#to").empty();
                        }      
                    });

                    window.addEventListener('load', function () {
                    let selectedDeviceId;
                    const codeReader = new ZXing.BrowserMultiFormatReader()
                    console.log('ZXing code reader initialized')
                    codeReader.listVideoInputDevices()
                        .then((videoInputDevices) => {
                        const sourceSelect = document.getElementById('sourceSelect')
                        selectedDeviceId = videoInputDevices[0].deviceId
                        if (videoInputDevices.length >= 1) {
                            videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            sourceSelect.appendChild(sourceOption)
                            })

                            sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                            };

                            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                            sourceSelectPanel.style.display = 'block'
                        }

                        document.getElementById('startButton').addEventListener('click', () => {
                            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                            if (result) {
                                console.log(result)
                                document.getElementById('result').textContent = result.text
                            }
                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                console.error(err)
                                document.getElementById('result').textContent = err
                            }
                            })
                            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                        })

                        document.getElementById('resetButton').addEventListener('click', () => {
                            codeReader.reset()
                            document.getElementById('result').textContent = '';
                            console.log('Reset.')
                        })

                        })
                        .catch((err) => {
                        console.error(err)
                        })
                    })
                
                    var latitude_toko;
                    var longitude_toko;
                    var accuracy_toko;
                    function getDataLocation($id_toko){
                                    var id_toko = $id_toko;
                                    $.ajax({
                                        url: "{{ url('/toko/getLocationToko') }}",
                                        type: "POST",
                                        data: {
                                            idtoko: id_toko,
                                            _token: '{{csrf_token()}}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {
                                            $.each(result.location, function (key, value) {
                                                longitude_toko = value.longitude;
                                                latitude_toko = value.latitude;
                                                accuracy_toko = value.accuracy;
                                            });
                                            document.getElementById('latitude_toko').value = latitude_toko;
                                            document.getElementById('longitude_toko').value = longitude_toko;
                                            document.getElementById('accuracy_toko').value = accuracy_toko;
                                        }
                                    });
                    }
                        </script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script>
                    var x = document.getElementById("latitude");
                    var y = document.getElementById("longitude");
                    var jarak;
                    var latitude_user;
                    var longitude_user;
                    var accuracy_user;
                    function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        x.value = "Geolocation is not supported by this browser.";
                        y.value = "Geolocation is not supported by this browser.";
                    }
                    }
                    function showPosition(position) {
                    x.value = position.coords.latitude;
                    y.value = position.coords.longitude;
                    accuracy_user = position.coords.accuracy;
                    latitude_user = position.coords.latitude;
                    longitude_user = position.coords.longitude;
                    }
                    
                    //menghitung Jarak 2 lokasi
                    function hasilJarak(){
                    console.log(latitude_toko,longitude_toko,latitude_user,longitude_user);
                    //function perhitungan 2 jarak
                    jarak = getDistanceFromLatLonInKm(latitude_toko,longitude_toko,latitude_user,longitude_user);
                    console.log(jarak);
                    //menghitung accuracy
                    rata_accuracy();
                    //hasil output akhir
                    kesimpulan();
                    }
                    function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
                        var R = 6371; // Radius of the earth in km
                        var dLat = deg2rad(lat2-lat1); // deg2rad below
                        var dLon = deg2rad(lon2-lon1);
                        var a =
                        Math.sin(dLat/2) * Math.sin(dLat/2) +
                        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                        Math.sin(dLon/2) * Math.sin(dLon/2)
                        ;
                        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                        var d = R * c * 1000; // Distance in m
                        return d;
                        }
                        
                        function deg2rad(deg) {
                        return deg * (Math.PI/180)
                        }
                        function rata_accuracy(){
                            //menambahkan accuracy toko dengan accuracy user
                        var hassil = accuracy_toko+accuracy_user;
                        result_acc = hassil/2;
                        console.log("rata-rata akurasi : ");
                        console.log(result_acc);
                        }
                        function kesimpulan(){
                            if(jarak<=result_acc){
                            alert("Success Anda berada di toko success");
                            }
                            else{
                            alert("Maaf! Anda tidak berada di toko error");
                            }
                        }
                        
                        var a = document.getElementById("lat");
                        var b = document.getElementById("long");
                        function getLocation2() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition2);
                        } else {
                            a.value = "Geolocation is not supported by this browser.";
                            b.value = "Geolocation is not supported by this browser.";
                        }
                        }
                        function showPosition2(position) {
                        a.value = position.coords.latitude;
                        b.value = position.coords.longitude;
                        accuracy_user = position.coords.accuracy;
                        latitude_user = position.coords.latitude;
                        longitude_user = position.coords.longitude;
                        }

                    </script>
                
                

                @endsection
                      
@endsection