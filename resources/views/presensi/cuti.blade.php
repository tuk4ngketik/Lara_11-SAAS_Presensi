
@extends('layout')
@section('title-web', 'Presensi')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Presensi  &nbsp > &nbsp  Cuti
@endsection
@section('nav-item-presensi', 'menu-open')  
@section('menu-open-presensi', 'active') 
@section('menu-open-cuti-list', 'active')  

 

@section('content') 

<div class="card">
    <div class="card-body"> 
        
        <div class="row">  
            <div class="p-3">
                <h5>Cuti</h5> 
                <hr>  
            </div>    
 
            
            <div class="table-responsive"> 
                <table id="example" class="display order-column" style="width:100%">
                    <thead>
                        <tr>
                            <td>Status</td> <td>Nama</td> <td>Tanggal Cuti</td> 
                             <td>Cuti</td> <td>Jumlah Hari</td> 
                            <td>Keterangan</td>  
                            <td>Dibuat</td>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach($row as $v)  
                        <tr class="{{$v->id_cuti}}"> 
                            <td><b class="small">{{$v->status}}</td>
                            <td>{{$v->nama_karyawan}}</td>
                            <td class="small">{{$v->tgl_awal}} s.d {{$v->tgl_akhir}}</td> 
                            <td>{{$v->jenis_cuti}}</td>
                            <td>{{$v->jumlah_hari}}</td> 
                            <td>{{$v->keterangan}}</td>   
                            <td class="small"> 
                                {{date('d-m-Y H:i:s', strtotime($v->created_at))}}  
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