
@extends('layout')
@section('title-web', 'Presensi')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Presensi > &nbsp  Master Cuti
@endsection
@section('nav-item-presensi', 'menu-open')  
@section('menu-open-presensi', 'active') 
@section('menu-open-master-cuti', 'active')  

 

@section('content')
 

<div class="card">
    <div class="card-body"> 
        
        <div class="row">  
            <div class="p-3"> 
                <h5>Data Master Cuti</h5>  
                <hr>  
            </div>    

            <div class="p-3"> 
                <div class="float-end">
                    <form action="{{url('master-cuti-create')}}" id="form">
                        @csrf 
                        <input type="hidden" value="{{$pt['id_perusahaan']}}" name="id_perusahaan" />
                        <input type="hidden" value="{{date('Y')}}" name="tahun" />
                        <button  class="btn btn-outline-primary create-master-cuti">
                            Buat Master Cuti &nbsp<i class="fas fa-file-upload"></i></button> 
                    </form> 
                </div>  
                        <form action="{{url('master-cuti')}}" method="POST" id="" class="row g-3">
                            @csrf   
                            <div class="input-group">  
                                <span>  <input type="number" class="form-control" name="tgl" value="{{Date('Y')}}" width="200"> </span>
                                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                            </div> 
                        </form>  
            </div>   
            
            <div class="table-responsive"> 
                <table id="example" class="display order-column" style="width:100%">
                    <thead>
                        <tr>
                            <td>Tahun</td> <td>Nama</td> <td>Kuota</td> <td>Terpakai</td>  
                        </tr>
                    </thead>
                    <tbody>    
                    </tbody>
                </table>
            <div class="table-responsive"> 

        </div> 
    </div>
</div>  

<script>
    var inputs = []
    $('#form').click(function(e){ 
        e.preventDefault();
        _cursorWait();
        var formData = $('#form').serialize();  
        var action = $(this).attr('action'); 
        console.log('formData', formData) 
        _submitFromReturnSwall(action, formData, inputs) 
    })
</script>

@endsection  