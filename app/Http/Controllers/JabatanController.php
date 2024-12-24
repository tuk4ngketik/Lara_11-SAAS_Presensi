<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Department;
use App\Models\Jabatan;
use App\Models\Karyawan; 
use Illuminate\Support\Facades\Validator;

  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 

use Illuminate\Database\Query\Builder; 
use Illuminate\Validation\Rule;
 

class JabatanController extends Controller
{

    
    function index(){ 
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-jabatan')->with('status', 'Anda tidak dapat membuat jabatan sebelum membuat perusahaan');
        }
        $dept = jabatan::where('id_perusahaan', $pt['id_perusahaan'])->get();
        // return $dept;
        return view('jabatan.jabatan-index',[ 'data' => $dept , 'pt' => $pt ] );
    } 

    function add(){ 
        $pt = $this->pt();   
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat jabatan sebelum membuat perusahaan');
        }
        $dept =  $this->dept($pt['id_perusahaan']);
        return view('jabatan.jabatan-add',[ 'pt' => $pt, 'dept' => $dept ]);
    }

    function act(Request $request){  
        $validated = Validator::make($request->all(), [
           'nama_jabatan' => [
                'required','min:2','max:50',
                 Rule::unique('perusahaan_jabatan')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan ))
            ], 
            'kode_jabatan' => 'nullable','max:20','min:2', 
            'deskripsi_jabatan' => 'nullable|max:200', 
        ]);  
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false, 'Errors',   $validated->errors() );
        } 
        $dept = Jabatan::insert([
            'id_perusahaan' => $request->id_perusahaan,   
            'nama_jabatan' => $request->nama_jabatan,    
            'kode_jabatan' => $request->kode_jabatan,    
            'deskripsi_jabatan' => $request->deskripsi_jabatan,
            'created_by' => Auth::user()->id_pendaftar ,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($dept == true){ 
            return $this->retJSON ( true,  'Jabatan berhasil ditambahkan', null );
        }
    }

    function edit($id){
        $jbt = Jabatan::where('id_jabatan', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_jabatan.id_perusahaan')
                    // ->join('karyawans')    
                    ->select('perusahaan_jabatan.*','perusahaan.nama_perusahaan')
                    ->get();  
        return view('jabatan.jabatan-edit',[ 'jbt' => $jbt[0] ]);
    }

    function edit_act(Request $request){
        $validated = Validator::make($request->all(), [
            'nama_jabatan' =>'required|min:2|max:50|unique:perusahaan_jabatan,nama_jabatan,'.$request->id_jabatan.',id_jabatan', 
            'deskripsi_jabatan' => 'max:200', 
        ]);  
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,  'Errors',  $validated->errors());
        } 
        $dept = jabatan::where('id_jabatan', $request->id_jabatan)
                ->update([  
                    'nama_jabatan' => $request->nama_jabatan,    
                    'kode_jabatan' => $request->kode_jabatan,    
                    'deskripsi_jabatan' => $request->deskripsi_jabatan,
                    'updated_by' => Auth::user()->id_pendaftar , 
                ]);
        if($dept == true){ 
            return $this->retJSON(true,  'Jabatan berhasil diperbaharui', null );
        }
        // return redirect('edit-jabatan/'. $request->id_jabatan)->with('status', 'Terdapat masalah');  
    }

    function jabatan_del($id){
        $karyawan = Karyawan::where('id_jabatan', $id)->count();
        $row = Jabatan::where('id_jabatan', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_jabatan.id_perusahaan') 
                    ->select('perusahaan_jabatan.*','perusahaan.nama_perusahaan')
                    ->get(); 
                    // return $karyawan; 
        return view('jabatan.jabatan-del',[ 'data' => $row[0], 'karyawan' => $karyawan ]);  
    }
    function edit_del_act(Request $request){ 
        $del = Jabatan::find($request->id_jabatan); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON(  false,  'Error koneksi ',  [] );
        }    
        return $this->retJSON(  true, 'Jabatan berhasil dihapus',  [] );
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

    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}
