<?php    
 if( $karyawan > 0):
?>
 <h5 align=center>Jam kerja tidak bisa dihapus</h5> <hr> 
 <h6>{{$karyawan}} Karyawan</h6>  
<?php 
return;
endif; 
?>
<div class="mb-3">
    <label for=""  >Shift</label>
    <input readonly name="nama_jabatan" id="shift" class="form-control" value="{{$data['shift']}}"  /> 
</div>  

<div class="mb-3">
    <label for=""  >Jam Masuk</label>
    <input readonly name="kode_jabatan" id="masuk" class="form-control" value="{{$data['masuk']}}"  /> 
</div>   

<div class="mb-3">
    <label for=""  >Jam Pulang</label>
    <input readonly name="kode_jabatan" id="pulang" class="form-control" value="{{$data['pulang']}}"  /> 
</div>   

<div class="mb-3">
    <input type="submit" id="{{$data['id_waktu']}}" class="btn btn-danger del-row" value="Hapus"> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_waktu' : id
        }   
        var uri = url +'/jamkerja-del-act'; 
        
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
                                title: "Jam Kerja berhasil dihapus",
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

