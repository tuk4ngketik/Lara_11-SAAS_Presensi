
@extends('layout')
@section('title-web', 'Karyawan')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Karyawan
@endsection
@section('nav-item-karyawan', 'menu-open') 
@section('menu-open-karyawan', 'active') 
@section('menu-open-karyawan-list', 'active')  

@section('content')

<div class="card">
    <div class="card-body">  
            
            @if(session('status'))
                <!-- <div class="alert alert-success">{{  session('status') }}</div> -->
                <script> 
                    Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "  {{session('status')}}  ",
                                showConfirmButton: false,
                                timer: 1500
                            }); 
                </script>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{  session('warning') }}</div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger">{{  session('danger') }}</div>
            @endif

            <div class="p-3"> 
                <div class="float-start"><h5>Data Karyawan</h5></div>

                <div class="float-end">
                <div class="dropdown">
                    <a class="btn btn-outline-default dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Status Karyawan
                    </a>

                    <ul class="dropdown-menu">
                        <!-- 
                            <li><a class="dropdown-item" href="{{url('karyawan')}}/aktif">Aktif</a></li> 
                            <li><a class="dropdown-item" href="{{url('karyawan')}}/nonaktif">Non Aktif</a></li> -->
                            <!-- <li><hr class="dropdown-divider"></li>
                            <li><hr class="dropdown-divider"></li> 
                            -->
                        <li><a class="dropdown-item" href="#{{url('karyawan')}}/cuti">Cuti</a></li>
                        <li><a class="dropdown-item" href="#{{url('karyawan')}}/cuti">Izin terlambat</a></li>
                        <li><a class="dropdown-item" href="#{{url('karyawan')}}/cuti">Sakit</a></li>

                    </ul>
                </div>  
                </div> 
            </div>
            <br>
            <div class="float-none"></div>
            <hr>

        <div class="row">  

            <div class="res"></div>

            <div class="table-responsive"> 
            <!-- <table class="table table-hover"> -->
            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                     <td>NIK</td><td>Nama</td>
                     <!-- <td>Lokasi</td>  -->
                     <td>Email</td> <td>Telp</td> <td>Dept</td> <td>Divisi</td> 
                        <td>Jabatan</td> <td>Bergabung</td><td>Lokasi</td> <td>Status</td>  
                        <!-- <td>Aktif</td>   -->
                     <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_karyawan}}">
                        <td>{{$v->nik}}</td>
                        <td>
                            <a  href="karyawan-detail/{{$v->id_karyawan}}">{{$v->nama_karyawan}}</a>
                        </td>
                        <!-- <td> <i class="fas fa-map-pin"></i> {{$v->nama_lokasi}}</td> -->
                        <td>{{$v->email_karyawan}}</td>
                        <td>{{$v->telp_karyawan}}</td>
                        <td>{{$v->nama_department}}</td>
                        <td>{{$v->nama_divisi}}</td>
                        <td>{{$v->nama_jabatan}}</td>
                        <td class="small">{{$v->tgl_bergabung}}</td>
                        <td><span class="{{$v->id_karyawan}}-nama_lokasi">{{$v->id_lokasi == "0" ?  "Semua Lokasi" : "{$v->nama_lokasi}"  }}</span></td>
                        <td>{{$v->status_karyawan}}</td> 
                        <td>  
                            <div class="dropdown">
                                <a class="btn btn-outline-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sliders-h"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li> 
                                        <!-- <a class="dropdown-item" href="{{url('edit-karyawan')}}/{{$v->id_perusahaan}}/{{$v->id_karyawan}}" alt="Edit Karyawan"> -->
                                        <a class="dropdown-item" href="{{url('edit-karyawan')}}/{{$v->id_karyawan}}" alt="Edit Karyawan">
                                       <i class="fas fa-user-edit"></i> Edit Data
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="#"  class="dropdown-item karyawan-set-lokasi" id="{{$v->id_perusahaan}}/{{$v->id_karyawan}}"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                         <i class="fas fa-street-view"></i> Lokasi Kerja
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item karyawan-set-jadwal" id="{{$v->id_perusahaan}}/{{$v->id_karyawan}}" 
                                            href="{{url('karyawan-set-jadwal')}}/{{$v->id_perusahaan}}/{{ $v->id_karyawan }}" >
                                            <i class="fas fa-user-cog"></i> Buat Jadwal
                                        </a> 
                                    </li> 
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item karyawan-non-aktif" href="#" id="{{$v->id_perusahaan}}/{{$v->id_karyawan}}"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="fas fa-user-alt-slash"></i> Non Aktif
                                        </a>
                                    </li> 
                                </ul>
                            </div>

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

