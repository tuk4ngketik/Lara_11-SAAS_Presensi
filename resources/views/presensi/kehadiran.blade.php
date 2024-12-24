
@extends('layout')
@section('title-web', 'Presensi')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Presensi  &nbsp > &nbsp  Kehadiran
@endsection
@section('nav-item-presensi', 'menu-open')  
@section('menu-open-presensi', 'active') 
@section('menu-open-presensi-list', 'active')  

 

@section('content')

<div class="p-3"> 
    <center>
        <div class="fixed-top p-3 m-5">
            <!-- <h6>Image Hover</h6>  --> 
            <img src="" id="img-absensi" style= " max-height:500px; max-width:500px;  height:auto;"
                class="img-fluid img-thumbnail">
        </div>
    </center>   
</div>

<div class="card">
    <div class="card-body"> 
        
        <div class="row">  
            <div class="p-3">
                <h5>Kehadiran</h5> 
                <hr>  
            </div>    

            <div class="p-3">  
                <div class="row justify-content-center">
                    <div class="col-md-6">    
                        <form action="{{url('presensi-act')}}" method="POST" id="" class="row g-3">
                            @csrf   
                            <div class="input-group"> 
                                <select class="form-select" name="kategori" id="kategori">
                                    <option value="kehadiran" selected="selected" >Kehadiran</option>
                                    <option value="cuti">Cuti</option>
                                    <option value="sakit">Sakit</option>
                                </select>
                                <span>  <input type="date" class="form-control" name="tgl" value="{{$currDate}}" width="200"> </span>
                                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                            </div> 
                        </form>
                    </div>
                </div>  
            </div>    
            
            <div class="table-responsive"> 
                <table id="example" class="display order-column" style="width:100%">
                    <thead>
                        <tr>
                            <td>Nama</td> <td>Hari</td> <td>Tanggal</td> <td>Jam Masuk</td> <td>Lokasi Masuk</td> 
                            <td>Jam Pulang</td> <td>Lokasi Pulang</td> <td>Server</td>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach($row as $v)  
                        <tr>
                            <td>{{$v->nama_karyawan}}</td>
                            <td>{{$v->valid_day}}</td>
                            <td>{{date('d-m-Y', strtotime($v->valid_date))}}  </td>
                            <td class="small"> 
                                <a href="#" class="_openImage" id="{{$v->foto_masuk}}"> {{date('d-m-Y H:i:s', strtotime($v->jam_masuk))}} </a>   
                            </td>
                            <td>{{$v->lokasi_masuk}}</td>
                            <td class="small"> 
                                <a href="#" class="_openImage" id="{{$v->foto_pulang}}">{{$v->jam_pulang == '' ? '' : date('d-m-Y H:i:s', strtotime($v->jam_pulang)) }}</a>   
                            </td>
                            <td>{{$v->lokasi_pulang}}</td>
                            <td class="small"> 
                                {{date('d-m-Y H:i:s', strtotime($v->created_at))}} <br>
                                {{date('d-m-Y H:i:s', strtotime($v->updated_at))}}  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="table-responsive"> 

        </div> 
    </div>
</div> 

<script>
    $('a._openImage').hover(function(){
        var str = $(this).attr('id')
        var img_src = 'data:image/png;base64,' + str
        document.getElementById("img-absensi").src = img_src    
    })
    $('#img-absensi').mouseleave(function(){
        document.getElementById("img-absensi").src = '' 
    }) 
    $(document).click(function(){
        document.getElementById("img-absensi").src = '' 
    })
</script>

@endsection  