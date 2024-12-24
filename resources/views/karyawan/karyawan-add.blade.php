
@extends('layout')
@section('title-web', 'Tambah Karyawan')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Karyawan
@endsection
@section('nav-item-karyawan', 'menu-open') 
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-add', 'active') 

@section('content')
 

<div class="card">
    <div class="card-body"> 
        
            <div class="p-3"> 
                <div class="float-start"><h5>Tambah Karyawan</h5></div> 
            </div> <br>
            <div class="float-none"></div>
            <hr><br>

        <form action="{{url('karyawan-act')}}" enctype="multipart/form-data" method="POST" id="form">
        @csrf
        <input type="hidden" name="id_perusahaan"  value="{{$pt['id_perusahaan']}}" placeholder="id_perusahaan" />
        <div class="row">
            <!-- Left     -->
            <div class="col-sm-7">    

                    <!-- id_perusahaan -->
                     <input type="hidden" id="id_perusahaan" value="{{$pt['id_perusahaan']}} ">
                     <div class="row">
                        <div class="col-sm-7">
                                    
                            <div class="mb-3">
                                <label for=""  >Nama karyawan</label>
                                <input name="nama_karyawan" id="nama_karyawan" class="form-control" value="{{old('nama_karyawan')}}"  />
                                <div class="text text-danger nama_karyawan"></div>
                            </div>  

                            <div class="mb-3">
                                <label for=""  >NIK karyawan</label>
                                <input name="nik" id="nik" class="form-control" value="{{old('nik')}}"  />
                                <div class="text text-danger nik"></div>
                            </div> 

                            <div class="mb-3">
                                <label for=""  >Email karyawan</label>
                                <input name="email_karyawan" id="email_karyawan" class="form-control" value="{{old('email_karyawan')}}"   
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        data-bs-title="{{$tooltip['email']}}" />
                                    <div class="text text-danger email_karyawan"></div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label for=""  >Foto karyawan</label> 
                            <div style="height:200px;position: relative;  " class="text-center bg-secondary-subtle p-2"> 
                                 <img src="{{asset('imgs')}}/profil-2.png" class="img-thumbnail rounded" 
                                        id="img_foto" style="max-height:140px;max-width:140px">  
                                    <!-- <img src="{{asset('imgs')}}/profil-2.png" class="img-thumbnail rounded float-end" 
                                        id="img_foto" style="max-height:100px;max-width:100px">  
                                        <canvas  style="max-height:100px;max-width:100px"></canvas>     -->
                                 <br>  
                                 <input type="file" id="foto_karyawan" name="foto_karyawan"   
                                 accept=".jpg,.jpeg,.png" class="form-control" /> 
                             </div> 
                             <div class="text text-danger foto"></div>  
                             <div class="text text-danger foto_karyawan"></div>  
                        </div>
                     </div>
                     
                     <!-- id_department -->
                    <div class="mb-3">
                        <label for=""  >Departemen</label>
                        <select name="nama_department" id="id_department" class="form-control" >
                            <option value="">-- Pilih Departemen --</option>   
                            @foreach($dept as $v)  
                                <option value="{{$v->id_department}}" @selected(old('nama_department') == $v->id_department ) >
                                    {{$v->nama_department}} 
                                </option>
                            @endforeach 
                        </select> 
                        <div class="text text-danger nama_department"></div> 
                    </div> 

                    <!-- id_jabatan -->
                    <div class="mb-3">
                        <label for=""  >Jabatan / Posisi</label>
                        <select name="nama_jabatan" id="" class="form-control" >
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jbt as $v)
                                <option value="{{$v->id_jabatan}}"  @selected(old('nama_jabatan') == $v->id_jabatan ) >{{$v->nama_jabatan}}</option>
                            @endforeach 
                        </select> 
                        <div class="text text-danger nama_jabatan"></div>
                    </div> 
                    
                    <!-- id_divisi -->
                    <div class="mb-3">
                        <label for="" >Divisi</label>
                        <select name="nama_divisi" id="id_divisi" class="form-control" > 
                        </select> 
                        <div class="text text-danger nama_divisi"></div>
                    </div>  
 
                    <div class="mb-3">
                        <label for=""  >Password karyawan</label>
                        <input name="password_karyawan" placeholder="ex: 123456" id="password_karyawan" class="form-control" value="{{old('password_karyawan')}}" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-title="{{$tooltip['password']}}"
                            />
                            <div class="text text-danger password_karyawan"></div>
                    </div>   
            </div>
            <!-- End Left     -->

            <!-- Right     -->
            <div class="col-sm-5">     

                    <div class="mb-3">
                        <label for="">Status Kerja Karyawan</label>
                        <select name="status_karyawan" id="" class="form-control">
                            <option value=""> -- Status kerja karyawan -- </option> 
                            @foreach($stat_karyawans as $v)
                                <option @selected(old('status_karyawan') == $v  ) value='{{$v}}'>  {{$v}} </option>
                            @endforeach 
                        </select> 
                        <div class="text text-danger status_karyawan"></div>
                    </div>  

                    <div class="mb-3">
                        <label for=""  >Tgl bergabung dng perusahaan</label>
                        <input type="date" name="tgl_bergabung" id="tgl_bergabung" class="form-control" value="{{old('tgl_bergabung')}}"  />
                        <div class="text text-danger tgl_bergabung"></div>
                    </div>    
 

                    <div class="mb-3">
                        <label for=""  >Tgl lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{old('tgl_lahir')}}"  />
                        <div class="text text-danger tgl_lahir"></div>
                    </div> 

                    <div class="mb-3">
                        <label for=""  >Tempat Lahir</label>
                        <input name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{old('tempat_lahir')}}"  />
                        <div class="text text-danger tempat_lahir"></div>
                    </div>   

                    <div class="mb-3">
                        <label for=""  >Pendidikan terakhir</label>
                        <select name="pendidikan" id="" class="form-control" >
                            <option value="">-- Pendidikan terakhir --</option>
                            @foreach($pend as $v)
                                <option  @selected(old('pendidikan') == $v->pendidikan ) value="{{$v->pendidikan}}">{{$v->pendidikan}}</option>
                            @endforeach 
                        </select> 
                        <div class="text text-danger pendidikan"></div>
                    </div>   

                    <div class="mb-3">
                        <label for=""  >No. Telp karyawan</label>
                        <!-- <input name="telp_karyawan" id="telp_karyawan" class="form-control" value="{{old('telp_karyawan')}}"  /> live -->
                        <input name="telp_karyawan" id="telp_karyawan" class="form-control" value="08185555001"  />
                        <div class="text text-danger telp_karyawan"></div>
                    </div>     

                    <div class="mb-3">
                        <label for="">Status Pernikahan</label>
                        <select name="status_pernikahan" id="" class="form-control" >
                            <option value="">-- Status Pernikahan--</option> 
                            @foreach($status_pernikahan as $v)
                                <option @selected(old('status_pernikahan') == $v) value='{{$v}}'> {{$v}} </option> 
                            @endforeach  
                        </select> 
                        <div class="text text-danger status_pernikahan"></div> 
                    </div>     

                    <div class="mb-3">
                        <label for="" class="form-label">Alamat karyawan  </label>
                        <textarea  class="form-control"  name="alamat_karyawan"> {{old('alamat_karyawan')}} </textarea>
                        <div class="text text-danger alamat_karyawan"></div>
                    </div> 
            </div>  
            <!-- End Right     -->
        </div>
        
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp
            <a href="{{url('karyawan')}}" class="btn btn-outline-info">Batal</a> 
        </div>   
        </form>

    </div>
</div>  
  
<!--  -->
<!-- Disable sementara -->
<!-- <script src="{{asset('don')}}/js/upload-base64.js"></script>  -->
<!--  -->

<!-- Face recognize --> 
<script src="{{asset('faceapi')}}/face-api.js"></script> 

<script> 
     const inputs = [
                'nama_department','nama_jabatan','nik','nama_karyawan','pendidikan',
                'tgl_lahir','tempat_lahir','telp_karyawan','email_karyawan','password_karyawan',
                'alamat_karyawan','status_karyawan','status_pernikahan','tgl_bergabung', 
                'foto_karyawan'
     ]  
    $('#form').submit(function(e) { 
        e.preventDefault();
        _cursorWait();
        var action = $(this).attr('action'); 
        var formData = new FormData($(this)[0]);
        console.log('formData', formData)
        _submitFromObject(action, formData, '{{url("karyawan")}}', inputs);   
    });
    
    var minConfidence = 0.5; // ambang bentuk wajah, mendekati sempurna 0.9
    var _models = "{{url('facemodels')}}/"  

    $(document).ready( function(){  
        $('#foto_karyawan').change(function(){ 
            _cursorWait();
            console.log('_cursorWait');
            $('.load').show(); // Load Process 
            $('.jumlah-wajah').text('')  
            console.log('minConfidence', minConfidence)
            loadImageFromUpload()
        });
    })
 
    async function loadImageFromUpload() {   
        const imgFile = $('#foto_karyawan').get(0).files[0]
        const img = await faceapi.bufferToImage(imgFile) 
        console.log('aceapi.bufferToImage', img)
        // $('#img-view').attr('width','300')
        $('#img_foto').get(0).src = img.src
        updateResults()
    } 
    async function updateResults() {
        $('#form *').addClass('placeholder-glow');
        await faceapi.loadSsdMobilenetv1Model(_models); 
        console.log('Loading Models ..!!')
        
        const inputImgEl = $('#img_foto').get(0)  
        console.log('3')
        
        const options = new faceapi.SsdMobilenetv1Options({ minConfidence })
        console.log('4. Option ', minConfidence)  

        const results = await faceapi.detectAllFaces(inputImgEl,  options ) // OK
        // const results = await faceapi.detectAllFaces(inputImgEl) OK Tanpa score
        // console.log('results', results)
        console.log('5')  

        let jum = results.length;
        console.log('jumlah wajah: ', jum); 
        $(results).each(function(i){
            console.log('log:', i, results[i]._score)
        })
        if(jum < 1){
            _cursorDef(); 
            $('#foto_karyawan').val('');
            _swalAlertErr('Error', 'Tidak ada wajah terdeteksi,\n Berikan foto wajah yang jelas')
        }
        if(jum > 1){
            _cursorDef(); 
            $('#foto_karyawan').val('');
            _swalAlertErr('Error', 'Wajah lebih dari satu')
        } 
        if(jum == 1){   
            _cursorDef();
        }
        console.log('6')  

        // const canvas = $('#overlay').get(0) 
        // faceapi.matchDimensions(canvas, inputImgEl)
        // faceapi.draw.drawDetections(canvas, faceapi.resizeResults(results, inputImgEl))
        // console.log('updateResults') 
        // $('.load').hide(); // Hide Process 
    }
    
</script>
@endsection  