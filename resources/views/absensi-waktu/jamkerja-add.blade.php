
@extends('layout')
@section('title-web', 'Jam Kerja')
@section('title-page')  
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Jam Kerja
@endsection
@section('nav-item-jamkerja', 'menu-open') 
@section('menu-open-jamkerja', 'active') 
@section('menu-open-jamkerja-add', 'active') 

@section('content')
 

<div class="card">
    <div class="card-body">  
        <div class="mt-8"></div> 
        <div class="row">
             
            <div class="p-3"> 
                    <h5>Buat Jam Kerja</h5>
                    <hr>
                </div>  

            <div class="col-sm-6"> 
                <form action="{{url('jamkerja-act')}}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="id_perusahaan"  value="{{$pt['id_perusahaan']}}" placeholder="id_perusahaan" /> 
                    
                    <div class="mb-3">
                        <label for=""  >Shift</label>
                        <select name="shift" id="" class="form-control">
                            <option value="">Pilih Shift</option>
                            @foreach($shift as $v)
                                <option value="{{$v}}" @selected(old('shift') == $v )>{{$v}}</option>
                            @endforeach
                        </select> 
                        <div class="text text-danger shift"></div>  
                    </div> 
 
                    <div class="mb-3">
                        <label for=""  >Jam Masuk</label>
                        <input type="time" name="masuk" placeholder="" class="form-control" value="{{old('masuk')}}"  />
                        
                        <div class="text text-danger masuk"></div> 
                    </div>  
                    <div class="mb-3">
                        <label for=""  >Jam Pulang</label>
                        <input name="pulang" type="time" placeholder="" class="form-control" value="{{old('pulang')}}"  />
                        <div class="text text-danger pulang"></div> 
                    </div>  

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp
                        <a href="{{url('jamkerja')}}" class="btn btn-outline-info">Batal</a>
                    </div> 

                </form>
        
        </div>
            <div class="col-sm-6">
                <h5>
                    <i class="fas fa-info-circle fa-lg text-warning"></i>
                    <i class="far fa-lightbulb  fa-lg  text-warning"></i>
                </h5>
                
                
                <div class="alert alert-warning" role="alert">
                    A simple warning alert—check it out!
                </div>

            </div>
        </div>

    </div>
</div>

<script>  
    const inputs = [
            'shift','masuk', 'pulang'  
        ]
    $('#form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("jamkerja")}}', inputs);  
    });  
</script>
@endsection  