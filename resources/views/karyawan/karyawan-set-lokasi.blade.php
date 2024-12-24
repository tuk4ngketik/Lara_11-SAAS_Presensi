<div class="p-2">
 <div class="text text-danger err-all"></div> 
</div>
<h5>{{$karyawan['nama_karyawan']}}</h5>
<div class="input-group mb-3">
</div>
    <!-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2"> -->
    <select name="set_lokasi" id="id_lokasi" class="form-control"> 
                <option value="">-- Pilih lokasi Kerja --</option>
                <!-- <option value="0">Semua Lokasi</option> -->
                <option value="0"  @selected( $karyawan['id_lokasi']== "0")>Semua Lokasi</option> 
                @foreach($data as  $v) 
                    <option value="{{$v->id_lokasi}}" @selected($karyawan['id_lokasi'] == $v->id_lokasi)>{{$v->nama_lokasi}}</option>
                @endforeach
    </select>   
    <br>
    
    <!-- Jam Kerja --> 
    <select name="waktu_kerja" id="id_waktu"  class="form-control">  
                                <option value="">-- Pilih Jam Kerja --</option>
                                <!-- <option value="0"  @selected( old('waktu_kerja') == "0")>Tidak ditentukan</option>  -->
                                @foreach($waktu as  $v) 
                                 <option value="{{$v->id_waktu}}" @selected( $karyawan['id_waktu'] == $v->id_waktu)>Shift: {{$v->shift}}  (  {{$v->masuk}} -  {{$v->pulang}} )</option>
                                @endforeach
    </select>

    <br>
    <input type="hidden" id="id_perusahaan" value="{{$id_perusahaan}}" />
    <input type="hidden" id="id_karyawan" value="{{$id_karyawan}}" />
  <button class="btn btn-outline-primary set-lokasi-kerja" type="button">Kirim</button> 
  <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
<!-- {{$data}} -->
<div class="p-2"></div>

<script>
    $(document).ready(function(){
        
        var id_lokasi = $("select#id_lokasi").val(); 
        var nm_lokasi = $("#id_lokasi option:selected").text()
        var id_waktu = $("select#id_waktu").val(); 
        // $("select#id_lokasi").change( function(){
        $("select[name='set_lokasi'] option").click( function(){
            id_lokasi =  $(this).val()      
            nm_lokasi =  $(this).text()        
            $('.err-all').text('');
        })
        $("select[name='waktu_kerja'] option").click( function(){
            id_waktu =  $(this).val()        
            $('.err-all').text('');
        })
        
        $('.set-lokasi-kerja').click(function(){   
            if(id_lokasi == '' || id_waktu == '' ) {
                // alert('Pilih Lokasi & Jam kerja')
                $('.err-all').text('Pilih Lokasi & Jam kerja');
                return;
            }    
            var id_karyawan = $('#id_karyawan').val()
            var uri = url +'/karyawan-set-lokasi-act';
            var formData = {
                '_token' : "{{ csrf_token() }}",
                'id_karyawan' : id_karyawan,
                'id_perusahaan' : $('#id_perusahaan').val(),
                'id_lokasi' :id_lokasi,
                'id_waktu' :id_waktu,
            }  
            $.ajax({
                        type: "POST",
                        url: uri,
                        // headers : headers,
                        data: formData,
                        success: function(data){
                            
                            console.log('nm_lokasi', nm_lokasi);
                            console.log('data', data);

                            if(data.status == true){
                                $('#staticBackdrop').modal('toggle');  
                                $('span.'+id_karyawan+'-nama_lokasi' ).text(nm_lokasi)
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Set Lokasi Kerja",
                                    showConfirmButton: false,
                                    timer: 2000
                                });  
                            } 
                        },
            });
        })

    })
</script>