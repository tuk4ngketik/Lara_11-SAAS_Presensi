@extends('layout')
@section('title-web', 'Beranda')    
@section('title-page') 
Nama Perusahaan
@endsection  

@section('content')
<div class="card">
    <div class="card-body"> 
        <div class="row">
            
            <div class="p-3">
                <h5>Buat Perusahaan</h5>
                <hr>
            </div>    

            @if(session('status'))
                <div class="alert alert-danger">{{  session('status') }}</div>
            @endif 
            
            <!-- Left -->
            <div class="col-sm-7">
                    
                <form action="{{url('perusahaan-act')}}" enctype="multipart/form-data" method="POST" id="form">
                    @csrf

                    <div class="row">
                        <div class="col-sm-7">


                            <div class="mb-3">
                                <label for=""  >Nama Perusahaan</label>
                                <input value="{{old('nama_perusahaan')}}" class="form-control" id="" name="nama_perusahaan" placeholder="Nama Perusahaan">
                                 <div class="text text-danger nama_perusahaan"></div>
                            </div> 

                            <div class="mb-3">
                                <label for="" class="form-label">Email Perusahaan</label>
                                <input value="{{old('email_perusahaan')}}"  class="form-control" id="" name="email_perusahaan"  placeholder="Email Perusahaan">
                                <div class="text text-danger email_perusahaan"></div>
                            </div> 

                            <div class="mb-3">
                                <label for="" class="form-label">Telp Perusahaan</label>
                                <input value="{{old('telp_perusahaan')}}"  class="form-control" id="" name="telp_perusahaan"  placeholder="Telp Perusahaan">
                                <div class="text text-danger telp_perusahaan"></div>
                            </div> 
                        </div>
                        <div class="col-sm-5">
                            <div class="card p-2">
                                <b>Logo Perusahaan</b> 
                            <div class="text-center p-2"> 
                                    <center> 
                                        <img src="" alt="" id="img_logo" width=150 height=150>
                                    </center>
                                </div>   
                                <div class="card-bottom">   
                                    <input type="file" id="logo" name="logo" accept=".jpg,.jpeg,.png" class="form-control">
                                    <div class="text text-danger logo"></div>
                                </div>
                            </div>
                        </div> 
                    </div>
 

                    <div class="mb-3">
                        <label for="" class="form-label">Website</label>
                        <input class="form-control" id=""  name="website"  placeholder="http://example.com">
                        <div class="text text-danger website"></div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Industri</label>
                        <input  value="{{old('industri')}}" class="form-control" id=""  name="industri"  placeholder="Jenis Industri Perusahaan">
                        <div class="text text-danger industri"></div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Alamat Perusahaan</label>
                        <textarea name="alamat_perusahaan"  class="form-control"  id="">{{old('alamat_perusahaan')}}</textarea> 
                        <div class="text text-danger alamat_perusahaan"></div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi Industri</label>
                        <textarea  class="form-control"  name="deskripsi_perusahaan"> {{old('deskripsi_perusahaan')}} </textarea>
                        <div class="text text-danger deskripsi_perusahaan"></div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp
                        <a href="" class="btn btn-outline-info">Batal</a>
                    </div>  
                </form> 
            </div>

            <!-- Right -->
            <div class="col-sm-5"> 
                
            
                <div  class="p-3 border border-warning rounded"> 
                    <h5> 
                        <i class="far fa-lightbulb  fa-lg  text-warning"></i>
                    </h5>
                
                    <hr class="border-warning">
                </div> 

            </div>
        </div> 
    </div>
</div>
<script src="{{asset('don')}}/js/upload-base64.js"></script>
<script>   
    // Upload 
    var input_foto = document.getElementById("logo");
    var img_foto = document.getElementById("img_logo"); 
    input_foto.addEventListener("change", (e) => {
        uploadImage(e);
    });

    const inputs = [
            'nama_perusahaan', 'alamat_perusahaan', 'email_perusahaan','website', 
            'telp_perusahaan', 'industri', 'deskripsi_perusahaan', 'logo' 
     ]  
    $('#form').submit(function(e) { 
        e.preventDefault();
        _cursorWait();
        var action = $(this).attr('action'); 
        var formData = new FormData($(this)[0]);
        // console.log('formData', formData)
        _submitFromObject(action, formData, '{{url("beranda")}}', inputs);   
        // _submitFromObject(action, formData, null, inputs);    
    });
</script>

@endsection  