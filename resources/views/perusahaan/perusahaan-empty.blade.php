@extends('layout')
@section('title-web', 'Beranda')    
@section('title-page') 
Nama Perusahaan
@endsection  

@section('content') 

<div class="row"> 
    <div class="col-sm-3">
        
    </div>
    <div class="col-sm-6">
        
        <div class="mt-3 text-center">   
            <h5>Lengkapi data Perusahaan / Organisasi anda</h5>
            <a href="{{url('buat-perusahaan')}}"> Buat Perusahaan </a>
        </div>
    </div>
    <div class="col-sm-3">
        
    </div>
</div>

@endsection  