@extends('layout')
@section('title-web', 'Beranda')    
@section('title-page') 
{{$pt['nama_perusahaan']}}
@endsection  

@section('content') 
<?php
//  $base64Image = 'data:image/png;base64,'. base64_encode($pt['logo_perusahaan']);   
 $base64Image = 'data:image/png;base64,'. $pt['logo_perusahaan'] ;   
 ?> 

<div class="card">
    <div class="card-body"> 
        
        @if(session('status'))
             <div class="alert alert-success">{{  session('status') }}</div>
        @endif 
        @if(session('danger'))
             <div class="alert alert-danger">{{  session('danger') }}</div>
        @endif 
        @if(session('warning'))
             <div class="alert alert-warning">{{  session('warning') }}</div>
        @endif

        <div class="row">  
            
            <div class="col-sm-4">
                <div class="card">
                    
                    <div class="card-header">
                        <h5>{!!  $pt['nama_perusahaan'] !!} &nbsp</h5>
                    </div>
                    <div class="card-body">  
                        <div class="row">
                            <div class="col-sm-5 text-center">
                                <img src="{{$base64Image}}" width="100" alt="" srcset="">
                            </div>
                            <div class="col-sm-7 small"> 
                                Website: <p>{{$pt['website']}}</p> <hr>
                                Industri: <p>{{$pt['industri']}}</p><hr>
                                Alamat: <p>{{$pt['alamat_perusahaan']}}</p> 
                            </div>
                        </div> 
                        <hr>
                        <div class="mt-3">   
                            <a href="{{url('buat-perusahaan')}}">Edit</a>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Karyawan</h5>
                    </div> 
                    <div class="card-body"> 
                        <ul>
                            <li>Karyawan :</li>
                            <li>Karyawan Tetap:</li>
                            <li>Karyawan Kontrak:</li>
                            <li>Karyawan Harian:</li>
                            <li>Karyawan Magang:</li>
                        </ul>
                    </div>
                </div> 
            </div>
            
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Kehadiran</h5>
                    </div> 
                    <div class="card-body">  
                        <ul>
                            <li>Cuti:</li>
                            <li>Izin:</li>
                            <li>Sakit:</li>
                            <li>Terlambat:</li>
                            <li>Tanpa Keterangan:</li>
                        </ul>
                    </div>
                </div> 
            </div> 
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Kehadiran</h5>
                    </div> 
                    <div class="card-body">  
                        <!-- <div class="fa-3x">  -->
                        <div class="fa-2x"> 
                        <!-- <div class="fa">  -->
                            <i class="fas fa-sync fa-spin text-danger"></i>
                            <i class="fas fa-sync fa-spin text-success"></i>
                            <i class="fas fa-circle-notch fa-spin"></i>
                            <i class="fas fa-circle-notch fa-spin text-warning"></i>
                            <i class="fas fa-circle-notch fa-spin text-blue"></i>
                            <i class="fas fa-cog fa-spin"></i> 
                            <i class="fas fa-cog fa-spin text-info"></i> 
                            <i class="fas fa-spinner fa-spin"></i> 
                            <i class="fas fa-spinner fa-spin text-default"></i> 
                        </div>


                    </div>
                </div> 
            </div> 
 
        </div>
    </div>
</div>

@endsection 
 
