<!-- Modal tambah data -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah About</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="{{url('/admabout/store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="judul_about">Judul About</label>
                        <input type="text" class="form-control @error('judul_about') is-invalid @enderror" id ="judul_about" placeholder="Masukkan Judul About" name="judul_about" value="{{ old('judul_about') }}">
                        @error('judul_about') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
					            
                      <div class="form-group">
                                  <label for="exampleFormControlSelect1">Judul Kategori</label>
                                  <select class="form-control @error('id_kategori') is-invalid @enderror" name="id_kategori" id="id_kategori1" onChange="dokumen1()" >
                                  <option value="">--- pilih data ---</option>
                                  @foreach($ktg as $k)
                                  <option value="{{$k->id_kategori}}">{{$loop->iteration}}. {{$k->judul_kategori}}</option>
                                  @endforeach
                                  </select>
                                  @error('id_kategori') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
                      <div class="form-group">
                        <!--<input type="text" class="form-control @error('path_about') is-invalid @enderror" id ="path_about" placeholder="Masukkan Path About" name="path_about" value="{{ old('path_about') }}">-->
                        
                        <div class="upload" id="upload11" style="display:none">
                        <label for="path_about">Upload Gambar Award</label>

                                <div class="item form-group" style="margin-right:-40px;">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align:left; margin-right: -100px;" >Gambar<span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12" style="margin-left:60px;">
                                      <input type="file" id="award" name="award" accept=".png, .jpg, .jpeg">
                                  </div>
                                </div>
                             
                        @error('path_about') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
                      <div class="form-group">
                        <!--<input type="text" class="form-control @error('path_about') is-invalid @enderror" id ="path_about" placeholder="Masukkan Path About" name="path_about" value="{{ old('path_about') }}">-->
                        
                        <div class="upload" id="upload12" style="display:none">
                        <label for="path_about">Upload Gambar Struktur Organisasi</label>
                                <div class="item form-group" style="margin-right:-40px;">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align:left; margin-right: -100px;" >Gambar<span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12" style="margin-left:60px;">
                                      <input type="file" id="struktur" name="struktur" accept=".png, .jpg, .jpeg">
                                  </div>
                                </div>
                        @error('path_about') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
                      <div class="form-group">
                        <!--<input type="text" class="form-control @error('path_about') is-invalid @enderror" id ="path_about" placeholder="Masukkan Path About" name="path_about" value="{{ old('path_about') }}">-->
                        
                        <div class="upload" id="upload13" style="display:none">
                        <label for="path_about">Upload Gambar Tampilan Utama</label>
                                <div class="item form-group" style="margin-right:-40px;">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align:left; margin-right: -100px;" >Gambar<span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12" style="margin-left:60px;">
                                      <input type="file" id="tampilan" name="tampilan" accept=".png, .jpg, .jpeg">
                                  </div>
                                </div>
                        @error('path_about') <div class="invalid-feedback">{{$message}}</div>@enderror
                      </div>
                      </div>
                      <input type="text" hidden class="form-control @error('id_pengguna') is-invalid @enderror" id ="id_pengguna" placeholder="" name="id_pengguna" value="{{ Session::get('id') }}">
					  @error('id_pengguna') <div class="invalid-feedback">{{$message}}</div>@enderror
                      <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    </div>
                  </div>
                </div>
              </div>
              </div>
  <!-- end Modal -->


  <div class="form-group">
                        <label for="nama">Provinsi</label></br>
                        <select id="provinsi" name="provinsi" style="width: 300px;">
                          <option ></option>
                          @foreach ($provinsi as $p)
                            <option value="{{ $p -> id }}">{{$p -> provinsi}}</option>
                          @endforeach
                          </select></br>
                      </div>

                      <div class="form-group">
                        <label for="nama">Kabupaten</label></br>
                        <select id="kabupaten" name="kabupaten" style="width: 300px;">
                          <option ></option>
                          @foreach ($kabupaten as $kab)
                            @if ($kab->provinsi_id > 1 )
                            <option value="{{ $kab -> id }}">{{$kab -> kabupaten_kota}}</option>
                            @endif
                          @endforeach
                          </select></br>
                      </div>

                      <div>
                          <video autoplay="true" id="video-webcam">
                              Browsermu tidak mendukung bro, upgrade donk!
                          </video>
                          <button onclick="takeSnapshot()">Ambil Gambar</button>
                      </div>