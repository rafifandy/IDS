@extends('layout/master')
@section('title','Label Barang')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
  <div class="col">
    <!-- tambah data-->
    <h2 class="text-center">Barang</h2>

<!-- Page Heading -->
<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal">Scan</button>
&nbsp;
<button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#pdf">Cetak Barcode</button>
&nbsp;
<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalbarang">Tambah Barang</button>
<hr />

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Barang
                                </div>
                                @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                @endif
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Id Barang</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th><center>Barcode<center></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id Barang</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th><center>Barcode<center></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($barang as $b)
                                        <tr role="row" class="odd">
                                            <td>{{$b->id_barang}}</td>
                                            <td>{{$b->nama}}</td>
                                            <td>{{$b->timestamp}}</td>
                                            @php
                                                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            @endphp
                                            <td align="center"><img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($b->id_barang, $generatorPNG::TYPE_CODE_128)) }}"><br>
                                            {{$b->id_barang}}
                                            <!--<embed src="{{ asset('storage/prak_snapshot.pdf')}}" width="100" height="100"style=margin-left:auto;margin-right:auto />-->
                                            </td>
                                            <!--<td>
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal{{$b->id_barang}}">Edit</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$b->id_barang}}">Delete</button>
                                            </td>-->
                                        </tr>
                                        @endforeach
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
                    <main class="wrapper" style="padding-top:2em">

                        <section class="container" id="demo-content">
                        <h1 class="title">Scan Code from Video Camera</h1>

                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="startButton">Start</button>
                            <button type="button" class="btn btn-success" id="resetButton">Reset</button>
                        </div>

                        <div>
                            <video id="video" width="300" height="200" style="border: 1px solid white"></video>
                        </div>

                        <div id="sourceSelectPanel" style="display:none">
                            <label for="sourceSelect">Change video source:</label>
                            <select id="sourceSelect" style="max-width:400px">
                            </select>
                        </div>

                        <label>Result:</label>
                        <pre><code id="result"></code></pre>


                        </section>
                    </main>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="resetButton" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pdf" tabindex="-2" role="dialog"  data-bs-backdrop="static" aria-labelledby="pdfLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="pdfLabel">Export PDF</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/barang/cetak') }}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="baris_barang">Baris</label>
                        <input type="number" class="form-control" id="baris_barang" placeholder="baris Barang" name="baris_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kolom_barang">Kolom</label>
                        <input type="number" class="form-control" id="kolom_barang" placeholder="kolom Barang" name="kolom_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="jml_barang">Jumlah</label>
                        <input type="number" class="form-control" id="jml_barang" placeholder="jumlah cetak" name="jml" required>
                    </div>
                    <div class="form-group">
                         <label  class="form-label">From</label>
                          <select class="form-select form-select-lg" name="from" id="from">
                            <option selected>---Pilih Data---</option>
                            @foreach ($barang as $b)
                                <option  value="{{$b->id_barang}}">{{$b->id_barang}} - {{$b->nama}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label  class="form-label">To</label>
                          <select class="form-select form-select-lg" name="to" id="to">
                            <option selected>---Pilih Data---</option>
                          </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </form>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Modal tambah -->
<div class="modal fade" id="modalbarang" tabindex="-2" role="dialog" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    </div>
                    <div class="modal-body">
                    <form autocomplete="off" method="post" action="{{ url('/barang/store') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id ="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama') <div class="invalid-feedback">{{$message}}</div>@enderror
                       </br>
                      <button type="submit" class="btn btn-primary">Tambah Data</button>
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
                </script>

                @endsection
                      
@endsection