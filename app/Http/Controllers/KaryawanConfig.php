<?php 
namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Karyawan;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule; 

class KaryawanConfig extends Controller
{  
    function set_lokasi_kerja($id_perusahaan, $id_karyawan){ 
        $valid = new Checkvalid();
        $check =  $valid->is_valid(  $id_perusahaan);  
        if($check == false){
            return ( 'Ada kesalahan !!!');
        }
        $lokasi_kerja = $valid->lokasi($id_perusahaan);
        $waktu_kerja = $valid->waktu_kerja($id_perusahaan); 
        $karyawan = Karyawan::where('id_karyawan', $id_karyawan)->get(); 
        return view('karyawan.karyawan-set-lokasi',  [
                        'karyawan' => $karyawan[0],
                        'data' => $lokasi_kerja,
                        'id_perusahaan' => $id_perusahaan,
                        'id_karyawan' => $id_karyawan,
                        'waktu' => $waktu_kerja 
                    ]); 
    }
    function set_lokasi_kerja_act(Request $request){ 
        // return $request;
        $valid = new Checkvalid();
        $check =  $valid->is_valid(  $request->id_perusahaan);  
        if($check == false){
            return $this->retJSON(  true, 'Invalid request',  [] ); 
        }
        $id_perusahaan = $request->id_perusahaan;
        $id_karyawan = $request->id_karyawan;
        $id_lokasi = $request->id_lokasi;
        $id_waktu = $request->id_waktu;

        $res = Karyawan::where('id_karyawan', $id_karyawan)
                        ->update([
                            'id_lokasi' => $id_lokasi,
                            'id_waktu' => $id_waktu,
                        ]);
        
        return $this->retJSON( true, 'Set lokasi berhasil', [$res,  $id_perusahaan, $id_karyawan, $id_lokasi ] ); 
        
                
    }
    
    function set_nonaktif($id_perusahaan, $id_karyawan){ 
        // return  Auth::user()->password;
        $valid = new Checkvalid(); 
        $check =  $valid->is_valid(  $id_perusahaan);  
        if($check == false){
            return ( 'Ada kesalahan !!!');
        }  
        $karyawan = Karyawan::where('id_karyawan', $id_karyawan)
            ->leftJoin('perusahaan_department', 'karyawans.id_department', '=','perusahaan_department.id_department')
            ->leftJoin('perusahaan_department_divisi', 'karyawans.id_divisi', '=','perusahaan_department_divisi.id_divisi')
            ->leftJoin('perusahaan_jabatan', 'karyawans.id_jabatan', '=','perusahaan_jabatan.id_jabatan')
            // ->select('karyawans.nama_karyawan','karyawans.id_perusahaan','karyawans.id_karyawan', 
            ->select('karyawans.*', 
                    'perusahaan_department.nama_department', 
                    'perusahaan_department_divisi.nama_divisi', 
                    'perusahaan_jabatan.nama_jabatan'
                    )
        ->get(); 
        // return $karyawan;
        return view('karyawan.karyawan-set-non-aktif',  [ 'karyawan' => $karyawan[0] ]); 
    }
    function set_nonaktif_act(Request $request){  
        
        $validated = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'id_perusahaan' => 'required',
            'nama_karyawan' => 'required',
            'alamat_karyawan' => 'required',
            'telp_karyawan' => 'nullable',
            'tgl_lahir' => 'required',
            'alasan_non_aktif' => 'required', 
            'tgl_non_aktif' => 'required|date',
            'keterangan' => 'required', 
            'password' => 'required',
            'nama_department' => 'required',
            'nama_divisi' => 'nullable', 
            'nama_jabatan' => 'required',
        ]);
        
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,  'Err Validation',  $validated->errors() );
        }   
        $cek_password  = Hash::check(  $request->password, Auth::user()->password ); 
        if($cek_password !=  true ){
            return $this->retJSON(  false, 'Err  Validation',  ["password" => ["Password tidak sesuai"] ] );
        }    
        // start transaction
        $transaction = DB::transaction(function () use ( $request) {
            
            Karyawan::where('id_karyawan', $request->id_karyawan)
                            ->delete(); 

            DB::table('karyawan_nonaktif_recs')
                                ->insert (['id_karyawan' => $request->id_karyawan,
                                            'nama_karyawan' => $request->nama_karyawan,
                                            'telp_karyawan' => $request->telp_karyawan,
                                            'alamat_karyawan' => $request->alamat_karyawan,
                                            'tgl_lahir' => $request->tgl_lahir,
                                            'id_perusahaan' => $request->id_perusahaan,
                                            'alasan_non_aktif' => $request->alasan_non_aktif, 
                                            'tgl_non_aktif' => $request->tgl_non_aktif,
                                            'keterangan' => $request->keterangan,  
                                            'nama_department' => $request->nama_department,
                                            'nama_divisi' => $request->nama_divisi, 
                                            'nama_jabatan' => $request->nama_jabatan,
                                            'created_at'=> date('Y-m-d H:i:s'),
                                ]); 
             
        });
        // end transaction 
        return $this->retJSON(  true, 'Non Aktifkan karyawan berhasil',   [] );
    } 

    function set_jadwal($id_perusahaan, $id_karyawan){
        $valid = new Checkvalid();
        $check =  $valid->is_valid(  $id_perusahaan);  
        if($check == false){
            return ( 'Ada kesalahan !!!');
        }
        
        $karyawan = Karyawan::where('id_karyawan', $id_karyawan)->get();
        $pt = $valid->pt();
        $lokasi_kerja = $valid->lokasi($id_perusahaan);
        $waktu_kerja = $valid->waktu_kerja($id_perusahaan); 
        return view('karyawan.karyawan-set-jadwal',  [
                        'karyawan' => $karyawan[0],
                        'pt' => $pt,
                        'lokasi' => $lokasi_kerja,
                        'waktu' => $waktu_kerja,
                        'id_perusahaan' => $id_perusahaan,
                        'id_karyawan' => $id_karyawan 
                    ]); 

    }
    function set_jadwal_act(Request $request){  
        $validated = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'id_perusahaan' => 'required',
            'tgl_awal' => 'required|date',
            // 'tgl_akhir' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
            'lokasi_kerja' =>  'required', // as id_lokasi
            'waktu_kerja' =>  'required', // as id_lokasi
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON(  false,  'Errors', $validated->errors()  );
        }  
        $insert = DB::table('absensi_jadwal')
                        ->insert([
                            'id_karyawan' => $request->id_karyawan,
                            'id_perusahaan' => $request->id_perusahaan,
                            'tgl_awal' => $request->tgl_awal,
                            'tgl_akhir' => $request->tgl_akhir,
                            'id_lokasi' =>  $request->lokasi_kerja,  // as id_lokasi,  '0' = Lokasi tdk ditentukan
                            'id_waktu' =>  $request->waktu_kerja,     // as id_waktu   '0' = Waktu tdk ditentukan
                        ]);
        if($insert == true){ 
            return $this->retJSON(  true, 'Jadwal berhasil dibuat', null );
        } 
    }

    function jadwal(){  
        $valid = new Checkvalid();
        $pt = $valid->pt();
        
        $data = DB::table('absensi_jadwal')
                    ->where('absensi_jadwal.id_perusahaan', $pt['id_perusahaan']) 
                    ->leftJoin('karyawans', 'karyawans.id_karyawan','absensi_jadwal.id_karyawan')
                    ->leftJoin('perusahaan_department', 'perusahaan_department.id_department','karyawans.id_department')
                    ->leftJoin('perusahaan_jabatan', 'perusahaan_jabatan.id_jabatan','karyawans.id_jabatan') 
                    ->leftJoin('absensi_lokasi', 'absensi_lokasi.id_lokasi','absensi_jadwal.id_lokasi') 
                    ->leftJoin('absensi_waktu', 'absensi_waktu.id_waktu','absensi_jadwal.id_waktu') 
                    ->select('absensi_jadwal.*' ,'karyawans.nama_karyawan', 'perusahaan_department.nama_department', 
                    'perusahaan_jabatan.nama_jabatan', 'absensi_lokasi.nama_lokasi', 'absensi_waktu.shift')
                    ->get();
                    // return $data;
        return view('karyawan.karyawan-jadwal',[
                    'pt'=> $pt,
                    'data' => $data
                ]);
    }
    
    function edit_jadwal($id_perusahaan, $id_jadwal){  
        $valid = new Checkvalid();
        $check = $valid->is_valid($id_perusahaan); 
        if($check == false){
            return redirect('karyawan-jadwal')->with('danger','Terjadi kesalahan');
        }
        
        $lokasi_kerja = $valid->lokasi($id_perusahaan);
        $waktu_kerja = $valid->waktu_kerja($id_perusahaan);  

        $pt = $valid->pt();
        $data = Jadwal::where('absensi_jadwal.id_jadwal', $id_jadwal)  
                    ->leftJoin('karyawans', 'karyawans.id_karyawan','absensi_jadwal.id_karyawan') 
                    ->select('karyawans.nama_karyawan', 'absensi_jadwal.*',  )
                    ->get(); 
                     
        return view('karyawan.karyawan-edit-jadwal',[
                    'pt'=> $pt,
                    'data' => $data[0] , 
                    'lokasi' => $lokasi_kerja,
                    'waktu' => $waktu_kerja, 
                ]);
    }
    function edit_jadwal_act(Request $request){
        $validated = Validator::make($request->all(), [ 
            'id_jadwal' => 'required',
            'id_karyawan' => 'required',
            'id_perusahaan' => 'required',
            'tgl_awal' => 'required|date', 
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
            'lokasi_kerja' =>  'required', // as id_lokasi
            'waktu_kerja' =>  'required', // as id_lokasi
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON(  false,   'Errors',  $validated->errors()  );
        }  
        $update = Jadwal::where('id_jadwal', $request->id_jadwal)
                        ->update([
                            'tgl_awal' =>  $request->tgl_awal,
                            'tgl_akhir' =>  $request->tgl_akhir,
                            'id_lokasi' =>  $request->lokasi_kerja,  
                            'id_waktu' =>  $request->waktu_kerja
                        ]);
        if($update == true){ 
            return response()->json([
                'success' => true,  'msg' => 'Jadwal berhasil diperbaharui',  'data' => null
            ]);
        } 
    }

    function del_jadwal($id_jadwal){ 
        $data = DB::table('absensi_jadwal')
                    ->where('absensi_jadwal.id_jadwal', $id_jadwal) 
                    ->leftJoin('karyawans', 'karyawans.id_karyawan','absensi_jadwal.id_karyawan')
                    ->leftJoin('perusahaan_department', 'perusahaan_department.id_department','karyawans.id_department')
                    ->leftJoin('perusahaan_jabatan', 'perusahaan_jabatan.id_jabatan','karyawans.id_jabatan') 
                    ->leftJoin('absensi_lokasi', 'absensi_lokasi.id_lokasi','absensi_jadwal.id_lokasi') 
                    ->leftJoin('absensi_waktu', 'absensi_waktu.id_waktu','absensi_jadwal.id_waktu') 
                    ->select('absensi_jadwal.*' ,'karyawans.nama_karyawan', 'perusahaan_department.nama_department', 
                    'perusahaan_jabatan.nama_jabatan', 'absensi_lokasi.nama_lokasi', 'absensi_waktu.shift')
                    ->get();
                    // return $data;
        return view('karyawan.karyawan-del-jadwal',  [
            'data' => $data
        ]); 
    }
    function del_jadwal_act(Request $request){
        $del = Jadwal::find($request->id_jadwal); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON( false,  'Error koneksi ',  [] );
        }    
        return $this->retJSON(  true, 'Jadwal berhasil dihapus',   [] );
    }
    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}
