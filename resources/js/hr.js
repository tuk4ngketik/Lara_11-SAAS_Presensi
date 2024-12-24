const d = new Date();
let year = d.getFullYear();

$(document).ready(function(){  

    // Karyawan 
    $('#id_department').change(function(){
        var id_perusahaan = $('#id_perusahaan').val()
        var id_department = $(this).val() 
        if(id_perusahaan == '' || id_department == '' ) { return }
        var uri = url + '/karyawan-get-divisi/'+id_perusahaan+'/'+id_department  
        karyawanAppendDivisi(uri); 
    })
    function karyawanAppendDivisi(uri){
        $.get(uri, function(data){
            var opt = '<option value=""> -- Pilih Divisi -- </option>'
            console.log(data.length, data) 
            if(data.length < 1) { return ;}
            $(data).each(function(i){
                var k =data[i].id_divisi
                var v = data[i].nama_divisi
                console.log(k, v)
                opt += '<option value="'+k+'">'+v+'</option>';    
            });
            $('#id_divisi').html(opt);
        })
    }
    function loadDivisi(){ 
        var id_perusahaan = $('#id_perusahaan').val()
        var id_department = $('#id_department').val() 
        if(id_perusahaan == '' || id_department == '' ) { return }
        var uri = url + '/karyawan-get-divisi/'+id_perusahaan+'/'+id_department 
        karyawanAppendDivisi(uri)
    }  
    $('.karyawan-set-lokasi').click(function(){ //ok
        var id = $(this).attr('id'); 
        $('.modal-title').text('Set Lokasi Kerja')   
        $('.modal-body').load(url + '/karyawan-set-lokasi/'+id)  
    })  
    $('.karyawan-non-aktif').click(function(){
        var id = $(this).attr('id'); 
        $('.modal-title').text('Non Aktifkan Karyawan')   
        $('.modal-body').load(url + '/karyawan-set-non-aktif/'+id)  
        // $('.modal-body').text('Hapus KAryawan, anda tidak dapat mengedit data karyawan ini, tampilkan foto, dll')  
    }) 
    $('.karyawan-del-jadwal').click(function(){  
        var id = $(this).attr('id'); 
        console.log('karyawan-del-jadwal:', url + '/karyawan-del-jadwal/'+id);
        $('.modal-title').text('Hapus Jadwal Kerja')   
        $('.modal-body').load(url + '/karyawan-del-jadwal/'+id)  
    })
 
    // Departemen
    $('.del-department').click(function(){ 
        var id = $(this).attr('id');  
        $('.modal-title').text('Hapus Departmenen')   
        $('.modal-body').load(url + '/department-del/'+id)    
    });

    // Divisi
    $('.del-divisi').click(function(){ 
        var id = $(this).attr('id');  
        $('.modal-title').text('Hapus Divisi')   
        $('.modal-body').load(url + '/divisi-del/'+id)    
    });

    // Jabatan
    $('.del-jabatan').click(function(){ 
        var id = $(this).attr('id');  
        $('.modal-title').text('Hapus Jabatan')   
        $('.modal-body').load(url + '/jabatan-del/'+id)   
    });

    // Jam Kerja
    $('.del-jamkerja').click(function(){ 
        var id = $(this).attr('id');  
        $('.modal-title').text('Hapus Jam Kerja')   
        $('.modal-body').load(url + '/jamkerja-del/'+id)    
    });

    // Lokasi Kerja
    $('.del-lokasikerja').click(function(){ 
        var id = $(this).attr('id');  
        $('.modal-title').text('Hapus Lokasi Kerja')   
        $('.modal-body').load(url + '/lokasi-del/'+id)    
    });
    
    //Cuti
    $('.tambah-jenis-cuti').click(function(){ 
        $('.modal-body').text('<i>Load...</i>');   
        $('.modal-title').text('Tambah Jenis Cuti')   
        // $('.modal-body').load(url + '/tambah-jenis-cuti/');   
        $.get(url + '/tambah-jenis-cuti/', function(data){
            $('.modal-body').html(data);
        })
    })
    $('.jenis-cuti-edit').click(function(){ 
        var id= $(this).attr('id');
        $('.modal-title').text('Edit Jenis Cuti')    
        $.get(url + '/jenis-cuti-edit/'+id, function(data){
            $('.modal-body').html(data);
        })
    })
    $('.jenis-cuti-del').click(function(){
        var id= $(this).attr('id');  
        $('.modal-title').text('Hapus Jenis Cuti')  
        $('.modal-body').load(url + '/jenis-cuti-del/'+id);     
    })
    // $('.create-master-cuti').click(function(){
    //     var id =$(this).attr('id'); 
    //     var data =  {
    //         '_token' : "{{_token}}",
    //         id_perusahaan : id,
    //         'tahun' : year
    //     }
    //     $.post(url + '/master-cuti-create', data, function(data){
    //         console.log('DBG master_cuti: ', data)
    //     })
    //     $.ajax({
    //         type: 'POST', 
    //         url: url + '/master-cuti-create',
    //         data: data,
    //         dataType: 'JSON',
    //         async: false,
    //         success: function(data) {
    //             console.log('DBG master_cuti: ', data)
    //         }
    //     }) 
    // })

});//end

function karyawanAppendDivisi(uri){
    $.get(uri, function(data){
        var opt = '<option value=""> -- Pilih Divisi -- </option>'
        console.log(data.length, data) 
        if(data.length < 1) { return ;}
        $(data).each(function(i){
            var k =data[i].id_divisi
            var v = data[i].nama_divisi
            console.log(k, v)
            opt += '<option value="'+k+'">'+v+'</option>';    
        });
        $('#id_divisi').html(opt);
    })
}
function loadDivisi(){ 
    var id_perusahaan = $('#id_perusahaan').val()
    var id_department = $('#id_department').val() 
    if(id_perusahaan == '' || id_department == '' ) { return }
    var uri = url + '/karyawan-get-divisi/'+id_perusahaan+'/'+id_department 
    console.log('uri Divisi: ', uri);
    karyawanAppendDivisi(uri)
} 
 

// Form Object
function _submitFromObject(action, formData,  urlSuccess = null, objInput){   
    $.ajax({
        type: 'POST',
        // url: $(this).attr('action'), 
        url: action, 
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function(data) {  
         if( data.status == true){   
            Swal.fire({
                        position: "top-end",
                        icon: "success", 
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                        });   
            if(urlSuccess != null){
                location.href = urlSuccess;  
            } 
            return;
         }  
         // Errr validation
          var d = data.data;      
          $(objInput).each(function(i){
            var k =  inputs[i]
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k][0])
            }
          })   
          _cursorDef();
        }
    });  
} 

// Form Serialize
function _submitFrom(action, formData,  urlSuccess=null, objInput){   
    $.ajax({
        type: 'POST',
        // url: $(this).attr('action'), 
        url: action, 
        data: formData,
        dataType: 'JSON',
        success: function(data) {  
         if(data.status == true){  
            Swal.fire({
                        position: "top-end",
                        icon: "success", 
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                        });    
            if(urlSuccess != null){
                location.href = urlSuccess;  
            } 
            return true;
         }  
         // Errr validation
          var d = data.data;      
          $(objInput).each(function(i){
            var k =  inputs[i]
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k][0])
            }
          })   
          _cursorDef();
          return true;
        }  
    });  
} 
function _submitFromRedirect(action, formData,  objInput){   
    $.ajax({
        type: 'POST',
        // url: $(this).attr('action'), 
        url: action, 
        data: formData,
        dataType: 'JSON',
        success: function(data) {  
         if(data.status == true){    
            Swal.fire({
                        position: "top-end",
                        icon: "success", 
                        title: data.msg, 
                        showConfirmButton: false,
                        timer: 3000
                        }); 
            location.href = data.redirect;  
            _cursorDef();   
            return;
         }  
         // Errr validation
          var d = data.data;      
          $(objInput).each(function(i){
            var k =  inputs[i]
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k][0])
            }
          })   
          _cursorDef();
        } 
    });  
} 

function _submitFromModal(action, formData,  urlSuccess = null, objInput, hide_tr = null ){   
    $.ajax({
        type: 'POST', 
        url: action, 
        data: formData,
        dataType: 'JSON',
        success: function(data) {  
            console.log('data:',     data)
         if(data.status == true){  
            if(urlSuccess != null){
                location.href = urlSuccess;  
            } 
            Swal.fire({
                        position: "top-end",
                        icon: "success", 
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                        });   
            $('#staticBackdrop').modal('toggle');
            hide_tr;
            _cursorDef();
            return;
         }  
         // Errr validation
          var d = data.data;      
          $(objInput).each(function(i){
            var k =  inputs[i]
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k][0])
            }
          })   
          _cursorDef();
        }  
    });  
} 

// Add & Update
function _submitFromModalAddUpdate(action, formData,  urlSuccess = null, objInput ){  //OK
    var new_data = null;
    $.ajax({
        type: 'POST', 
        url: action, 
        data: formData,
        dataType: 'JSON',
        async: false,
        success: function(data) {  
            // console.log('data:',     data)
         if(data.status == true){  
            if(urlSuccess != null){
                location.href = urlSuccess;  
            } 
            Swal.fire({
                        position: "top-end",
                        icon: "success", 
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 3000
                        });   
            $('#staticBackdrop').modal('toggle');
            _cursorDef();
            new_data = data.data; 
            return new_data;
         }  
         // Errr validation
          var d = data.data;      
          $(objInput).each(function(i){
            var k =  inputs[i]
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k][0])
            }
          })   
          _cursorDef();
        //   return true; 
        }   
    });  
    return new_data ;
}  
function _addNewRow(table, new_data) {//OK
    table.row 
        .add(new_data )
        .draw(false);  
}

function _swalAlertErr(title, text){
    // icn ('success, erroe')
    // tmr (2000)
    Swal.fire({ 
            icon: 'error', 
            title: title,
            text: text,
            // showConfirmButton: false,
            // timer: tmr
            });   
} 
function _swalAlertInfo(title, text){
    // icn ('success, erroe')
    // tmr (2000)
    Swal.fire({ 
            icon: 'info', 
            title: title,
            html: text,
            // showConfirmButton: false,
            // timer: tmr
            });   
} 
function _cursorDef(){ document.body.style.cursor='default';}
function _cursorWait(){document.body.style.cursor='wait';}

// _swalLoad blm diaktifkan
function _swalLoad(){
    let timerInterval;
    Swal.fire({
      title: "Auto close alert!",
      html: "Memerisa foto karyawan.",
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
          timer.textContent = '${Swal.getTimerLeft()}';
        }, 100);
      },
      willClose: () => {
        clearInterval(timerInterval);
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
      }
    });
}
  