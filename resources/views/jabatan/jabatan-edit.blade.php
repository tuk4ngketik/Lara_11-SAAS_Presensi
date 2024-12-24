
@extends('layout')
@section('title-web', 'Buat Jabatan')
@section('title-page') 
{{$jbt['nama_perusahaan']}}  &nbsp > &nbsp  Jabatan
@endsection 
@section('menu-open-jabatan', 'active') 
@section('menu-open-jabatan-add', 'active') 

@section('content')
 

<div class="card">
    <div class="card-body">
        
        <div class="row">  
                <div class="p-3"> 
                    <h5>Edit Jabatan</h5>
                    <hr>
                </div>   

            <div class="col-sm-6">
                 
                
                <form action="{{url('jabatan-edit-act')}}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="id_jabatan"  value="{{$jbt['id_jabatan']}}"  />
 
                     
                    
                    <div class="mb-3">
                        <label for=""  >Nama Jabatan</label>
                        <input name="nama_jabatan" id="nama_jabatan" class="form-control" value="{{$jbt['nama_jabatan']}}"  />
                        <div class="text text-danger nama_jabatan"></div>
                    </div>  
                    
                    <div class="mb-3">
                        <label for=""  >Kode Jabatan</label>
                        <input name="kode_jabatan" id="kode_jabatan" class="form-control" value="{{$jbt['kode_jabatan']}}"  />
                        <div class="text text-danger kode_jabatan"></div>
                    </div>  
   
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi  </label>
                        <textarea  class="form-control"  name="deskripsi_jabatan"> {{$jbt['deskripsi_jabatan']}} </textarea>
                        <div class="text text-danger deskripsi_jabatan"></div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp
                        <a href="{{url('jabatan')}}" class="btn btn-outline-info">Batal</a>
                    </div>

                

                </form>
        
        </div>
            <div class="col-sm-6">
                <h5>
                    <i class="fas fa-info-circle fa-lg text-warning"></i>
                    <i class="far fa-lightbulb  fa-lg  text-warning"></i>
                </h5>
                
                
                <div class="alert alert-warning" role="alert">
                    A simple warning alert—check it out!
                </div>

            </div>
        </div>

    </div>
</div>

<script>  
    const inputs = ['nama_jabatan', 'kode_jabatan', 'deskripsi_jabatan']
    $('#form').submit(function(e) { 
        e.preventDefault();
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("jabatan")}}', inputs);  
    });  
</script>
@endsection  