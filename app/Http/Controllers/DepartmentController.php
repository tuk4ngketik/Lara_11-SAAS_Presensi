<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Department;
use App\Models\Divisi; 
use App\Models\Karyawan; 

  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
 

class DepartmentController extends Controller
{
    
    function index(){ 
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat department sebelum membuat perusahaan');
        }
        $dept = Department::where('id_perusahaan', $pt['id_perusahaan'])->get();
        // return $dept;
        return view('department.department-index',[ 'data' => $dept , 'pt' => $pt ] );
    } 

    function department_add(){
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat Department sebelum membuat perusahaan');
        }
        return view('department.department-add',[ 'data' => $pt ]);
    }

    function act(Request $request){  
        $validated = Validator::make($request->all(), [
           'nama_department' => [
                'required','min:2','max:50',
                 Rule::unique('perusahaan_department')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan ))
            ], 
            'deskripsi_department' => 'max:200', 
        ]); 
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,  'Errors',   $validated->errors() ); 
        } 
        $dept = Department::insert([
            'id_perusahaan' => $request->id_perusahaan,   
            'nama_department' => $request->nama_department,    
            'deskripsi_department' => $request->deskripsi_department,
            'created_by' => Auth::user()->id_pendaftar ,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($dept == true){ 
            return $this->retJSON( true,  'Department berhasil ditambahkan',   null); 
        }
    }

    function edit($id){
        $dept = Department::where('id_department', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_department.id_perusahaan')
                    // ->join('karyawans')    
                    ->select('perusahaan_department.*','perusahaan.nama_perusahaan')
                    ->get();  
        return view('department.department-edit',[ 'data' => $dept[0] ]);
    }

    function edit_act(Request $request){  
        $validated = Validator::make($request->all(), [
           'nama_department' => [
            'required','min:2','max:50',
                Rule::unique('perusahaan_department')
                ->where( fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan )  )
                ->where( fn (Builder $query) => $query->where('id_department', '!=', $request->id_department )  ) 
            ], 
            'deskripsi_department' => 'max:200', 
        ]); 

        if ($validated->fails()) { // All Error 
                return $this->retJSON( false,  'Errors',  $validated->errors() ); 
            } 
        $dept = Department::where('id_department', $request->id_department)
                ->update([  
                    'nama_department' => $request->nama_department,    
                    'deskripsi_department' => $request->deskripsi_department,
                    'updated_by' => Auth::user()->id_pendaftar , 
                ]);
        if($dept == true){ 
            return $this->retJSON( true,  'Department berhasil diperbaharui', null); 
        } 
    }

    function del($id){
        $karywan = Karyawan::where('id_department', $id)->count();   
        $div = Divisi::where('id_department', $id)->count();   
        $child = ['karyawan' => $karywan, 'divisi' => $div] ;
        // return $child;
        $dept = Department::where('id_department', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_department.id_perusahaan') 
                    ->select('perusahaan_department.*','perusahaan.nama_perusahaan')
                    ->get();  
        return view('department.department-del',[ 'data' => $dept[0], 'child' => $child ]);  
    }
    function del_act(Request $request){
        $del = Department::find($request->id_department); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON( false,  'Error koneksi ',  []); 
        }    
        return $this->retJSON( true, 'Departemen berhasil dihapus', []); 
    }

    // Divisi 
    function divisi(){ 
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat department sebelum membuat perusahaan');
        }
        $div = Divisi::where('perusahaan_department_divisi.id_perusahaan', $pt['id_perusahaan'])
                 ->join('perusahaan_department', 'perusahaan_department.id_department','perusahaan_department_divisi.id_department')
                 ->select('perusahaan_department.nama_department','perusahaan_department_divisi.*')
                 ->get();
        // return $div;
        return view('department.divisi',[ 'data' => $div , 'pt' => $pt ] );
    } 
    function divisi_add($id_departemen){
        $pt = Department::where('id_department', $id_departemen)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_department.id_perusahaan') 
                    ->select('perusahaan_department.*','perusahaan.nama_perusahaan')
                    ->get();   
        return view('department.divisi-add',[ 'data' => $pt[0] ]);
    }
    function divisi_act(Request $request){ 
        $validated = Validator::make($request->all(), [
           'nama_divisi' => [
                'required','min:2','max:50',
                 Rule::unique('perusahaan_department_divisi')
                        ->where(
                                fn (Builder $query) => $query->where('id_department',  $request->id_department )
                            )  
            ], 
            'deskripsi_divisi' =>  'max:200', 
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false, 'Errors',  $validated->errors() ); 
        } 
        $div = Divisi::insert([
            'id_department' => $request->id_department,  
            'id_perusahaan' => $request->id_perusahaan,   
            'nama_divisi' => $request->nama_divisi,    
            'deskripsi_divisi' => $request->deskripsi_divisi,
            'created_by' => Auth::user()->id_pendaftar ,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($div == true){  
            return $this->retJSON( true,   'Divisi berhasil ditambahkan', null ); 
        }
    }
    function divisi_edit($id_divisi){
        $div = Divisi::where('id_divisi', $id_divisi)
                    ->join('perusahaan_department', 'perusahaan_department.id_department','perusahaan_department_divisi.id_department') 
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_department.id_perusahaan') 
                    ->select('perusahaan_department_divisi.*','perusahaan_department.nama_department','perusahaan.nama_perusahaan')
                    ->get();    
                    // return $div;
        return view('department.divisi-edit',[ 'data' => $div[0] ]); 
    }
    function divisi_edit_act(Request $request){ 
        $validated = Validator::make($request->all(), [
           'nama_divisi' => [
                'required','min:2','max:50',
                 Rule::unique('perusahaan_department_divisi')
                 ->where( fn (Builder $query) => $query->where('id_department',  $request->id_department ) )
                 ->where(  fn (Builder $query) => $query->where('id_divisi', '!=',  $request->id_divisi ) )
            ], 
            'deskripsi_divisi' => 'max:200', 
        ]);        
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false, 'Errors',  $validated->errors() ); 
        } 
        $div = Divisi::where('id_divisi', $request->id_divisi)
                ->update([    
                    'nama_divisi' => $request->nama_divisi,    
                    'deskripsi_divisi' => $request->deskripsi_divisi,
                    'updated_by' => Auth::user()->id_pendaftar , 
                ]);
        if($div == true){ 
            return response()->json([
                'success' => true,  'msg' => 'Divisi berhasil diperbaharui',  'data' =>null 
            ]); 
        }
        // return redirect('edit-divisi/'. $request->idi_divisi)->with('status', 'Terdapat masalah'); 
    }
    function divisi_del($id_divisi){ 
        $div = Divisi::where('id_divisi', $id_divisi)
                    ->join('perusahaan_department', 'perusahaan_department.id_department','perusahaan_department_divisi.id_department') 
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_department.id_perusahaan') 
                    ->select('perusahaan_department_divisi.*','perusahaan_department.nama_department','perusahaan.nama_perusahaan')
                    ->get();     
        $karyawan = Karyawan::where('id_divisi', $id_divisi)->count();    
        return view('department.divisi-del',[ 'data' => $div[0], 'karyawan' => $karyawan ]);  
    }
    function divisi_del_act(Request $request){
        $del = divisi::find($request->id_divisi); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON( false, 'Error koneksi', [] );
        }    
        return $this->retJSON( true,  'Divisi berhasil dihapus',  []); 
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


    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }

}
