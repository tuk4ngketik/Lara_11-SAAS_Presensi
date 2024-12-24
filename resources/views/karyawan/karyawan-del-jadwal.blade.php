
<table class="table">
   <tr>
      <td>Nama Karyawan</td> <td align="left">{{$data[0]->nama_karyawan}}</td>
   </tr>
   <tr>
      <td>Tanggal</td> <td align="left">{{$data[0]->tgl_awal}} s/d {{$data[0]->tgl_akhir}}</td>
   </tr>
   <tr>
      <td>Lokasi Kerja</td> <td align="left">{{$data[0]->nama_lokasi}}</td>
   </tr>
   <tr>
      <td>Jam Kerja</td> <td align="left">Shift {{$data[0]->shift}}</td>
   </tr>

</table>
<div class="mb-3">
    <input type="submit" id="{{$data[0]->id_jadwal}}" class="btn btn-danger del-row" value="Hapus">  
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</div>   

<script>  
 $('.del-row').click(function(){ 
    var id = $(this).attr('id')
    var formData = {
            '_token' : "{{ csrf_token() }}",
            'id_jadwal' : id
        }   
        var uri = url +'/karyawan-del-jadwal-act'; 
        
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
                            title: "Jadwal berhasil dihapus",
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