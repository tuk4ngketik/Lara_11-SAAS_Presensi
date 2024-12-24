<?php    
 if( $karyawan > 0):
?>
 <h5 align=center>Lokasi kerja tidak bisa dihapus</h5> <hr> 
 <h6>{{$karyawan}} Karyawan</h6>  
<?php 
return;
endif; 
?>
<div class="mb-3">
    <label for=""  >Nama Lokasi Kerja</label>
    <input name="nama_lokasi"  class="form-control" value="{{$data['nama_lokasi']}}"  /> 
</div> 

<div class="mb-3">
    <label for=""  >Latitude, Longitude</label>
    <input name="lat" class="form-control" value="{{$data['lat']}}, {{$data['lgt']}} " /> 
</div> 
 

<div class="mb-3">
    <label for=""  >Maksimal jarak absensi (m)</label>
    <input name="max_jarak"  placeholder="ex: 10"  class="form-control" value="{{$data['max_jarak']}}"  /> 
</div>   

<div class="mb-3">
    <input type="submit" id="{{$data['id_lokasi']}}" class="btn btn-danger del-row" value="Hapus"> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_lokasi' : id
        }   
        var uri = url +'/lokasi-del-act'; 
        
        $.ajax({
                    type: "POST",
                    url: uri, 
                    data: formData,
                    success: function(data){
                        
                        console.log('data', data);

                        if(data.status == true){
                            Swal.fire({
                                position: "top-end",
                                icon: "success", 
                                title: "Lokasi Kerja berhasil dihapus",
                                showConfirmButton: false,
                                timer: 1500
                            });   
                            $('#staticBackdrop').modal('toggle');
                            $('table tr.'+id ).hide()
                        } 
                        else{  
                            $('.err').text(data.message)
                        }
                    },
        });
 })
</script>

