
const indonesia = [-0.789275,113.921326];  
var map = L.map('map').setView( indonesia, 5);
var marker_search = L.marker();
var marker_zoom = 16;

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map); 

function onMapClick(e) { 
    _closeResult()
    marker_search.remove(); 
    var lat =  e.latlng['lat'].toFixed(8)
    var lgt =  e.latlng['lng'].toFixed(8)
    var latlong = [lat, lgt]
    var html_str = latlong.toString();
    html_str += '<br /><a href="#" onclick="_pilihLokasiIni('+lat+', '+lgt+')">pilih lokasi ini</a>' 
    marker_search = L.marker(latlong).addTo(map); 
    marker_search.bindPopup( html_str ).openPopup(); 
    map.setView(latlong, marker_zoom);  
    // $('#latitude').val(e.latlng['lat'])
    // $('#longitude').val(e.latlng['lng'])
}
map.on('click', onMapClick);

// var latlong_cari
function _searchLocation(){ 
    _showLoadCariLokasi()
    _cursorWait() 
    var latlong_cari
    var input_lokasi =  $('#input_lokasi').val()
    if(input_lokasi == '' || input_lokasi == null) { return; } 
    var uri = url + '/cari-lokasi/'+ input_lokasi;
    console.log('uri:', uri)
    _cursorWait()
    $.ajax({
        type: 'GET', 
        url: uri,  
        dataType: 'JSON',
        contentType: 'JSON',
        async: false,
        // processData: false,
        success: function(data) {   
            console.log('data geoReverse:', data.length )
            console.log('data geoReverse:', data )
            if( data.length > 0 ){
                // latlong_cari = [data[0]['lat'], data[0]['lon']] 
                // var li = '';
                var li = '<p class="position-absolute  bottom-0 end-0" align=right onclick="_closeResult()"> <b>x</b> &nbsp</p>';
                $(data).each(function(i){
                    var lat = data[i]['lat']
                    var lgt = data[i]['lon']
                    var display_name = data[i]['display_name'] 
                    li += '<p class="ms-3 "><a href="#" onclick="_clickItemSearchLocation('+lat+', '+lgt+')">'+display_name+'</a></p>'
                    console.log('display_name: ',i, display_name)
                });
                // li += close_result;
                $('.result-search').html(li);
                _hideLoadCariLokasi()
                _cursorDef() 
            } else{ 
                map.setView(indonesia, 5);
                // latlong_cari = null;
                _closeResult()
                _swalAlertInfo('', 'Lokasi tidak ditemukan, coba cara lain<br> Contoh:<br /> "Pasar Minggu, jakarta selatan"');
                _hideLoadCariLokasi()

                _cursorDef() 
            }  
        }
    });  
    _hideLoadCariLokasi()
    _cursorDef() 
    // return latlong_cari;
}

function _clickItemSearchLocation(lat, lgt){
    console.log(lat+','+lgt) 
    marker_search.remove();  
    latlong = [lat, lgt] 
    marker_search = L.marker(latlong).addTo(map); 
    var html_str = latlong.toString();
    html_str += '<br /><a href="#" onclick="_pilihLokasiIni('+lat+', '+lgt+')">pilih lokasi ini</a>' 
    marker_search.bindPopup( html_str ).openPopup();
    map.setView(latlong, marker_zoom); 
    // $('#latitude').val(lat)
    // $('#longitude').val(lgt) 
}
function _pilihLokasiIni(lat, lgt){  
    $('#latitude').val(lat.toFixed(8))
    $('#longitude').val(lgt.toFixed(8)) 
}

// function _searchInput(latlong) { 
//     marker_search.remove();  
//     if(latlong == null) {
//         _swalAlertInfo('', 'Lokasi tidak ditemukan, coba cara lain<br> Contoh:<br /> "Pasar Minggu, jakarta selatan"');
//         return; 
//     }  
//     marker_search = L.marker(latlong).addTo(map); 
//     marker_search.bindPopup(latlong.toString() ).openPopup();
//     map.setView(latlong, marker_zoom); 
//     $('#latitude').val(latlong[0])
//     $('#longitude').val(latlong[1])
// } 

function _loadMarkerEdit(){
    marker_search.remove();
    var lat = $('#latitude').val()
    var lgt = $('#longitude').val()   
    var latlong = [lat, lgt]
    marker_search = L.marker(latlong).addTo(map); 
    // marker_search.bindPopup(latlong.toString() ).openPopup();

    
    var html_str = latlong.toString();
    html_str += '<br /><a href="#" onclick="_pilihLokasiIni('+lat+', '+lgt+')">pilih lokasi ini</a>' 
    marker_search.bindPopup( html_str ).openPopup();

    map.setView(latlong, marker_zoom); 
} 

function _showLoadCariLokasi(){
    $('p.load-cari-lokasi').show(); 
}
function _hideLoadCariLokasi(){ 
    $('p.load-cari-lokasi').hide();
}

function _closeResult(){
    $('.result-search').html('');
}