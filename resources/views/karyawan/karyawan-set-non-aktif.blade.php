
<div class="p-3 bg-opacity-10 border border-warning border-1 rounded">
 <i class="fas fa-info-circle text-warning fa-lg"></i> Changing border color and width
</div> 


    <form action="{{url('karyawan-set-nonaktif-act')}}" method="POST" id="form-modal">
            @csrf
            <input type="hidden" name="id_karyawan" value="{{$karyawan['id_karyawan']}}" />
            <input type="hidden" name="id_perusahaan" value="{{$karyawan['id_perusahaan']}}" />
            <input type="hidden" name="nama_karyawan" value="{{$karyawan['nama_karyawan']}}" />
            <input type="hidden" name="telp_karyawan" value="{{$karyawan['telp_karyawan']}}" />
            <input type="hidden" name="tgl_lahir" value="{{$karyawan['tgl_lahir']}}" />
            <input type="hidden" name="alamat_karyawan" value="{{$karyawan['alamat_karyawan']}}" />
            <input type="hidden" name="nama_department" value="{{$karyawan['nama_department']}}" />
            <input type="hidden" name="nama_divisi" value="{{$karyawan['nama_divisi']}}" />
            <input type="hidden" name="nama_jabatan" value="{{$karyawan['nama_jabatan']}}" />
        <table class="table">
            <tr> <td>Nama</td> <td class="fw-bold">{{$karyawan['nama_karyawan']}}</td> </tr>
            <tr> <td>Jabatan</td> <td class="fw-bold">{{$karyawan['nama_jabatan']}}</td> </tr>
            <tr> <td>Departemen</td> <td class="fw-bold">{{$karyawan['nama_department']}}</td> </tr>
            <tr> <td>Divisi</td> <td class="fw-bold">{{$karyawan['nama_divisi']}}</td> </tr>
            <tr> <td>Tgl. Non Aktif</td> <td>
            <input type="date" name="tgl_non_aktif" class="form-control" placeholder="Tanggal non aktif">
            <div class="text text-danger tgl_non_aktif"></div>
            </td> </tr>
            <tr>
                <td>Alasan</td><td>
                    <select name="alasan_non_aktif" class="form-control"> 
                                <option value="">-- Alasan Non Aktif --</option> 
                                <option value="Keluar">Keluar</option><option value="Pensiun">Pensiun</option><option value="Pecat">Pecat</option>  
                    </select>
                    <div class="text text-danger alasan_non_aktif"></div>
                </td>
            </tr>
            <tr><td>Keterangan</td> <td>
                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                <div class="text text-danger keterangan"></div></td>
            </tr>
            <tr><td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="password" class="form-control" clear="" /> 
                    <div class="text text-danger password"></div>
                </td>
            </tr>
        </table> 
        <button class="btn btn-outline-primary set-non-aktif" id="set-non-aktif" type="">Kirim</button> 
        <button class="btn btn-outline-warning" data-bs-dismiss="modal"  type="button">Batal</button> 
    </form>  
  
   
<script>
    var inputs = ['id_karyawan','id_perusahaan','alasan_non_aktif','tgl_non_aktif','keterangan',
                    'password','department','divisi','jabatan']
                    
    $('form#form-modal').submit(function(e){
        e.preventDefault(); 
        _cursorWait();
        var action = $(this).attr('action'); 
        var formData = $(this).serialize(); 
        _submitFromModal(action, formData,  null, inputs,  hide_tr() );   
        return false;
    })   
    function hide_tr(){
        var id ="{{$karyawan['id_karyawan']}}" 
        console.log('id_karyawan: ', id)
        $('table tr.'+id ).hide();
    }
</script>
