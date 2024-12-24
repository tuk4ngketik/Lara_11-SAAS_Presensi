
@extends('layout')
@section('title-web', 'Detail Karyawan')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp Karyawan
@endsection
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-add', 'active') 

@section('content')
 <?php 
 $base64Image = 'data:image/png;base64,'. $data['foto_karyawan']; 
 ?>  
<div class="card">
    <div class="card-body">  
            <div class="p-3"> 
                <div class="float-start"><h5>Detail Karyawan</h5></div>  
                <br>
            </div> 
            <hr>

        <div class="row">
            <!-- Left     -->
            <div class="col-sm-4">   
                <table class="table table-hover">
                    <tbody> 
                    <tr><td> 
                        <div class="text-secondary fs-6"  >Nama karyawan</div> 
                        <p class="fw-bold">{{$data['nama_karyawan']}}</p> 
                    </td></tr>
                    <tr><td>  
                           <div class="text-secondary fs-6"  >NIK karyawan</div> 
                           <p class="fw-bold">{{$data['nik']}}</p> 
                    </td></tr> 
                    <tr><td> 
                        <div class="text-secondary fs-6"  >Email karyawan</div> 
                        <p class="fw-bold">{{$data['email_karyawan']}}</p> 
                    </td></tr>

                    <tr><td> 
                        <!-- id_department --> 
                            <div class="text-secondary fs-6"  >Department</div> 
                            <p class="fw-bold" class="fw-bold">{{$data['nama_department']}}</p> 
                    </td></tr>
                    <tr><td> 
                        <!-- id_divisi --> 
                            <div class="text-secondary fs-6"  >Divisi</div> 
                            <p class="fw-bold" class="fw-bold">{{$data['nama_divisi']}}</p> 
                    </td></tr>
                    <tr><td> 
                        <!-- id_jabatan --> 
                            <div class="text-secondary fs-6"  >Jabatan / Posisi</div> 
                            <p class="fw-bold">{{$data['nama_jabatan']}}</p> 
                    </td></tr>   
                        <tr><td>
                        <div class="text-secondary fs-6"  >No. Telp karyawan</div> 
                        <p class="fw-bold">{{$data['telp_karyawan']}}</p> 
                        </td></tr> 
                    </tbody>
                </table>
  
            </div>
            <!-- End Left     -->

            <!-- Mid     -->
            <div class="col-sm-4">   
                <table class="table table-hover">
                    <tbody>
                        <tr><td>
                        <div class="text-secondary fs-6"  >Tgl lahir</div> 
                        <p class="fw-bold">{{$data['tgl_lahir']}}</p> 
                        </td></tr>
                        <tr><td>
                        <div class="text-secondary fs-6"  >Tempat Lahir</div> 
                        <p class="fw-bold">{{$data['tempat_lahir']}}</p> 
                        </td></tr> 
                        <tr><td>
                        <div class="text-secondary fs-6"  >Pendidikan terakhir</div> 
                        <p class="fw-bold">{{$data['pendidikan']}}</p>
                        </td></tr>  
                        <tr><td>
                        <div class="text-secondary fs-6"  >Tgl bergabung dng perusahaan</div> 
                        <p class="fw-bold">{{$data['tgl_bergabung']}}</p>
                        </td></tr>
                        <tr><td>
                        <div class="text-secondary fs-6">Status Kerja Karyawan</div> 
                        <p class="fw-bold">{{$data['status_karyawan']}}</p>
                        </td></tr> 
                        <tr><td>
                        <div class="text-secondary fs-6">Status Pernikahan</div> 
                        <p class="fw-bold">{{$data['status_pernikahan']}}</p>
                        </td></tr> 
                        <tr><td>  
                            <div class="text-secondary fs-6" class="form-div">Alamat karyawan  </div> 
                            <p class="fw-bold">{{$data['alamat_karyawan']}}</p> 
                        </td></tr>
                    </tbody>
                </table>    
            </div>  
            <!-- End Mid     -->

            
            <!-- End Right     --> 
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;"> 
                    <div class="card-body">
                         
                        <img src="{{$base64Image}}" class="img-fluid img-thumbnail"   alt="">  
                        <br><hr>
                        
                        <b>Lokasi Kerja</b><br>  
                        {{$data['nama_lokasi']}} <hr>
                        <b>Jam Kerja</b><br>  
                        {{$data['shift']}}  
                    </div>
                </div>
            </div>
            <!-- End Right     -->

        </div>
        
        <div class="mb-3">             
            <a href="{{url('karyawan')}}" class="btn btn-outline-primary">
              <i class="fas fa-long-arrow-alt-left"></i></a>
            <a href="{{url('edit-karyawan')}}/{{$data['id_karyawan']}}" class="btn btn-outline-info">
              <i class="fas fa-edit"></i>   Edit</a>
        </div>    

    </div>
</div>

@endsection  