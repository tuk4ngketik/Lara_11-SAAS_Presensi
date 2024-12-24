
@extends('beranda')
@section('title-web', 'Data karyawan')
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-list', 'active') 

@section('content')

<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-">

        <div class="card">
            <div class="card-body">
                <h5>Data tidak ditemukan</h5>
                <br>
                <a href="{{url('/')}}" class="btn btn-outline-info">Kembali</a>
            </div>
        </div>


    </div>
    <div class="col-sm-3"></div>
</div>
 

@endsection   