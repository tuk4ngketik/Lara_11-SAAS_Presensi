
@extends('layout')
@section('title-web', 'Jam Kerja')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Jam Kerja
@endsection
@section('nav-item-jamkerja', 'menu-open') 
@section('menu-open-jamkerja', 'active') 
@section('menu-open-jamkerja-list', 'active') 

@section('content') 

<div class="card">
    <div class="card-body">  

        <div class="row"> 

            @if(session('status'))
                <div class="alert alert-success">{{  session('status') }}</div>
            @endif
  
            <div class="p-3"> 
                    <h5>Daftar Jam Kerja</h5>
                    <hr>
                </div>  

            <table id="example" class="display order-column" style="width:100%">
                <thead>
                    <tr>
                    <td>Shift</td>  <td>Masuk</td>  <td>Pulang</td>   <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                     <tr class="{{$v->id_waktu}}">
                        <td> {{ $v->shift }} </td>
                        <td>{{$v->masuk}}</td>
                        <td>{{$v->pulang}}</td>   
                        <td>
                            <a href="{{url('edit-jamkerja')}}/{{$v->id_perusahaan}}/{{$v->id_waktu}}" class="btn btn-outline-warning btn-sm" title="Hapus Departemen">
                                <i class="fas fa-edit"></i>
                            </a>  
                            <a href="#" id="{{$v->id_waktu}}" class="btn btn-outline-danger btn-sm del-jamkerja" title="Hapus Jam Kerja"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-trash"></i>
                            </a> 
                        </td>
                     </tr>
                    @endforeach
                </tbody>
            </table>

        </div> 
    </div>
</div>

@endsection  