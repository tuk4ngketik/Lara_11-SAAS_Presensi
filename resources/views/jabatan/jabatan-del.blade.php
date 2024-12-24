<?php    
 if( $karyawan > 0):
?>
 <h5 align=center> Jabatan tidak bisa dihapus</h5> <hr> 
 <h6>{{$karyawan}} Karyawan</h6>  
<?php 
return;
endif; 
?>
<div class="mb-3">
    <label for=""  >Nama Jabatan</label>
    <input readonly name="nama_jabatan" id="nama_jabatan" class="form-control" value="{{$data['nama_jabatan']}}"  /> 
</div>  

<div class="mb-3">
    <label for=""  >Kode Jabatan</label>
    <input readonly name="kode_jabatan" id="kode_jabatan" class="form-control" value="{{$data['kode_jabatan']}}"  /> 
</div>  

<div class="mb-3">
    <label for="" class="form-label">Deskripsi  </label>
    <textarea readonly  class="form-control"  name="deskripsi_jabatan"> {{$data['deskripsi_jabatan']}} </textarea> 
</div>

<div class="mb-3">
    <input type="submit" id="{{$data['id_jabatan']}}" class="btn btn-danger del-row" value="Hapus"> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_jabatan' : id
        }   
        var uri = url +'/jabatan-del-act'; 
        
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
                            title: "Jabatan berhasil dihapus",
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

