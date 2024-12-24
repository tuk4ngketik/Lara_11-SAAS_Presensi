<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Department;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Absensilokasi; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;  
use Illuminate\Validation\Rules\File; 
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{  
    function _status_karyawan( $id_perusahaan){ 
          $data  = Karyawan::where('karyawans.id_perusahaan', $id_perusahaan)   
          ->where('karyawans.id_perusahaan', $id_perusahaan)  
          ->leftJoin('perusahaan_department', 'karyawans.id_department', '=','perusahaan_department.id_department')
          ->leftJoin('perusahaan_department_divisi', 'karyawans.id_divisi', '=','perusahaan_department_divisi.id_divisi')
          ->leftJoin('perusahaan_jabatan', 'karyawans.id_jabatan', '=','perusahaan_jabatan.id_jabatan')
          ->leftJoin('absensi_lokasi', 'absensi_lokasi.id_lokasi', '=','karyawans.id_lokasi') 
          ->select('karyawans.*',  'perusahaan_jabatan.nama_jabatan', 'perusahaan_department.nama_department', 
                    'perusahaan_department_divisi.nama_divisi', 'absensi_lokasi.nama_lokasi')
          ->get(); 
       return $data ;
    }
    
    function index($status = null){ 
        
        $valid = new Checkvalid();
        $pt =  $valid->pt();   
        
        // Cek Perusahaan
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat menambahkan karyawan sebelum membuat perusahaan');
        }
        // Cek Department
        if($pt['id_department'] == null){
            return redirect('buat-department')->with('warning', 'Anda tidak dapat menambahkan karyawan sebelum membuat department'); 
        }  
        // return $this->_status_karyawan( $pt['id_perusahaan']);
        return view('karyawan.karyawan-index',[ 'data' => $this->_status_karyawan( $pt['id_perusahaan']), 'pt'=> $pt] );
    } 

    function karyawan_detail($id_karyawan){  
        $valid = new Checkvalid();
        $pt =  $valid->pt();  
        $karyawan = Karyawan::where('karyawans.id_karyawan', $id_karyawan)     
                        ->leftJoin('perusahaan_department', 'karyawans.id_department', '=','perusahaan_department.id_department')
                        ->leftJoin('perusahaan_department_divisi', 'karyawans.id_divisi', '=','perusahaan_department_divisi.id_divisi')
                        ->leftJoin('perusahaan_jabatan', 'karyawans.id_jabatan', '=','perusahaan_jabatan.id_jabatan')
                        ->leftJoin('absensi_lokasi', 'karyawans.id_lokasi', '=','absensi_lokasi.id_lokasi')
                        ->leftJoin('absensi_waktu', 'karyawans.id_waktu', '=','absensi_waktu.id_waktu')
                        ->select('karyawans.*', 'perusahaan_department.nama_department', 'perusahaan_department_divisi.nama_divisi', 
                                 'perusahaan_jabatan.nama_jabatan', 'absensi_lokasi.*', 'absensi_waktu.*')
                                 
                        // ->leftJoin('absensi_lokasi', 'absensi_lokasi.id_lokasi', '=','karyawans.id_lokasi') 
                        // ->select('karyawans.*',  'perusahaan_jabatan.nama_jabatan', 'perusahaan_department.nama_department', 
                        //         'perusahaan_department_divisi.nama_divisi', 'absensi_lokasi.nama_lokasi')
                        ->get(); 
        // return $karyawan[0];
        return view('karyawan.karyawan-detail',[ 'pt' => $pt, 'data' => $karyawan[0] ] );
    }

    function karyawan_add(){
        
        $valid = new Checkvalid();
        $pt =  $valid->pt();  
        
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat menambahkan karyawan sebelum membuat perusahaan');
        }
        // Cek Department
        if($pt['id_department'] == null){
            return redirect('buat-department')->with('warning', 'Anda tidak dapat menambahkan karyawan sebelum membuat department'); 
        }

        $dept = $this-> dept($pt['id_perusahaan']);
        $div = $this-> div($pt['id_perusahaan']);
        $jbt = $this-> jbt($pt['id_perusahaan']); 
        $pend =  $this->pend();  
        return view('karyawan.karyawan-add',[ 'pt' => $pt, 'dept' => $dept, 'div' => $div,  'jbt' => $jbt, 
                                                'pend' => $pend, 'tooltip' => $this->tooltip(),
                                                'stat_karyawans' => $this->status_karyawans(),
                                                'status_aktif' => $this->status_aktif(),
                                                'status_pernikahan' => $this->status_pernikahan()
                                            ]);
    }

    function karyawan_act(Request $request){      
        $validated = Validator::make($request->all(), [
                // 'foto_karyawan' => 'required|file|max:10240', 
                'foto_karyawan' => ['required',File::image() 
                                    ->min('50kb')
                                    ->max('1mb')], 
                'id_perusahaan'=>  'required',
                'nama_department'=>  'required' , // AS id_department
                'nama_jabatan'=> 'required' ,  // AS id_jabatan  // nullable
                // // 'id_lokasi'=> $request->id_lokasi,  // titik absen
                'nik' =>['required','numeric','digits_between:4,10',
                            Rule::unique('karyawans')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan )) 
                        ],
                'nama_karyawan' =>'required|regex:/^[a-zA-z\ ]+$/i|min:3|max:30' ,
                'pendidikan'=>'required' ,
                'tgl_lahir'=>'required|date' ,
                'tempat_lahir'=>'nullable|min:4|max:50' , // nullable
                'telp_karyawan'=>'nullable|digits_between:10,15|unique:karyawans,telp_karyawan' ,
                // 'email_karyawan' =>'required|max:50|email:rfc,dns|unique:karyawans,email_karyawan', // live
                'email_karyawan' =>'required|max:50|email:filter_unicode|unique:karyawans,email_karyawan',
                'password_karyawan'=> 'required|min:6|max:15',
                'alamat_karyawan' => 'required|max:200' , // nullable
                'status_karyawan'=> 'required' ,
                'status_pernikahan' => 'nullable', // nullable
                // 'status_aktif' => 'required' ,
                'tgl_bergabung' => 'required|date',  
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false, 'Errors', $validated->errors()  );
        }  
        $foto_karyawan = $request->file('foto_karyawan');  
        $blob = file_get_contents($foto_karyawan);  // manggilnya di encode:  base64_encode($blob)  
        $image = base64_encode($blob);   
        $password_karyawan = Hash::make($request->password_karyawan);

        try{ 
            $insert = Karyawan::insert([ 
                'id_perusahaan'=> $request->id_perusahaan,
                'id_department'=> $request->nama_department, // AS id_department
                'id_jabatan'=> $request->nama_jabatan,  // AS id_jabatan
                'id_divisi'=> $request->nama_divisi,  // AS id_jabatan
                // 'id_lokasi'=> $request->id_lokasi,  // titik absen
                'nik' => $request->nik,
                'nama_karyawan' => $request->nama_karyawan,
                'foto_karyawan' =>  $image,
                'pendidikan'=> $request->pendidikan,
                'tgl_lahir'=> $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'telp_karyawan'=> $request->telp_karyawan,
                'email_karyawan' => $request->email_karyawan,
                'password_karyawan'=> $password_karyawan,
                'alamat_karyawan' => $request->alamat_karyawan,
                'status_karyawan'=> $request->status_karyawan,
                'status_pernikahan' => $request->status_pernikahan, 
                'tgl_bergabung' =>$request->tgl_bergabung,
                'created_at'=> date('Y-m-d H:i:s'),
                'created_by'=> Auth::user()->id_pendaftar, 
                // 'updated_by' => Auth::user()->id_pendaftar
            ]);
            if($insert == true){ 
                return $this->retJSON( true, "{$request->nama_karyawan}  berhasil ditambahkan", null );
            } 
        }
        catch (exception $e){ 
            return $this->retJSON( true,  "$e",  ["foto_karyawan" => ["Format file tidak mendukung"] ] );
        } 
    }

    function karyawan_edit(  $id_karyawan){ 
        $valid = new Checkvalid();
        $pt =  $valid->pt();
        $id_perusahaan = $pt->id_perusahaan;
        $data = Karyawan::where('id_karyawan', $id_karyawan)->get(); 
        return view('karyawan.karyawan-edit',[ 'data' => $data[0], 
                                                'pt' => $pt, 
                                                'dept' =>  $this->dept($id_perusahaan),  
                                                'div' =>  $this->get_divisi($id_perusahaan, $data[0]->id_department),  
                                                'jbt' => $this-> jbt($id_perusahaan),  
                                                'pend' => $this->pend(), 
                                                'tooltip' => $this->tooltip(),
                                                'stat_karyawans' => $this->status_karyawans(),
                                                'status_aktif' => $this->status_aktif(),
                                                'status_pernikahan' => $this->status_pernikahan()
                                            ]); 
    }

    function karyawan_edit_act(Request $request){  
        $validated = Validator::make($request->all(), [ 
            // 'foto_karyawan' => 'nullable|file|max:10240',
                'foto_karyawan' => ['nullable',File::image() 
                                    ->min('50kb')
                                    ->max('1mb')], 
            'id_perusahaan'=>  'required',
            'nama_department'=>  'required' , // AS id_department
            'nama_jabatan'=> 'required' ,  // AS id_jabatan  // nullable
            'nik' =>[  'required','numeric','digits_between:4,10',
                        Rule::unique('karyawans') 
                            ->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan )) 
                            ->where(fn (Builder $query) => $query->where('id_karyawan', '!=', $request->id_karyawan )) 
                    ],
                    // 'email_karyawan' =>'required|max:50|email:rfc,dns|unique:karyawans,email_karyawan,'.$request->id_karyawan.',id_karyawan',// live
            'email_karyawan' =>'required|max:50|email:filter_unicode|unique:karyawans,email_karyawan,'.$request->id_karyawan.',id_karyawan',// live 
            'telp_karyawan'=>'required|digits_between:10,15|unique:karyawans,telp_karyawan,'.$request->id_karyawan.',id_karyawan' ,
            'nama_karyawan' =>'required|regex:/^[a-zA-z\ ]+$/i|min:3|max:30' ,
            'pendidikan'=> 'required' ,
            'tgl_lahir' => 'required|date' ,
            'tempat_lahir'=> 'nullable|min:4|max:50' , // nullable 
            'alamat_karyawan' => 'required|max:200' , // nullable
            'status_karyawan'=> 'required' ,
            'status_pernikahan' => 'nullable', // nullable 
            'tgl_bergabung' => 'required|date' , 
        ]);
        if ($validated->fails()) { // All Error  
            return $this->retJSON(false, 'Errors',  $validated->errors() ); 
        }   

        try{ 
            $update = [    
                'id_department'=> $request->nama_department, // AS id_department
                'id_divisi'=> $request->nama_divisi, // AS id_divisi
                'id_jabatan'=> $request->nama_jabatan,  // AS id_jabatan
                // 'id_lokasi'=> $request->id_lokasi,  // titik absen
                'nik' => $request->nik,
                'nama_karyawan' => $request->nama_karyawan,
                'pendidikan'=> $request->pendidikan,
                'tgl_lahir'=> $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'telp_karyawan'=> $request->telp_karyawan,
                'email_karyawan' => $request->email_karyawan, 
                'alamat_karyawan' => $request->alamat_karyawan,
                'status_karyawan'=> $request->status_karyawan,
                'status_pernikahan' => $request->status_pernikahan, 
                'tgl_bergabung' =>$request->tgl_bergabung,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->id_pendaftar, 
            ];
            $foto_karyawan = $request->file('foto_karyawan');   
            if($foto_karyawan != ''){
               $blob =   file_get_contents($foto_karyawan); 
               $image = base64_encode($blob); 
               $update['foto_karyawan'] =  $image; 
           }    
            $update = Karyawan::where('id_karyawan', $request->id_karyawan)
                              ->update( $update ); 
                              return $this->retJSON( true, 'Karyawan berhasil diperbaharui', []); 
        }
        catch(Exception $e){ 
            return $this->retJSON( false, $e,  ["foto_karyawan" => ["Format file tidak mendukung"] ] );
        } 
    }

    function del($id){
        $dept = karyawan::where('id_karyawan', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','perusahaan_karyawan.id_perusahaan') 
                    ->select('perusahaan_karyawan.*','perusahaan.nama_perusahaan')
                    ->get();  
        return view('karyawan.karyawan-del',[ 'data' => $dept[0] ]);  
    }  
    
    // Department
    function dept($id_perusahaan){
        $dept = Department::where('id_perusahaan', $id_perusahaan)
                ->select('id_department', 'nama_department')  
                ->orderBy('nama_department')  
                ->get();
        return $dept;
    }
    // Divisi
    function div($id_perusahaan){
        $row = Divisi::where('id_perusahaan', $id_perusahaan)
                ->select('id_divisi', 'nama_divisi')  
                ->orderBy('nama_divisi')  
                ->get();
        return $row;
    } 
    // Jabatan
    function jbt($id_perusahaan){
        $jbt = Jabatan::where('id_perusahaan', $id_perusahaan)
                ->select('id_jabatan', 'nama_jabatan')  
                ->orderBy('nama_jabatan')  
                ->get();
        return $jbt;
    } 
    // attr Pendidikan
    function pend(){ return DB::table('attr_pendidikan')->select('pendidikan')->get(); }

    // attr get divisi
    function get_divisi($id_perusahaan, $id_department){
       $row =  Divisi::where('id_perusahaan', $id_perusahaan)
                ->where('id_department', $id_department)
                ->select('id_divisi', 'nama_divisi')
                ->get();
                return $row;
    }

    function tooltip(){
        return [
            'email' => 'Digunakan sebagai "Username" saat  karyawan login pada apps Android',
            'password' => 'Password login karyawan pada apps Android',
            'status_aktif' => 'Apakah karyawan masih bekerja atau tidak'
        ];
    } 

    function status_karyawans(){  return [ 'Karyawan Tetap','Karyawan Kontrak','Harian', 'Magang' ]; }

    function status_aktif(){   return [ 'Aktif', 'Tidak' ]; }

    function status_pernikahan(){   return [ 'Menikah', 'Belum Menikah' ]; }
    
    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}
