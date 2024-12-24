<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan; 
use App\Models\Karyawan; 
use App\Models\Absensi;  
  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
 

class PresensiController extends Controller
{
    
    function index(){ 
        $pt = $this->pt();   
        $date = date('Y-m-d');  
        $row =  $this->kehadiran( $pt['id_perusahaan'], $date); 
        return view('presensi.kehadiran',['pt' => $pt, 'currDate' => $date, 'row'=>$row ] );
    } 
    function presensi_act(Request $request){
        $validated = $request->validate([
            'kategori' => 'required',
            'tgl' => 'required',
        ]); 
        $pt = $this->pt();  
        $id_perusahaan = $pt['id_perusahaan'];
        $presensi =  $request->kategori;
        if($presensi == 'kehadiran'){
            $row =  $this->kehadiran($id_perusahaan, $request->tgl);
            return view('presensi.kehadiran',['pt' => $pt, 'currDate' => $request->tgl, 'row'=>$row] );
        } 
        if($presensi == 'cuti'){
            $row =  $this->cuti($id_perusahaan, $request->tgl);
            return view('presensi.cuti',['pt' => $pt, 'currDate' => $request->tgl, 'row'=>$row] );
        }  
    }

    function sakit(){ 
        $pt = $this->pt();    
        $month = date('Y-m');  
        $row = DB::table('pengajuan_sakit')->where('pengajuan_sakit.id_perusahaan', $pt['id_perusahaan'])            
                        ->where('pengajuan_sakit.tgl_awal', 'like',  "{$month}%")
                        ->where('pengajuan_sakit.tgl_akhir', 'like',  "{$month}%")   
                        ->join('karyawans', 'karyawans.id_karyawan', '=','pengajuan_sakit.id_karyawan') 
                        ->select('karyawans.nama_karyawan','pengajuan_sakit.id_sakit', 
                                 'pengajuan_sakit.tgl_awal','pengajuan_sakit.tgl_akhir','pengajuan_sakit.status',
                                 'pengajuan_sakit.jumlah_hari', 'pengajuan_sakit.keterangan', 
                                 'pengajuan_sakit.created_at', 'pengajuan_sakit.updated_at')
                    ->get();
        // return $row;   
        return view('presensi.sakit',['pt' => $pt,  'row'=>$row] );
    } 

    function Izin(){ 
    }

    function cuti(){ 
        $pt = $this->pt();    
        $month = date('Y-m');  
        $row = DB::table('pengajuan_cuti')->where('pengajuan_cuti.id_perusahaan', $pt['id_perusahaan'])            
                        ->where('pengajuan_cuti.tgl_awal', 'like',  "{$month}%")
                        ->where('pengajuan_cuti.tgl_akhir', 'like',  "{$month}%")   
                        ->join('karyawans', 'karyawans.id_karyawan', '=','pengajuan_cuti.id_karyawan') 
                        ->select('karyawans.nama_karyawan','pengajuan_cuti.id_cuti', 'pengajuan_cuti.jenis_cuti', 
                                 'pengajuan_cuti.tgl_awal','pengajuan_cuti.tgl_akhir','pengajuan_cuti.status',
                                 'pengajuan_cuti.jumlah_hari', 'pengajuan_cuti.keterangan', 
                                 'pengajuan_cuti.created_at', 'pengajuan_cuti.updated_at')
                    ->get();
        // return $row;   
        return view('presensi.cuti',['pt' => $pt,  'row'=>$row] );
    } 

    function kehadiran($id_perusahaan, $tgl){
        $row = Absensi::where('absensi.id_perusahaan', $id_perusahaan)
                        ->where('absensi.valid_date', $tgl)  
                        ->join('karyawans', 'karyawans.id_karyawan', '=','absensi.id_karyawan')
                        ->select('karyawans.nama_karyawan','absensi.valid_day','absensi.valid_date',
                                 'absensi.lokasi_masuk','absensi.jam_masuk','absensi.lokasi_pulang', 'absensi.jam_pulang', 
                                 'absensi.foto_masuk','absensi.foto_pulang' ,'absensi.created_at', 'absensi.updated_at')
                    ->get();
        return $row; 
    }

    // Pengaturan Cuti
    function jenis_cuti(){
        $pt = $this->pt();   
        $row = DB::table('pengajuan_jenis_cuti')->get();   
        return view('presensi.jenis-cuti',['pt' => $pt,  'row'=>$row] );
    }
    function jenis_cuti_add(){
        $pt = $this->pt();   
        return view('presensi.jenis-cuti-add',['pt' => $pt]);
    }
    function jenis_cuti_act(Request $request){
        $validator = Validator::make($request->all(), [
            'id_perusahaan' => 'required', 
            'jenis_cuti' => ['required',
                        Rule::unique('pengajuan_jenis_cuti')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan )) 
                    ],
            'satuan_cuti' => 'required',
            'maksimal_cuti' => 'required|numeric',   
        ]);       
        if ($validator->fails()) { // All Error     
            return $this->retJson( false, 'Errors', $validator->errors()  );
        }  
        try{ 
            $data = [
                'id_perusahaan' => $request->id_perusahaan,
                'jenis_cuti' => $request->jenis_cuti,
                'satuan_cuti' => $request->satuan_cuti,
                'maksimal_cuti' => $request->maksimal_cuti,  
            ];
            $insert = DB::table('pengajuan_jenis_cuti')->insertGetId( $data );
            $data['id_jenis_cuti'] = $insert ;
            return $this->retJson( true, 'Tambah Jenis Cuti berhasil', $data );
        } 
        catch (exception $e){  
            return $this->retJson( false, 'Errors', $e);
        } 
    }
    function jenis_cuti_edit($id){ 
        $pt = $this->pt(); 
        $row = DB::table('pengajuan_jenis_cuti')
                    ->where( 'id_perusahaan', $pt['id_perusahaan'] )
                    ->where( 'id_jenis_cuti', $id )
                    ->get();  
        return view('presensi.jenis-cuti-edit', ['row' => $row[0] ]); 
    }
    function jenis_cuti_edit_act(Request $request){
        $validator = Validator::make($request->all(), [ 
            'jenis_cuti' => ['required',
                        Rule::unique('pengajuan_jenis_cuti')
                        ->where(fn (Builder $query) => $query->where('id_jenis_cuti', '!=', $request->id )) 
                        ->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan )) 
                    ],
            'satuan_cuti' => 'required',
            'maksimal_cuti' => 'required|numeric',   
        ]);       
        if ($validator->fails()) { // All Error     
            return $this->retJson( false, 'Errors', $validator->errors()  );
        }  
        try{ 
            $data = [ 
                'jenis_cuti' => $request->jenis_cuti,
                'satuan_cuti' => $request->satuan_cuti,
                'maksimal_cuti' => $request->maksimal_cuti,  
            ];
            DB::table('pengajuan_jenis_cuti')->where('id_jenis_cuti', $request->id)
                        ->update( $data ); 
            $data['id_jenis_cuti'] =  $request->id;
            return $this->retJson( true, 'Update Jenis Cuti berhasil', $data );
        } 
        catch (exception $e){  
            return $this->retJson( false, 'Errors', $e);
        } 

    }
    
    // Master Cuti
    function master_cuti(){ 
        return view('presensi.master-cuti', ['pt' =>  $this->pt() ]);
    } 
    function master_cuti_create(Request $request){  
        $tahun = $request->tahun;
        $id_perusahaan = $request->id_perusahaan;   
        $master_cuti = DB::table('pengajuan_master_cuti')->where('id_perusahaan', $id_perusahaan) 
                                ->where('tahun', $tahun) ;
        if($master_cuti->count() > 0){
            return $this->retJSON(false, 'Master Cuti sudah dibuat', []); 
        }
        $data_karyawan = Karyawan::select('id_karyawan')->get();
        $i = 0;
        foreach($data_karyawan as $k => $v):
            $i++;
            DB::table('pengajuan_master_cuti')->insert([
                        'id_perusahaan'=>  $id_perusahaan, 
                        'id_karyawan'=>  $v->id_karyawan, 
                        'tahun' => $tahun
            ]) ;
        endforeach;
        return $this->retJSON(true, "Master Cuti berhasil dibuat\ $i Karyawan", $data_karyawan );
         
        return $this->retJSON(false, 'TEst', $data_karyawan);
        $master_cuti = DB::table('pengajuan_master_cuti') ;
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
}//End
