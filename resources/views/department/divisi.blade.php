@extends('layout')    
@section('title-web', 'Divisi')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Departemen > &nbsp  Divisi 
@endsection
@section('nav-item-department', 'menu-open') 
@section('menu-open-divisi', 'active') 
@section('menu-open-divisi-list', 'active') 

 

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
                <h5>Daftar Divisi</h5> 
                <hr>  
            </div>    
            
            <div class="table-responsive"> 
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                    <td>Divisi</td> <td>Departemen</td> <td>Deskripsi</td>  <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_divisi}}">
                     <td>{{$v->nama_divisi}}</td>
                     <td>{{$v->nama_department}}</td>
                        <td>{{$v->deskripsi_divisi}}</td> 
                        <td> 
                            
                            <a href="{{url('edit-divisi')}}/{{$v->id_divisi}}" class="btn btn-outline-warning btn-sm" title="Edit Divisi">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" id="{{$v->id_divisi}}" class="btn btn-outline-danger btn-sm del-divisi" title="Hapus Divisi"
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