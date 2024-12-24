
@extends('layout')
@section('title-web', 'Lokasi Kerja')
@section('title-page') 
{{$pt['nama_perusahaan']}}  &nbsp > &nbsp  Lokasi Kerja
@endsection
@section('nav-item-lokasikerja', 'menu-open') 
@section('menu-open-lokasikerja', 'active') 
@section('menu-open-lokasikerja-add', 'active') 

@section('content')

<div class="card">
    <div class="card-body">  
        <div class="row"> 
            
            <div class="p-3">
                <h5>Tambah Lokasi Kerja</h5> 
                <hr>  
            </div>   

            <div class="col-sm-5"> 
                    <form action="{{url('lokasi-act')}}" method="POST" id="form">
                        @csrf
                        <input type="hidden" name="id_perusahaan"  value="{{$pt['id_perusahaan']}}" placeholder="id_perusahaan" /> 
                        
                        <div class="mb-3">
                            <label for=""  >Nama Lokasi Kerja</label>
                            <input name="nama_lokasi" placeholder="ex: Kantor Pusat"  class="form-control" value="{{old('nama_lokasi')}}"  />
                            <div class="text text-danger nama_lokasi"></div>
                        </div> 
    
                        <div class="mb-3">
                            <label for=""  >Latitude</label>
                            <input id="latitude" name="latitude" placeholder="ex: -6.183817551" class="form-control" value="{{old('lat')}}"  />
                            <div class="text text-danger latitude"></div>
                        </div> 
    
                        <div class="mb-3">
                            <label for=""  >Longitude</label>
                            <input id="longitude" name="longitude"  placeholder="ex:  106.85866436"   class="form-control"  />
                            <div class="text text-danger longitude"></div>
                        </div> 

                        <div class="mb-3">
                            <label for=""  >Maksimal jarak absensi (m)</label>
                            <input name="max_jarak"  placeholder="ex: 10"  class="form-control" value="{{old('max_jarak')}}"  />
                            <div class="text text-danger max_jarak"> </div> 
                        </div>  
                        
                        <div class="mb-3">
                            <label for=""  >Alamat Lokasi</label> 
                            <textarea  class="form-control"  name="alamat_lokasi" placeholder="Alamat lokasi kerja"></textarea>
                            <div class="text text-danger alamat_lokasi"></div> 
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi Lokasi Kerja</label>
                            <textarea  class="form-control"  name="deskripsi_lokasi" placeholder="Keterangan lokasi kerja"></textarea>
                            <div class="text text-danger deskripsi_lokasi"></div>  
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp
                            <a href="{{url('lokasi-kerja')}}" class="btn btn-outline-info">Batal</a>
                        </div>  
                    </form> 
            </div>

            <div class="col-sm-7">   
                <form action="" id="form-cari-lokasi"> 
                    <div class="input-group">
                        <span class="input-group-text">Cari Lokasi</span> 
                        <input class="form-control" id="input_lokasi" />
                        <span class="input-group-text"> 
                        <i class="fas fa-search" id="btn-cari-lokasi"></i>
                        </span> 
                    </div>  
                        <div class="position-relative ps-3 ms-3">   
                            <div class="position-absolute bg-secondary-subtle rounded-bottom" style="z-index:1000;">   
                                <div class="result-search small"></div> 
                                <p class="load-cari-lokasi text-center"><i class="fas fa-circle-notch fa-spin text-blue"></i></p> 
                            </div> 
                        </div>
                </form> 
                <div id="map" style="height:500px"></div> 
            </div>

        </div>

    </div>
</div> 
<style> 
    .result-search {
        max-height: 130px;
        overflow: auto; 
    }
    .result-search p a{ 
        text-decoration: none;
    }
    .result-search p a.hover{ 
        text-decoration: underline;
    }
    p.load-cari-lokasi{
        display : none; 
        /* visibility: none; */
    }
</style>  

<!-- START  MAP -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<script src="{{asset('don')}}/js/don-maps.js"></script>  

<script> 
    $('#form-cari-lokasi').submit(function(e){ 
        // marker_search.remove();
        e.preventDefault();
        var latlong =   _searchLocation() 
        // _searchInput(latlong) 
    })
    $('#btn-cari-lokasi').click(function(){ 
        // marker_search.remove();
        var latlong =   _searchLocation()
        // console.log('latlong:', latlong)
        // _searchInput(latlong)
    }) 
</script>
<!-- End MAP -->


<script>  
    const inputs = [
           'nama_lokasi','latitude','longitude','max_jarak','alamat_lokasi','deskripsi_lokasi' 
        ]
    $('#form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var formData = $(this).serialize();
        console.log('formData', formData)
        _submitFrom(action, formData, '{{url("lokasi-kerja")}}', inputs);  
    });  
</script>

@endsection  