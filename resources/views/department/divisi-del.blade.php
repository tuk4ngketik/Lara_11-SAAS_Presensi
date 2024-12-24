<?php    
 if( $karyawan > 0):
?>
 <h5 align=center> Divisi tidak bisa dihapus</h5> <hr> 
 <h6>{{$karyawan}} Karyawan</h6>  
<?php 
return;
endif; 
?>
<div class="mb-3">
    <label for=""  >Nama Department</label>
    <input value="{{$data['nama_department']}}" class="form-control" id=""  readonly="readonly"> 
</div> 

<div class="mb-3">
    <label for=""  >Nama Divisi</label>
    <input value="{{$data['nama_divisi']}}" readonly="readonly" class="form-control" id=""  name="nama_divisi" placeholder="Nama Divisi"> 
</div> 


<div class="mb-3">
    <label for="" class="form-label">Deskripsi  </label>
    <textarea  class="form-control" readonly="readonly"  name="deskripsi_divisi" > {{$data['deskripsi_divisi']}} </textarea>

</div>
  

<div class="mb-3">
    <input type="submit" id="{{$data['id_divisi']}}" class="btn btn-danger del-row" value="Hapus"> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_divisi' : id
        }   
        var uri = url +'/divisi-del-act'; 
        
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
                            title: "Divisi berhasil dihapus",
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
             
         