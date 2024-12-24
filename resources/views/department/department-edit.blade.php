
@extends('layout')
@section('title-web', 'Edit Department')
@section('title-page') 
{{$data['nama_perusahaan']}}  &nbsp > &nbsp  Department
@endsection
@section('menu-open-department', 'active') 
@section('menu-open-department-add', 'active') 

@section('content')


<div class="card">
    <div class="card-body">  
        <div class="row">
            <div class="p-3">
                <h5>Edit Departemen</h5> 
                <hr>
            </div>     
            <div class="col-sm-6">
                 
                
                <form action="{{url('department-edit-act')}}" method="POST" id="form">

                    @csrf 
                    <input type="hidden" name="id_department"  value="{{$data['id_department']}}"/>
                    <input type="hidden" name="id_perusahaan"  value="{{$data['id_perusahaan']}}" placeholder="id_perusahaan" />

                    <div class="mb-3">
                        <label for=""  >Nama Perusahaan</label> 
                         <input type=""   value="{{$data['nama_perusahaan']}}" class="form-control" readonly="readonly"/>
                    </div> 
 
                    <div class="mb-3">
                        <label for=""  >Nama department</label>
                        <input value="{{$data['nama_department']}}" class="form-control" id="" name="nama_department" placeholder="Nama department">
                        <div class="text text-danger nama_department"></div>
                    </div> 
 
   
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi  </label>
                        <textarea  class="form-control"  name="deskripsi_department"> {{$data['deskripsi_department']}} </textarea>
                        <div class="text text-danger deskripsi_department"></div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Perbaharui"> &nbsp
                        <a href="{{url('department')}}" class="btn btn-outline-info">Batal</a>
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