<?php  
    $div = $child['divisi'];
    $karyawan = $child['karyawan'];
 if($div > 0 || $karyawan > 0):
?>
 <h5 align=center> Departemen tidak bisa dihapus</h5> <hr>
 <h6>{{$div}} Divisi</h6>
 <h6>{{$karyawan}} Karyawan</h6>  
<?php 
return;
endif; 
?>
<div class="mb-3">
    <label for=""  >Nama department</label>
    <input readonly="readonly" value="{{$data['nama_department']}}" class="form-control" id="" name="nama_department" placeholder="Nama department">

</div> 


<div class="mb-3">
    <label for="" class="form-label">Deskripsi  </label>
    <textarea  readonly="readonly"  class="form-control"  name="deskripsi_department"> {{$data['deskripsi_department']}} </textarea>

</div>



<div class="mb-3">
    <input type="submit" id="{{$data['id_department']}}" class="btn btn-danger del-row" value="Hapus"> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_department' : id
        }   
        var uri = url +'/department-del-act'; 
        
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
                            title: "Departemen berhasil dihapus",
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