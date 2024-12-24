<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Perusahaan;
// use App\Models\Department;
// use App\Models\Absensilokasi; 
  
// use Illuminate\Support\Facades\DB; 
// use Illuminate\Support\Facades\Auth; 

// use Illuminate\Database\Query\Builder; 
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Validator;
 
 
class FaceapiController extends Controller
{
    function face_detect(){
        return view('faceapi.face-detect');   
    }
    function face_detect_act(){ 
    }

    function face_extract(){
        return view('faceapi.face-extract');   
    }
    function face_extract_act(){ 
    }
 
    // function del_act(Request $request){
    //     $del = Absensilokasi::find($request->id_lokasi); 
    //     $res = $del->delete();        
    //     if($res !=  true ){
    //         return response()->json([ 'status' => false,
    //                     'message' => 'Error koneksi ',
    //                     'data' => []
    //             ]);
    //     }    
    //     return response()->json([ 'status' => true,
    //                 'message' => 'Lokasi Kerja berhasil dihapus',
    //                 'data' => []
    //         ]); 
    // }
 
    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}
