<?php 
namespace App\Http\Controllers; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Department;
use App\Models\Absensiwaktu; 
use App\Models\Karyawan;  
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Database\Query\Builder; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator; 

class AbsensiwaktuController extends Controller
{

    
    function index(){ 
        $pt = $this->pt();  
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat jam kerja kerja sebelum membuat perusahaan');
        }
        $data = Absensiwaktu::where('id_perusahaan', $pt['id_perusahaan'])->get();   
        return view('absensi-waktu.jamkerja-index',[ 'pt' => $pt , 'data' => $data ] );
    } 

    function add(){ 
        $pt = $this->pt();   
        if($pt == false) {
            return redirect('buat-perusahaan')->with('status', 'Anda tidak dapat membuat jam kerja kerja sebelum membuat perusahaan');
        }
        return view('absensi-waktu.jamkerja-add',[ 'pt' => $pt, 'shift' => $this->shift() ]);
    }

    function act(Request $request){ 
        $validated = Validator::make($request->all(), [
            'shift' =>[
                        'required', 
                         Rule::unique('absensi_waktu')->where(fn (Builder $query) => $query->where('id_perusahaan',  $request->id_perusahaan ))
                    ], 
            'masuk' => 'required|date_format:H:i',
            'pulang' => 'required|date_format:H:i', 
        ]);
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false, 'Errors',  $validated->errors() ); 
        } 
        $insert = Absensiwaktu::insert([
            'id_perusahaan' => $request->id_perusahaan,   
            'shift' => $request->shift,   
            'masuk' => $request->masuk,  
            'pulang' => $request->pulang,  
            'created_by' => Auth::user()->id_pendaftar ,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if($insert == true){ 
            return $this->retJSON( true,  'Jam Kerja  berhasil ditambahkan', null); 
        }
    }

    function edit($id_perusahaan , $id_jamkerja){
        $pt = $this->pt(); 
        if($pt['id_perusahaan'] != $id_perusahaan ){
            return view('data-not-found');
        }
        $data = Absensiwaktu::where('id_waktu', $id_jamkerja)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','absensi_waktu.id_perusahaan') 
                    ->select('absensi_waktu.*','perusahaan.nama_perusahaan')
                    ->get();   
        // return view('absensi-waktu.jamkerja-edit',[ 'data' => $data[0],'pt' => $pt, 'shift' => $this->shift()  ]); 
        return view('absensi-waktu.jamkerja-edit',[  'data' => $data[0],'pt' => $pt, 'shift' => $this->shift() ]);
    }

    function edit_act(Request $request){
        $validated = Validator::make($request->all(), [
            'shift' =>'required|unique:absensi_waktu,shift,'.$request->id_waktu.',id_waktu', 
            'masuk' => 'required|date_format:H:i:s',
            'pulang' => 'required|date_format:H:i:s', 
        ]); 
        if ($validated->fails()) { // All Error 
            return $this->retJSON( false,  'Errors',  $validated->errors()  );
        } 
        $data = Absensiwaktu::where('id_waktu', $request->id_waktu)
                ->update([    
                    'shift' => $request->shift,   
                    'masuk' => $request->masuk,  
                    'pulang' => $request->pulang,  
                    'updated_by' => Auth::user()->id_pendaftar ,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        if($data == true){ 
            return $this->retJSON(  true,  'Jam kerja berhasil diperbaharui', );
        } 
    }

    function del($id){
        $dept = Absensiwaktu::where('id_waktu', $id)
                    ->join('perusahaan', 'perusahaan.id_perusahaan','absensi_waktu.id_perusahaan') 
                    ->select('absensi_waktu.*','perusahaan.nama_perusahaan')
                    ->get();  
        $karyawan = Karyawan::where('id_waktu', $id)->count();
        return view('absensi-waktu.jamkerja-del',[ 'data' => $dept[0] , 'karyawan' => $karyawan]);  
    }
    function del_act(Request $request){
        $del = Absensiwaktu::find($request->id_waktu); 
        $res = $del->delete();        
        if($res !=  true ){
            return $this->retJSON( false, 'Error koneksi ',  []); 
        }    
        return $this->retJSON( true,  'Jam Kerja berhasil dihapus',  [] );
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
    
    function shift(){   return [ '1', '2','3' ]; }
    
    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}
