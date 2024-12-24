<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Department;
use App\Models\Absensilokasi; 
use App\Models\Karyawan; 
  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 

use Illuminate\Database\Query\Builder; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
 

class AbsensilokasiController extends Controller
{

    
    function index(){ 
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat Lokasi kerja sebelum membuat perusahaan');
        }
        $lok = Absensilokasi::where('id_perusahaan', $pt['id_perusahaan'])->get();  
        // return $lok;
        return view('absensi-lokasi.lokasi-index',[ 'pt' => $pt , 'data' => $lok ] );
    } 

    function add(){ 
        $pt = $this->pt();   
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat Lokasi kerja sebelum membuat perusahaan');
        }
        return view('absensi-lokasi.lokasi-add',[ 'pt' => $pt]);
    }

    function act(Request $request){ 
        $validated = Validator::make($request->all(), [
           'nama_lokasi' => [
                'required','min:2','max:50',
                 Rule::unique('absensi_lokasi')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan ))
            ], 
            'latitude' => 'required|decimal:6,15',
            'longitude' => 'required|decimal:6,15',
            'max_jarak' => 'required|numeric',
            'max_jarak' => 'required|numeric',
            'alamat_lokasi' => 'max:200',
            'deskripsi_lokasi' => 'max:200',
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,  'Errors',  $validated->errors() ); 
        } 
        $insert = Absensilokasi::insert([
            'id_perusahaan' => $request->id_perusahaan,   
            'nama_lokasi' => $request->nama_lokasi,   
            'lat' => $request->latitude,  
            'lgt' => $request->longitude,  
            'max_jarak' => $request->max_jarak,  
            'alamat_lokasi' => $request->alamat_lokasi,    
            'deskripsi_lokasi' => $request->deskripsi_lokasi,
            'created_by' => Auth::user()->id_pendaftar ,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($insert == true){ 
            return $this->retJSON(  true,  'Lokasi Kerja  berhasil ditambahkan',  $validated->errors());
        }
    }

    function edit($id_perusahaan , $id_lokasi){
        $pt = $this->pt(); 
        if($pt['id_perusahaan'] != $id_perusahaan ){
            return view('data-not-found');
        }
        $data = Absensilokasi::where('id_lokasi', $id_lokasi)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','absensi_lokasi.id_perusahaan')
                    // ->join('karyawans')    
                    ->select('absensi_lokasi.*','perusahaan.nama_perusahaan')
                    ->get();  
                    // return $data;
        return view('absensi-lokasi.lokasi-edit',[ 'data' => $data[0],'pt' => $pt  ]);
    }

    function edit_act(Request $request){
        $validated = Validator::make($request->all(), [ 
            'nama_lokasi' => [
                 'required','min:2','max:50',
                  Rule::unique('absensi_lokasi')
                  ->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan ))
                  ->where(fn (Builder $query) => $query->where('id_lokasi', '!=', $request->id_lokasi )) 
             ], 
            'latitude' => 'required|decimal:6,15',
            'longitude' => 'required|decimal:6,15',
            'max_jarak' => 'required|numeric',
            'alamat_lokasi' => 'nullable|max:200',
            'deskripsi_lokasi' => 'nullable|max:200',
        ]);  
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,   'Errors',    $validated->errors() ); 
        } 
        $data = Absensilokasi::where('id_lokasi', $request->id_lokasi)
                ->update([    
                    'nama_lokasi' => $request->nama_lokasi,   
                    'lat' => $request->latitude,  
                    'lgt' => $request->longitude,  
                    'max_jarak' => $request->max_jarak,  
                    'alamat_lokasi' => $request->alamat_lokasi,    
                    'deskripsi_lokasi' => $request->deskripsi_lokasi,
                    'updated_by' => Auth::user()->id_pendaftar , 
                ]);
        if($data == true){ 
            return $this->retJSON( true,  'Lokasi Kerja  berhasil diperbaharui', null );
        }  
    }

    function del($id){
        $dept = Absensilokasi::where('id_lokasi', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','absensi_lokasi.id_perusahaan') 
                    ->select('absensi_lokasi.*','perusahaan.nama_perusahaan')
                    ->get();  
        $karyawan = Karyawan::where('id_lokasi', $id)->count();
        return view('absensi-lokasi.lokasi-del',[ 'data' => $dept[0], 'karyawan' => $karyawan ]);  
    }
    function del_act(Request $request){
        $del = Absensilokasi::find($request->id_lokasi); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON( false, 'Error koneksi ',  []);
        }    
        return $this->retJSON( true, 'Lokasi Kerja berhasil dihapus',  []  );
    }

    // Data Perusahaan
    function pt(){
        $pt = Perusahaan::where('id_pendaftar', Auth::user()->id_pendaftar);
        $count = $pt->count();
        if($count < 1 ){
            return  false;
        }
        $row = $pt->get();
        return $row[0]; 
    }

    function dept($id_perusahaan){
        $dept = Department::where('id_perusahaan', $id_perusahaan)
                ->select('id_department', 'nama_department')  
                ->orderBy('nama_department')  
                ->get();
        return $dept;
    }

    // Geocoding
    function reverse_geomora($nama_lokasi){  
        $OtherCont = new ApiService();
        $res =  $OtherCont->reverseGeomora($nama_lokasi);    
        return $res; 
    }

    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }

}
