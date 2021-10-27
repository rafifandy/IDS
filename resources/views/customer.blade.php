@extends('layout/master')
@section('title','Customer')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
  <div class="col">
    <!-- tambah data-->
    <h2 class="text-center">Customer</h2>
    
    <!-- Page Heading -->
    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalBlob">Tambah Customer</button>
    <hr/>
    <!--
    <button class="btn btn-success" onClick="oncam2()" type="button" data-bs-toggle="modal" data-bs-target="#modalPath">Tambah Customer - Path</button>
    -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Customer
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id Customer</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>Foto</th>
                        <th>Path</th>
                        <th>Opsi</th>
                        <th>Test</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id Customer</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>Foto</th>
                        <th>Path</th>
                        <th>Opsi</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($customer as $c)
                <tr role="row" class="odd">

                    @if ($c->id_cust < 10)
                    <td>C000000{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 100)
                    <td>C00000{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 1000)
                    <td>C0000{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 10000)
                    <td>C000{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 100000)
                    <td>C00{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 1000000)
                    <td>C0{{$c->id_cust}}</td>
                    @elseif ($c->id_cust < 10000000)
                    <td>C{{$c->id_cust}}</td>
                    @endif

                    <td>{{$c->nama}}</td>
                    <td>{{$c->alamat}}, {{$c->kelurahan->kelurahan}}, {{$c->kelurahan->kecamatan->kecamatan}}, {{$c->kelurahan->kecamatan->kabupaten->kabupaten_kota}}, {{$c->kelurahan->kecamatan->kabupaten->provinsi->provinsi}}</td>
                    <td>{{$c->kelurahan->kd_pos}}</td>
                    <td>
                    @if(str_starts_with($c->foto,'data'))
                    <img src="{{ $c->foto }}" height="150" width="200">
                    @endif
                    </td>
                    <td>
                    @if($c->path != null)
                    <img src="{{ asset('storage/'.$c->path) }}" height="150" width="200">
                    @endif
                    </td>
                    <td>
                    <!--<embed src="{{ asset('storage/prak_snapshot.pdf')}}" width="100" height="100"style=margin-left:auto;margin-right:auto />-->
                    </td>
                    <!--<td>
                    <button class="btn btn-success" data-toggle="modal" data-target="#editModal{{$c->id_cust}}">Edit</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$c->id_cust}}">Delete</button>
                    </td>-->
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal Blob-->
<div class="modal fade" id="modalBlob" tabindex="-2" role="dialog" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                    </div>
                    <div class="modal-body">
                    <form autocomplete="off" method="post" action="{{ url('/customer/store') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="nama">Nama Customer</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id ="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
                      <div class="form-group">
                        <label for="nama">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id ="alamat" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>

                      <div class="form-group">
                         <label  class="form-label">Provinsi</label>
                          <select class="form-select form-select-lg" name="provinsi" id="provinsi">
                            <option selected>---Pilih Provinsi---</option>
                            @foreach ($provinsi as $p)
                                <option  value="{{$p->id}}">{{$p->provinsi}}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                        <label  class="form-label">Kabupaten</label>
                          <select class="form-select form-select-lg" name="kabupaten" id="kabupaten">
                            <option selected>---Pilih Kabupaten---</option>
                          </select>
                      </div>

                      <div class="form-group">
                        <label  class="form-label">Kecamatan</label>
                          <select class="form-select form-select-lg" name="kecamatan" id="kecamatan">
                            <option selected>---Pilih Kecamatan---</option>
                          </select>
                      </div>
                  
                      <div class="form-group">
                        <label  class="form-label">Kelurahan</label>
                          <select class="form-select form-select-lg" name="id_kel" id="kelurahan">
                            <option selected>---Pilih Kelurahan---</option>
                          </select>
                      </div>

                      <div class="form-group">
                            <button type="button" class="btn btn-success" onClick="oncam()">Start</button>
                            <button type="button" class="btn btn-success" onClick="offcam()">Reset</button>
                      </div>

                      <div class="row">
                        <div class="col-6">
                            <div class="col-2" id="my_camera"></div></br>
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="foto" class="image-tag">
                            <!-- <br/> -->
                        </div>
                        <div id="sourceSelectPanel" style="display:none">
                            <label for="sourceSelect">Change video source:</label>
                            <select id="sourceSelect" style="max-width:400px">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                    </div>
                      </br>
                      <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" onClick="offcam()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>   

<!--         -->
  @section('script')
      <script type="text/javascript">
      //console.log(5);
      

      $('#provinsi').change(function(){
        var id = $(this).val(); 
        //console.log(id);   
        if(id){
            $.ajax({
              type:"GET",
              url:"/getkabupaten?id="+id,
              dataType: 'JSON',
              success:function(res){               
                if(res){
                    $("#kabupaten").empty();
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                    $("#kabupaten").append('<option>---Pilih Kabupaten---</option>');
                    $("#kecamatan").append('<option>---Pilih Kecamatan---</option>');
                    $("#kelurahan").append('<option>---Pilih Kelurahan---</option>');
                    $.each(res,function(nama,kode){
                        $("#kabupaten").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $("#kabupaten").empty();
                  $("#kecamatan").empty();
                  $("#kelurahan").empty();
                }
              }
            });
        }else{
            $("#kabupaten").empty();
            $("#kecamatan").empty();
            $("#kelurahan").empty();
        }      
      });

      $('#kabupaten').change(function(){
        var id = $(this).val(); 
        //console.log(id);   
        if(id){
            $.ajax({
              type:"GET",
              url:"/getkecamatan?id="+id,
              dataType: 'JSON',
              success:function(res){               
                if(res){
                    $("#kecamatan").empty();
                    $("#kelurahan").empty();
                    $("#kecamatan").append('<option>---Pilih Kecamatan---</option>');
                    $("#kelurahan").append('<option>---Pilih Kelurahan---</option>');
                    $.each(res,function(nama,kode){
                        $("#kecamatan").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $("#kecamatan").empty();
                  $("#kelurahan").empty();
                }
              }
            });
        }else{
            $("#kecamatan").empty();
            $("#kelurahan").empty();
        }      
      });
    
      $('#kecamatan').change(function(){
        var id = $(this).val(); 
        //console.log(id);   
        if(id){
            $.ajax({
              type:"GET",
              url:"/getkelurahan?id="+id,
              dataType: 'JSON',
              success:function(res){               
                if(res){
                    $("#kelurahan").empty();
                    $("#kelurahan").append('<option>---Pilih Kelurahan---</option>');
                    $.each(res,function(nama,kode){
                        $("#kelurahan").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $("#kelurahan").empty();
                }
              }
            });
        }else{
            $("#kelurahan").empty();
        }      
      });
      
      function oncam(){
      Webcam.set({
          //sourceId: 1,
          width: 300,
          height: 225,
          image_format: 'png',
          jpeg_quality: 90,
          facingMode: "environment"
      });

      Webcam.attach( '#my_camera' );
      }
      
      function offcam(){
        Webcam.reset();
      }
          function take_snapshot() {
              Webcam.snap( function(data_uri) {
                  $(".image-tag").val(data_uri);
                  document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
              } );
          }
      
      /*
      
      */
    </script>
  @endsection
                      
@endsection