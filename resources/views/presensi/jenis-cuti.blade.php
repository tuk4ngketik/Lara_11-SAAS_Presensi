
@extends('layout')
@section('title-web', 'Presensi')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Presensi
@endsection
@section('nav-item-presensi', 'menu-open')  
@section('menu-open-presensi', 'active') 
@section('menu-open-presensi-jenis-cuti', 'active')  

 

@section('content')

<div class="p-3"> 
    <center>
        <div class="fixed-top p-3 m-5">
            <!-- <h6>Image Hover</h6>  -->
            <div id="x"></div>
            <img src="" id="img-absensi" style= " max-height:500px; max-width:500px;  height:auto;"
                class="img-fluid img-thumbnail">
        </div>
    </center>  
</div>

<div class="card">
    <div class="card-body"> 
        
        <div class="row">  
            <div class="p-3">
                <h5>Presensi</h5> 
                <hr>  
            </div>    

            <div class="p-3">    
                <div class="float-end"> 
                    <a href="#" class="btn btn-outline-primary tambah-jenis-cuti" title="Tambah Jenis Cuti"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah  <i class="fas fa-plus"></i>  
                    </a>
                </div> 
            </div>    
            
            <div class="table-responsive"> 
                <table id="example" class="display order-column" style="width:100%">
                    <thead>
                        <tr>
                            <td>Jenis Cuti</td> <td>Maksimal Cuti</td>   <td>Satuan</td>  <td></td> 
                        </tr>
                    </thead> 
                    <tbody>
                        @foreach($row as $v)
                        <tr class="{{$v->id_jenis_cuti}}">
                            <td>{{$v->jenis_cuti}}</td>
                            <td>{{$v->maksimal_cuti}}</td>
                            <td>{{$v->satuan_cuti}}</td>
                            <td> 
                                <!-- Edit -->
                                <a href="#" id="{{$v->id_jenis_cuti}}" class="btn btn-outline-warning btn-sm jenis-cuti-edit" 
                                    title="Edit Jenis Cuti" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Del -->
                                <a href="#" id="{{$v->id_jenis_cuti}}" class="btn btn-outline-danger btn-sm jenis-cuti-del" 
                                    title="Edit Jenis Cuti" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <span class="{{$v->id_jenis_cuti}}"></span>
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