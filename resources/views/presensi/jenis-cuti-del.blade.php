       
<form action="{{url('/jenis-cuti-edit-act')}}"  method="post" id="form-modal"> 
    @csrf 
    <div class="mb-3">
        <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
        <input type="" value="{{$row->jenis_cuti}}" class="form-control" id="jenis_cuti" name="jenis_cuti">
        <div class="text text-danger jenis_cuti"></div> 
    </div>
    <div class="mb-3">
        <label for="satuan_cuti" class="form-label">Satuan</label>
        <select class="form-select" id="satuan_cuti" name="satuan_cuti">
            <option value="{{$row->satuan_cuti}}">{{$row->satuan_cuti}}</option>     
            <option value="Hari">Hari</option>
            <option value="Bulan">Bulan</option>
        </select>
        <div class="text text-danger satuan_cuti"></div> 
    </div>
    <div class="mb-3">
        <label for="maksimal_cuti" class="form-label">Maksimal Cuti</label>
        <input type="number"  value="{{$row->maksimal_cuti}}"  class="form-control" id="maksimal_cuti" name="maksimal_cuti">
        <div class="text text-danger maksimal_cuti"></div> 
    </div>
    <a href="#" id="_submit" class="btn btn-primary _submit">Perbaharui</a> 
    <a href="#" data-bs-dismiss="modal" class="btn btn-outline-warning">Batal</a>
</form>   
<script>
  
  var inputs = [
        'id_perusahaan', 'jenis_cuti', 'satuan_cuti', 'maksimal_cuti',  
  ] 

  $(document).ready(function(){
     
    $('._submit').click(function() {  
        var jenis_cuti = $('#jenis_cuti').val()
        var satuan_cuti = $('#satuan_cuti').val()
        var maksimal_cuti = $('#maksimal_cuti').val() 

        _cursorWait();  
        var action = $('#form-modal').attr('action');
        var formData = $('form#form-modal').serialize();
        console.log('formData', formData)
        var new_data = _submitFromModalAdd(action, formData,  null, inputs )
        if(new_data ==  null) { return }
        var id =  new_data['id_jenis_cuti'];
        var icon_edit = '<a href="#" id="'+id+'" class="btn btn-outline-warning btn-sm jenis-cuti-edit" title="Edit Jenis Cuti"'
                                  +'data-bs-toggle="modal" data-bs-target="#staticBackdrop">'
                                  +'<i class="fas fa-edit"></i></a>'; 
        var add_row = [
            new_data['jenis_cuti'],
            new_data['maksimal_cuti'],
            new_data['satuan_cuti'],
            icon_edit
        ]
        const table = new DataTable('#example');
        _addNewRow(table, add_row) 
        console.log('new_data:', new_data)  
    });
 
})
</script>