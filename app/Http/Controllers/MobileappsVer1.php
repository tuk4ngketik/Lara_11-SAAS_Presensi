<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;

use App\Models\Karyawan;
use App\Models\Absensilokasi;
use App\Models\Absensi;
 
use Illuminate\Database\Query\Builder; 
use Exception;

class MobileappsVer1 extends Controller
{ 
    
    // Format Dasar
    //  [
    //     'apikey' => 'AttendFace:2024',
    //     'pckname' => 'pckname',
    //     'apiversion' => 'apiversion', 
    //     'appversion' => 'appversion', 
    // ];  
    private $keys = ['apikey', 'pckname', 'apiversion', 'appversion'];

    private $val = ['a773b2b19e4cd7a45c48f4f9d1610866', 'Y29tLmV4YW1wbGUuc2Fhc19wcmVzZW5zaQ==', '10']; 
    
    private $appversions = ['1.0.0' , '1.0.1'] ;
     
    function getHeaders($request) { 
        $headers = $request->headers->all();   
        return $headers; 
        if ( !in_array( 'appversion',  $this->appversions )) {
            return  false; 
        }
        $_appversion = $headers['appversion'][0];  
        if ( !in_array( $_appversion,  $this->appversions )) 
        {
            return  false;
        }

        try{ 
            $res = [
                $headers['apikey'][0],
                $headers['pckname'][0],
                $headers['apiversion'][0],  
            ]; 
            if ( empty(array_diff($res, $this->val)) ){
                return true; // lanjut
            } 
            return false;  // stop
        }
        catch(Exception $e){
            return false;  // stop 
        } 
    }
    function retJson($status, $msg, $data ){
        return response()->json([
            'status' => $status, 
            'msg' => $msg,  
            'data' =>  $data 
        ]);
    }

    function login(Request $request){   
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        } 
        $validator = Validator::make($request->all(), [
            'email_karyawan' =>'required',  
            'password_karyawan' => 'required' 
        ]);  
        if ($validator->fails()) { // All Error 
            return $this->retJson(false, 'Error validasi', null);  
        } 
   
        $row = Karyawan::where('email_karyawan', $request->email_karyawan)     
                        ->leftJoin('perusahaan_department', 'karyawans.id_department', '=','perusahaan_department.id_department')
                        ->leftJoin('perusahaan_department_divisi', 'karyawans.id_divisi', '=','perusahaan_department_divisi.id_divisi')
                        ->leftJoin('perusahaan_jabatan', 'karyawans.id_jabatan', '=','perusahaan_jabatan.id_jabatan')
                        ->leftJoin('absensi_waktu', 'absensi_waktu.id_waktu', '=','karyawans.id_waktu')
                        ->select('karyawans.id_karyawan','karyawans.id_perusahaan','karyawans.email_karyawan','karyawans.nik',
                                'karyawans.password_karyawan','karyawans.nama_karyawan','karyawans.foto_karyawan',
                                'karyawans.tgl_bergabung', 'karyawans.tgl_bergabung',  'perusahaan_department.nama_department', 
                                'perusahaan_department_divisi.nama_divisi', 'perusahaan_jabatan.nama_jabatan', 'absensi_waktu.shift' ); 

        if( $row->count() < 1 ){ 
            return $this->retJson(false, 'Email belum terdaftar',  ["email" =>  'Email belum terdaftar']);  
        }

        // CEk password
        $row = $row->get(); 
        $cek_password  = Hash::check(  $request->password_karyawan, $row[0]->password_karyawan);
        
        if($cek_password !=  true ){ 
            return $this->retJson(false, 'Kata sandi salah',["password_karyawan" => "Kata sandi tidak sesuai" ]);   
        }         
        // $row[0]->foto_karyawan = base64_encode ($row[0]->foto_karyawan);
        $row[0]->foto_karyawan =  $row[0]->foto_karyawan;
        return $this->retJson(true, 'success', $row[0]  );    
    }  // End Login

    /**
     * Get Lokasi kerja default
     * Ambil semua lokasi jika  Absensilokasi.id_lokasi == '0'  
     */ 
    function get_semua_lokasi( $id_perusahaan, $id_karyawan){   
        /**
         * 
            select absensi_lokasi.nama_lokasi, karyawans.nama_karyawan, karyawans.id_waktu, absensi_waktu.shift  
                from absensi_lokasi
                join karyawans 
                join absensi_waktu
                where  karyawans.id_karyawan  = 1
                and absensi_waktu.id_waktu = karyawans.id_waktu 
         */
        $row = DB::table('absensi_lokasi' ) 
                    ->crossJoin('karyawans')
                    ->leftJoin('absensi_waktu', 'absensi_waktu.id_waktu', 'karyawans.id_waktu')
                    ->select("absensi_lokasi.id_perusahaan","absensi_lokasi.id_lokasi","absensi_lokasi.nama_lokasi",
                            "absensi_lokasi.lat","absensi_lokasi.lgt", "absensi_lokasi.max_jarak",
                            "karyawans.nama_karyawan", "absensi_waktu.shift","absensi_waktu.masuk","absensi_waktu.pulang",
                            )    
                    ->where('absensi_lokasi.id_perusahaan', $id_perusahaan) 
                    ->where('karyawans.id_karyawan',$id_karyawan)  
                     ->get();              
        return $row;
    } 
    function get_lokasikerja_def(Request $request){ 
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        } 
        $row = Karyawan::where('id_karyawan', $request->id_karyawan)     
                        ->leftJoin('absensi_lokasi', 'karyawans.id_lokasi', '=','absensi_lokasi.id_lokasi') 
                        ->leftJoin('absensi_waktu', 'karyawans.id_waktu', '=','absensi_waktu.id_waktu') 
                        ->select('karyawans.id_perusahaan','karyawans.id_lokasi', 'absensi_lokasi.nama_lokasi','absensi_lokasi.lat',  
                                'absensi_lokasi.lgt', 'absensi_lokasi.max_jarak', 
                                'absensi_waktu.shift', 'absensi_waktu.masuk','absensi_waktu.pulang',)->get();  
         
        if($row[0]->id_lokasi == ''){   // elseif($row[0]->id_lokasi == ''){  // OK jg
            $msg = 'Lokasi Belum ditemtukan';
            return $this->retJson(false,'Lokasi kerja belum ditentukan', null ); 
        }
        elseif( $row[0]->id_lokasi == '0'){ 
            $all_location = $this->get_semua_lokasi($row[0]->id_perusahaan, $request->id_karyawan); 
            return $this->retJson(true,'Semua Lokasi', $all_location ); 
        }  
        // Satu lokasi kerja saja
        return $this->retJson(true, 'Satu lokasi', $row ); 

    } // End get_lokasikerja_def()

    // Get Lokasi kerja penjadwalan
    function get_lokasikerja_penjadwalan(Request $request){
        $id_karyawan =  $request->id_karyawan;
    }

    /**
     * ABSESNSI
     */
    function absen(Request $request){ 
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        } 
        $validator = Validator::make($request->all(), [
            'in_or_out' => 'required', 
            'id_absensi' => 'nullable',
            'id_perusahaan' => 'required',  
            'id_karyawan' => 'required',
            'latlong' => 'required',
            'tgl' => 'required', 
            'foto' => 'required', 
        ]);    
        if ($validator->fails()) { // All Error    
            return $this->retJson(false,$validator->errors()->first(), [] );  
        } 

        if( $request->in_or_out == 'in'){ 
            return $this->checkin($request);
        } 
        
        return $this->checkout($request); 
    }

    function checkin($request){   
        try{      
            $insert = Absensi::insert([ 
                'id_perusahaan'=> $request->id_perusahaan, 
                'id_karyawan' => $request->id_karyawan,  
                'id_karyawan'  => $request->id_karyawan,  
                'valid_day' => $request->valid_day, 
                'valid_date' => $request->valid_date, 
                'shift'  => $request->shift,   
                'latlong_masuk'  => $request->latlong,   
                'lokasi_masuk'  => $request->nama_lokasi,  
                'jam_masuk'  => $request->tgl,   
                'foto_masuk' => $request->foto,   
                'created_at' => NOW() 
            ]); // OK 
            if($insert == true){ 
                return $this->retJson( true,   "Terkirim",  []); 
            }
        }
        catch (exception $e){  
            return $this->retJson( false,   "Gagal, Silahkan coba lagi",  $e); 
        } 
    } 

    function checkout($request){ 
        try{  
           $checkout =  Absensi::where('id_absensi', $request->id_absensi)
                     ->update([   
                        'latlong_pulang'  => $request->latlong,  
                        'lokasi_pulang'  => $request->nama_lokasi,  
                        'jam_pulang'  => $request->tgl,   
                        'foto_pulang' => $request->foto,
                     ]); 
            if($checkout == true){
                return $this->retJson( true, 'Sukses',    [] );
            }  
            return $this->retJson( false,   "Gagal, Silahkan coba lagi",  $e); 
        }
        catch(Exception $e){ 
            return $this->retJson( false,   "Gagal, Silahkan coba lagi",  $e); 
        } 
    }

    // CheckStatus absen    
    function get_status_absen(Request $request ){
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        }  
        $id_karyawan = $request->id_karyawan;
        $date = $request->date_now;
        // return $request->all();
        $row =  $this->by_date_now($id_karyawan, $date);
        return $this->retJson(true, 'Result', $row);  
    }  
    // Status absen pke methode check tanggal sekarang
    function by_date_now($id_karyawan, $date){ 
        $row = Absensi::where('id_karyawan', $id_karyawan)
                        // ->where('valid_date', "like", "{$date}%") 
                        ->where('valid_date', $date) 
                        ->select('id_absensi', 'valid_date', 'jam_masuk', 'jam_pulang',  )
                        ->get(); 
                        return $row;
    } 
    // Untuk Shift-3 btn Checkout 
    function last_checkin($id_karyawan=null){ 
        if(!$id_karyawan) { return $this->retJson(false, 'Tak ada karyawan terpilih', []);}
        try{ 
            $row = Absensi::where('id_karyawan', $id_karyawan) 
                    ->SELECT('id_absensi','valid_day','valid_date','jam_masuk','jam_pulang',) 
                    ->orderByDesc('id_absensi') 
                    ->limit(1)->get(); 
            return $this->retJson(true, 'success', $row); 
        }
        catch(Exception $e){
            return $this->retJson(false, 'Errs', $e); 
        }
    } 
    // Kehadiran
    function kehadiran(Request $request){
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        } 
        $id_karyawan = $request->id_karyawan;
        $month = $request->month;
        try{ 
            $row = Absensi::where('id_karyawan', $id_karyawan)
                ->where('valid_date', "like", "{$month}%") 
                ->select('id_absensi','valid_date', 'valid_day', 'jam_masuk',  'jam_pulang',
                        //  'foto_masuk',  'foto_pulang'
                        )
                ->orderBy('id_absensi', 'DESC') 
                ->get(); 
                $res =  $this->retJson(true, 'sukses', $row);  
                // var_dump($res);
                return $res; 
        }catch(Exception $e){ 
            return $this->retJson(false, 'error', $e); 
        } 
         

    } 
    function show_photo_img($id=null, $field=null, $tbl=null){  
            $row = Absensi::where('id_absensi', $id)->select($field)->get();  
            $image = base64_decode($row[0]->$field);
            header ('Content-type: image/png');
            echo $image;
    }

    //Cuti
    function jenis_Cuti($id_perusahaan){
        if(!$id_perusahaan) { return $this->retJson(false, 'Perusahaan tidajk terdaftar', []);}
        try{ 
            $row = DB::table('pengajuan_jenis_cuti')->where ('id_perusahaan', $id_perusahaan) 
                    ->select("id_jenis_cuti","id_perusahaan","jenis_cuti","satuan_cuti","maksimal_cuti")
                    ->get(); 
            return $this->retJson(true, 'success', $row); 
        }
        catch(Exception $e){
            return $this->retJson(false, 'Errs', $e); 
        } 
    }
    function pengajuan_cuti(Request $request){
        if( $this->getHeaders( $request ) == false ){
            return $this->retJson(false, 'Invalid request', null); 
        } 
        $data = ['id_perusahaan' => $request->id_perusahaan,
                 'id_karyawan' => $request->id_karyawan, 
                 'id_jenis_cuti' => $request->id_jenis_cuti,
                 'jenis_cuti' => $request->jenis_cuti,
                 'tgl_awal' => $request->tgl_awal,
                 'tgl_akhir' => $request->tgl_akhir,
                 'jumlah_hari' => $request->jumlah_hari,
                 'keterangan' => $request->keterangan,
                 'id_pengganti' => $request->id_pengganti,
                 'created_at' => date('Y-m-d H:i:s')
        ];
        try{
            $insert_cuti = DB::table('pengajuan_cuti')->insert($data); 
            return $this->retJson(true, 'Pengajuan Cuti Terkirim', []);  
        }catch(Exception $e){ 
            return $this->retJson(false, 'error', $e); 
        } 
    }
    
}#End
