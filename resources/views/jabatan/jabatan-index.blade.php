
@extends('layout')
@section('title-web', 'Data Jabatan') 
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Jabatan
@endsection 
@section('nav-item-jabatan', 'menu-open') 
@section('menu-open-jabatan', 'active') 
@section('menu-open-jabatan-list', 'active') 

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
                <h5>Daftar Jabatan</h5>
                <hr>
            </div>  
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                    <td>Jabatan</td> <td>Kode</td> <td>Deskripsi</td>  <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_jabatan}}">
                        <td>{{$v->nama_jabatan}}</td>
                        <td>{{$v->kode_jabatan}}</td>
                        <td>{{$v->deskripsi_jabatan}}</td>
                        <td>
                            <a href="{{url('edit-jabatan')}}/{{$v->id_jabatan}}" class="btn btn-outline-warning btn-sm" title="Edit Jabatan">
                                <i class="fas fa-edit"></i>
                            </a>
                             
                            <a href="#" id="{{$v->id_jabatan}}" class="btn btn-outline-danger btn-sm del-jabatan"  title="Hapus Jabatan"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash"></i>
                            </a>  
                        </td>
                     </tr>
                    @endforeach
                </tbody>
            </table>

        </div> 
    </div>
</div>

@endsection  