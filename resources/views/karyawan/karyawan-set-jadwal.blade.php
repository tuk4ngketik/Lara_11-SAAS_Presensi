
@extends('layout')
@section('title-web', 'Karyawan')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Karyawan  &nbsp > &nbsp  Jadual
@endsection
@section('nav-item-karyawan', 'menu-open') 
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-jadwal', 'active')  

@section('content')

<div class="card">
    <div class="card-body">  
          <h5>Buat Jadwal Karyawan</h5>
          <div class="p-3"></div>
               

          <div class="row">
            <!-- Left -->
            <div class="col-sm-8">  
                <form action="{{url('/karyawan-set-jadwal-act')}}"  method="post" id="form">
                  @csrf
                    
                  <div class="form-floating mb-3">
                    <input type="" value="{{$karyawan['nama_karyawan']}}" disabled="disabled" class="form-control" id="floatingInput" >
                    <label for="floatingInput">Nama Karywan</label>  
                  </div> 

                  <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3"> 
                          <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" value="{{old('tgl_awal')}}">
                          <label for="floatingInput">Tanggal Awal</label>
                          <div class="text text-danger tgl_awal"></div>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                          <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="{{old('tgl_akhir')}}">
                          <label for="floatingInput">Tanggal Akhir</label> 
                          <div class="text text-danger tgl_akhir"></div>
                        </div>
                    </div>
                  </div> 

                  <div class="form-floating">    
                    <select name="lokasi_kerja" id="id_lokasi" class="form-control"> 
                                  <option value="">-- Pilih lokasi Kerja --</option>
                                  <option value="0" @selected( old('lokasi_kerja') == "0")>Tidak ditentukan</option> 
                                  @foreach($lokasi as  $v) 
                                    <!-- <option value="{{$v->id_lokasi}}" @selected($karyawan['id_lokasi'] = $v->id_lokasi)>{{$v->nama_lokasi}}</option> -->
                                    <option value="{{$v->id_lokasi}}" @selected( old('lokasi_kerja') == $v->id_lokasi)>{{$v->nama_lokasi}}</option>
                                  @endforeach
                      </select>
                    <label for="floatingPassword">Lokasi Kerja</label>
                    <div class="text text-danger lokasi_kerja"></div>
                  </div>
                  <br>

                  <div class="form-floating">      
                    <select name="waktu_kerja"  class="form-control"> 
                                  <option value="">-- Pilih Jam Kerja --</option>
                                  <option value="0"  @selected( old('waktu_kerja') == "0")>Tidak ditentukan</option> 
                                  @foreach($waktu as  $v) 
                                  <option value="{{$v->id_waktu}}" @selected( old('waktu_kerja') == $v->id_waktu)>Shift: {{$v->shift}}  (  {{$v->masuk}} -  {{$v->pulang}} )</option>
                                  @endforeach
                      </select>
                    <label for="floatingPassword">Waktu Kerja</label>
                    <div class="text text-danger waktu_kerja"></div>
                            
                  </div>

                  <br>
                  <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="{{$id_perusahaan}}" />
                  <input type="hidden" name="id_karyawan" id="id_karyawan" value="{{$id_karyawan}}" />
                  <button class="btn btn-outline-primary" type="submit" >Kirim</button> &nbsp
                  <a class="btn btn-outline-info" href="{{url('karyawan')}}">Batal</a> 

                </form> 
            </div>
            <!-- Left -->

            <!-- Right -->
            <div class="col-sm-4">
              <h5>Right</h5>
               
            </div>

          </div>


  </div>
</div> 

<script>
  
  const inputs = [
      'id_karyawan','id_perusahaan', 'tgl_awal', 'tgl_akhir', 'lokasi_kerja', 'waktu_kerja' 
     ]  
    $('#form').submit(function(e) { 
        e.preventDefault();
        _cursorWait();  
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("karyawan-jadwal")}}', inputs);  
    });
</script>

@endsection 
 