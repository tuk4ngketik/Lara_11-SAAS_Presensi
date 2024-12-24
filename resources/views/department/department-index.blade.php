
@extends('layout')
@section('title-web', 'Departemen')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Department
@endsection
@section('nav-item-department', 'menu-open') 
@section('menu-open-department', 'active') 
@section('menu-open-department-list', 'active') 

 

@section('content')


<div class="card">
    <div class="card-body"> 
            @if(session('status'))
                <div class="alert alert-success">{{  session('status') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{  session('warning') }}</div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger">{{  session('danger') }}</div>
            @endif
        <div class="row">  
            <div class="p-3">
                <h5>Daftar Departemen</h5> 
                <hr>  
            </div>    
            
            <div class="table-responsive"> 
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                        <td>Departemen</td> <td>Deskripsi</td> <td>Karyawan</td> <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_department}}">
                        <td>{{$v->nama_department}}</td>
                        <td>{{$v->deskripsi_department}}</td>
                        <td>totalKaryawan</td>
                        <td> 
                            
                             <a href="{{url('buat-divisi')}}/{{$v->id_department}}" id="" class="btn btn-outline-success btn-sm del-departemen"  title="Buat Divisi">
                                <i class="fas fa-plus"></i>
                            </a>

                            <a href="{{url('edit-department')}}/{{$v->id_department}}" class="btn btn-outline-warning btn-sm" title="Edit Departemen">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" id="{{$v->id_department}}" class="btn btn-outline-danger btn-sm del-department" title="Hapus Departemen"                                
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash"></i>
                            </a> 
                        
                        </td>
                     </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="table-responsive"> 

        </div> 
    </div>
</div>

@endsection  