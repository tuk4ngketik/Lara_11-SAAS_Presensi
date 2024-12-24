
@extends('layout')
@section('title-web', 'Lokasi Kerja')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Lokasi Kerja
@endsection
@section('nav-item-lokasikerja', 'menu-open') 
@section('menu-open-lokasikerja', 'active') 
@section('menu-open-lokasikerja-list', 'active') 

@section('content') 

<div class="card">
    <div class="card-body">  
        <div class="row"> 

            <div class="p-3">
                <h5>Lokasi Kerja</h5> 
                <hr>  
            </div>   
            @if(session('status'))
                <div class="alert alert-success">{{  session('status') }}</div>
            @endif
 
            <div class="table-responsive"> 
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                    <td>Lokasi Kerja</td>  <td>Max Jarak</td>  <td>LatLgt</td> <td>Alamat</td><td>Deskripsi</td>  <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_lokasi}}">
                        <td>{{$v->nama_lokasi}}</td>
                        <td>{{$v->max_jarak}} m</td>
                        <td class="small">{{substr( $v->lat, 0,8)}}, {{substr( $v->lgt, 0,8)}}</td>
                        <td>{{$v->alamat_lokasi}}</td>
                        <td>{{$v->deskripsi_lokasi}}</td>
                        <td>
                            <a href="{{url('edit-lokasi-kerja')}}/{{$v->id_perusahaan}}/{{$v->id_lokasi}}" class="btn btn-outline-warning btn-sm" alt="Hapus Departemen">
                                <i class="fas fa-edit"></i>
                            </a> 
                            <a href="#" id="{{$v->id_lokasi}}" class="btn btn-outline-danger btn-sm del-lokasikerja" title="Hapus Lokasi Kerja"
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