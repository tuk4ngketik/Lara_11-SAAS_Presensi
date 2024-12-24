
@extends('layout')
@section('title-web', 'Karyawan')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp Jadwal  Karyawan
@endsection
@section('nav-item-karyawan', 'menu-open') 
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-jadwal', 'active') 

@section('content')


<div class="card">
    <div class="card-body">  

            <div class="p-3"> 
                <div class="float-start"><h5>Data Jadwal Karyawan</h5></div> 
            </div>
            <br> 
            <hr>

        <div class="row"> 
            
            @if(session('status'))
                <div class="alert alert-success">{{  session('status') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{  session('warning') }}</div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger">{{  session('danger') }}</div>
            @endif

            <div class="table-responsive"> 
            <!-- <table class="table table-hover"> -->
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                     <td>Tgl Awal</td><td>Tgl Akhir</td> 
                     <td>Nama</td><td>Departement</td> <td>Jabatan</td><td>Lokasi Kerja</td><td>Jam Kerja</td>   
                     <td>Aksi</td>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($data as $v)
                    <tr class="{{$v->id_jadwal}}">
                        <td>{{$v->tgl_awal}}</td><td>{{$v->tgl_akhir}}</td><td>{{$v->nama_karyawan}}</td>
                        <td>{{$v->nama_department}}</td><td>{{$v->nama_jabatan}}</td> 
                        <td>{{ $v->nama_lokasi ?: '--' }}</td>
                        <td>Shift {{$v->shift ?: '--'}}</td>
                        <td> 
                            <a href="{{url('karyawan-edit-jadwal')}}/{{$v->id_perusahaan}}/{{$v->id_jadwal}}" class="btn btn-outline-warning btn-sm del-jadwal"
                              title="Edit Jadwal">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" id="{{$v->id_jadwal}}" class="btn btn-outline-danger btn-sm karyawan-del-jadwal"  title="Hapus Jadwal"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3"></div>
            </div> 
            <!-- table responsive -->

        </div> 
    </div>
</div>

@endsection   