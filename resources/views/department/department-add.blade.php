
@extends('layout')
@section('title-web', 'Buat department')
@section('title-page') 
{{$data['nama_perusahaan']}}  &nbsp > &nbsp  Department
@endsection
@section('nav-item-department', 'menu-open') 
@section('menu-open-department', 'active') 
@section('menu-open-department-add', 'active') 

@section('content')
 

<div class="card">
    <div class="card-body"> 
        
            @if(session('warning')) 
                <div class="alert alert-warning">{{  session('warning') }}</div>
            @endif
 

        <div class="row">
            
            <div class="p-3">
             <h5>Buat Department</h5>
                <hr>
            </div>     

            <!-- Left -->
            <div class="col-sm-6"> 
                
                <form action="{{url('department-act')}}" method="POST" id="form">
                    @csrf  
                    <div class="mb-3">
                        <label for=""  >Nama department</label>
                        <input value="{{old('nama_department')}}" class="form-control" id="" name="nama_department" placeholder="Nama department">
                        <div class="text text-danger nama_department"></div>
                    </div> 
 
   
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi  </label>
                        <textarea  class="form-control"  name="deskripsi_department"> {{old('deskripsi_department')}} </textarea>
                        <div class="text text-danger deskripsi_department"></div>
                    </div>

                    <input type="hidden" name="id_pendaftar" value="{{$data['id_pendaftar']}}" placeholder="id_pendaftar jika perlu" /> <br>
                    <input type="hidden" name="id_perusahaan"  value="{{$data['id_perusahaan']}}" placeholder="id_perusahaan" />
 
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
    const inputs = ['nama_department', 'deskripsi_department']
    $('#form').submit(function(e) {  
        e.preventDefault();
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("department")}}', inputs);  
    });  
</script>
@endsection  