<?php 

namespace App\Http\Controllers;
 
// use App\Models\Admin;
// use App\Models\Perangkat;
// use App\Models\Event;  
use Illuminate\Support\Facades\DB;
// use Auth;

/** 
     $ApiService = new ApiService();
     $res =  $ApiService->reverseGeomora($nama_lokasi);    
     return $res; 
 */ 

class ApiService extends Controller
{   
    // Format Dasar
    //  [
    //     'apikey' => 'apikey',
    //     'pckname' => 'pckname',
    //     'apiversion' => 'apiversion', 
    // ]; 

    function create_perusahaan($path, $id_perusahaan){   

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL =>  env('ATTEND_FACE').$path,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('id_perusahaan' => $id_perusahaan),
          CURLOPT_HTTPHEADER => array(
            'apikey: a773b2b19e4cd7a45c48f4f9d1610866',
            'pckname: Y29tLmV4YW1wbGUuc2Fhc19wcmVzZW5zaQ==',
            'apiversion: 10',
            'appversion: 1.0.1'
          ),
        )); 
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response; 
    }
    
    /**
     * NOMINATIM Geo Coder | OK
     */
    function geonomi($lat, $lgt){ 
            $curl = curl_init(); 
            curl_setopt_array($curl, array( 
                CURLOPT_URL => env('GEONOMI')."reverse?lat=$lat&lon=$lgt&format=json", 
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Apikey: ',
                    'Geokey: ', 
                ),
            )); 
            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;       
    }

    /**
     * Reverse Geo Coder | OK
    */
    function reverseGeomora($nama_lokasi){  
        $curl = curl_init(); 
        curl_setopt_array($curl, array( 
        CURLOPT_URL => env('REVERSEGEOMORA').urlencode($nama_lokasi), 
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
                'Apikey: bm9taW5hdGltLmFwaS5tb3JhdGVsaW5kby5jby5pZDo3MDcw',
                'Geokey: a3VjaW5nSHV0YW4',
                'Cookie: salesRetail=ts1bk9p6oskl1fbf63cuo2bo04d1sbmj'
            ),
        )); 
        $response = curl_exec($curl); 
        curl_close($curl);
        echo $response;       
    }

    /**
     * Geo Coder | OK
    */
    function geomora($lat, $lgt){ 
        $curl = curl_init(); 
        curl_setopt_array($curl, array( 
        CURLOPT_URL => env('GEOMORA')."?lat=$lat&lon=$lgt&format=json", 
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
                'Apikey: bm9taW5hdGltLmFwaS5tb3JhdGVsaW5kby5jby5pZDo3MDcw',
                'Geokey: a3VjaW5nSHV0YW4',
                'Cookie: salesRetail=ts1bk9p6oskl1fbf63cuo2bo04d1sbmj'
            ),
        )); 
        $response = curl_exec($curl); 
        curl_close($curl);
        echo $response;       
    }
    
}