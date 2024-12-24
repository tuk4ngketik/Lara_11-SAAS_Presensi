
@extends('layout')
@section('title-web', 'Buat Divisi')
@section('title-page') 
{{$data['nama_perusahaan']}}  &nbsp > &nbsp  Department {{$data['nama_department']}}
@endsection
@section('nav-item-department', 'menu-open') 
@section('menu-open-department', 'active') 
@section('menu-open-department-add', 'active') 

@section('content')
 

<div class="card">
    <div class="card-body"> 
        
            @if(session('warning'))
                <p><i class="fas fa-exclamation-triangle"></i></p>
                <p><i class="fas fa-exclamation-circle"></i></p>
                <p><i class="fas fa-exclamation"></i></p>
                <div class="alert alert-warning">{{  session('warning') }}</div>
            @endif
 

        <div class="row">
            
            <div class="p-3">
             <h5>Buat Divisi</h5>
                <hr>
            </div>     

            <!-- Left -->
            <div class="col-sm-6"> 
                
                <form action="{{url('divisi-act')}}" method="POST" id="form">
                    @csrf  
                    <div class="mb-3">
                        <label for=""  >Nama Department</label>
                        <input value="{{$data['nama_department']}}" class="form-control" id=""  readonly="readonly"> 
                    </div> 

                    <div class="mb-3">
                        <label for=""  >Nama Divisi</label>
                        <input value="{{old('nama_divisi')}} " class="form-control" id=""  name="nama_divisi" placeholder="Nama Divisi"> 
                        <div class="text text-danger nama_divisi"></div> 
                    </div> 
 
   
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi  </label>
                        <textarea  class="form-control"  name="deskripsi_divisi"> {{old('deskripsi_divisi')}} </textarea>
                        <div class="text text-danger deskripsi_divisi"></div> 
                    </div>
 
                    <input type="hidden" name="id_perusahaan"  value="{{$data['id_perusahaan']}}"  />
                    <input type="hidden" name="id_department"  value="{{$data['id_department']}}" />
 
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Kirim"> 
                        <a href="{{url('department')}}" class="btn btn-outline-info">Batal</a>
                    </div> 
                </form>
        
            </div>

            <!-- Right -->
            <div class="col-sm-6"> 

                <div  class="p-3 border border-warning rounded">
                 <i class="fas fa-info-circle fa-lg text-warning"></i>  <br> 
                 <i class="fas fa-lightbulb fa-lg text-warning"></i>
                 <i class="far fa-lightbulb fa-lg text-warning"></i>
                 <hr class="border-warning">
                </div> 

            </div>
        </div>

    </div>
</div>

<script>  
    const inputs = ['nama_divisi', 'deskripsi_divisi']
    $('#form').submit(function(e) { 
        e.preventDefault(); 
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("divisi")}}', inputs); 
    });  
</script>
@endsection  