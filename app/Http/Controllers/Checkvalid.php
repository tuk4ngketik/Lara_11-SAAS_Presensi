<?php 

namespace App\Http\Controllers; 
use Illuminate\Support\Facades\DB;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth; 

class Checkvalid extends Controller
{   
 
    
  function is_valid($id_perusahaan){ 
    $pt = $this->pt();
    if($pt == false){
        return false;
    }
    // return $pt;
    if($pt['id_perusahaan'] == $id_perusahaan )
    return true;
  }
 
  function pt(){
      $pt = Perusahaan::where('id_pendaftar', Auth::user()->id_pendaftar)
              ->leftJoin('perusahaan_department', 'perusahaan_department.id_perusahaan', 'perusahaan.id_perusahaan')
              ->select('perusahaan.*', 'perusahaan_department.id_department', 'perusahaan_department.nama_department');
      $count = $pt->count();
      if($count < 1 ){
          return  false;
      }
      $row = $pt->get();
      return $row[0]; 
  } 


  //Lokasi kerja
  function lokasi($id_perusahaan){
    $row = DB::table('absensi_lokasi')
                ->where('id_perusahaan', $id_perusahaan)
                ->get();
                return $row;
  }
  //Waktu kerja
  function waktu_kerja($id_perusahaan){
    $row = DB::table('absensi_waktu')
                ->where('id_perusahaan', $id_perusahaan)
                ->orderBy('shift')
                ->get();
                return $row;
  }
 
}