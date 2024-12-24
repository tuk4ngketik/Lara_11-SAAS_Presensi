<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Daftar;
use Illuminate\Database\Query\Builder; 
use Exception;

class DaftarController extends Controller
{
    
    function logout(){
        Auth::logout(); 
        return redirect('login');
    }
    function login_act(Request $request){
        // $validator = $request->validate([ 
        $validator = Validator::make($request->all(), [
            'email' =>'required',  
            'password' => 'required' 
        ]); 
        if ($validator->fails()) { // All Error  
            return $this->retJSON(false, 'Errors', $validator->errors());
        } 
  
        
        $sql = Daftar::where('terverifikasi','Y')
                        ->where('email', $request->email); 

        if( $sql->count() < 1 ){ 
            return $this->retJSON(false, 'Errors',   ["email" => ["{$request->email}  belum terdaftar"] ] );
        }

        // CEk password
        $row = $sql->get(); 
        $cek_password  = Hash::check(  $request->password, $row[0]->password);
        
        if($cek_password !=  true ){ 
            return $this->retJSON(false, 'Errors',  ["password" => ["Kata sandi tidak sesuai"] ]  );  
        }         
        
        // if (Auth::attempt([   'email' => $request->email, 'password' => $request->password ] )) {  // OK  
        // if (Auth::attempt( $validator )) {
        if (Auth::attempt( $validator->validated() )) {
            $login = Auth::user();  
            return $this->retJSON(true, 'Login berhasil',  null );
        }
        
        return view('login');
    }

    function replace_register($request, $password, $hash_verifikasi, $expired, $now){ 
        $pendaftar =  Daftar::where('email', $request->email)
                                ->select('id_pendaftar')->get();

        $replace = Daftar::where('email', $request->email)
                         ->update(['nama' => $request->nama_lengkap,
                                   'password' => $password, 
                                   'hash_verifikasi' => $hash_verifikasi,
                                   'maks_verifikasi' => $expired,
                                   'created_at' => $now
                            ]); 
        $id_pendaftar =  $pendaftar[0]->id_pendaftar;
        // next : function Send Mail  
        return $replace;
    }
    
    function daftar_act(Request $request){    

        // $validated = $request->validate([  
        $validated = Validator::make($request->all(), [
            'nama_lengkap' => 'required|min:3|max:50|regex:/^[a-zA-z\ ]+$/i', 
            'email' => ['required',  'email:filter_unicode',
                        Rule::unique('perusahaan_pendaftar')->ignore('N', 'terverifikasi' )
                        ],
            'password' => 'required|max:15|min:6',
            'password_confirm' => 'required|same:password'
        ]); 
        if ($validated->fails()) { // All Error  
            return $this->retJSON(false, 'Errors',   $validated->errors()  );
        } 
        $password = Hash::make($request->password);
        $hash_verifikasi = md5($request->email.$request->password);
        $now    = date("Y-m-d H:i:s");
        $expired = date('Y-m-d H:i:s', strtotime("+24 hour"));
  
        // EMAIL SUDAH PERNAH DAFTAR
        $sudah_daftar = Daftar::where('terverifikasi','N')
                         ->where('email', $request->email) 
                         ->count();
        if($sudah_daftar > 0){
           $replace =  $this->replace_register($request, $password, $hash_verifikasi, $expired, $now);
           if($replace == true ){ 
            //  return redirect('daftar-sukses')->with('status', 'New register ...!');
             return response()->json([
                 'status' => true, 
                 'msg' => 'Cek email anda', 
                 'redirect' => url("daftar-sukses/{$hash_verifikasi}"), 
                 'data' => []
             ]); 
           }
        }

        // EMAIL BELUM PERNAH DAFTAR
        $daftar = new Daftar; 
        $daftar->nama = $request->nama_lengkap; 
        $daftar->email = $request->email; 
        $daftar->password = $password; 
        // $daftar->telp = $request->telp; 
        // $daftar->aipi = $aipi;  
        $daftar->hash_verifikasi = $hash_verifikasi; 
        $daftar->maks_verifikasi = $expired;  
        $daftar->created_at =  $now ; 
        $daftar->save();
        
        // digabung dngn  $hash_verifikasi
        // contoh link /verifikasi-pendaftaran/${insert_id}${hash_verifikasi}
        $insert_id = $daftar->id_pendaftar;
        
        // next : function Send Mail 

        // return redirect('daftar-sukses')->with('status', 'New regegister ...!');
        return response()->json([
            'status' => true, 
            'msg' => 'Cek email anda', 
            'redirect' => url("daftar-sukses/{$hash_verifikasi}"), 
            'data' => []
        ]);
    }

    function daftar_sukses($hash=null){ 
        if($hash == null) { return redirect('/'); }
        $daftar = Daftar ::where('hash_verifikasi', $hash)
                        ->where('terverifikasi','N') 
                        ->where('maks_verifikasi', '>=',  date('Y-m-d H:i:s') )
                        ->count();  
        if ( $daftar < 1){ 
            return redirect('/'); 
        }
        return view('daftar/daftar-sukses'); 
    } 
        
    function verifikasi_pendaftaran($hasing){ 
        $id = $hasing[0];
        $hash_verifikasi = substr($hasing, 1);
        $now = date('Y-m-d H:i:s'); 
        
        // CEk apakah link valid / atau expired OK
        $daftar = Daftar ::where('hash_verifikasi', $hash_verifikasi)
                        ->where('terverifikasi','N')
                        ->where('id_pendaftar', $id)
                        ->where('maks_verifikasi', '>=', $now )
                        ->count();                     
        if($daftar < 1 ){ 
            return redirect('daftar')->with('status', 'Waktu verifaikasi habis, silahkan daftar kembali');
        }
        
        // Updata status terverifikasi OK
        $terverifikasi = Daftar::where('id_pendaftar', $id)
                         ->update(['terverifikasi' => 'Y']);                          
        if($terverifikasi == false){ 
            return view('daftar');
        } 
        return redirect('login')->with('status', 'Akun anda sudah terverifikasi');
    }

    // Form request lupa password
    function lupapasswd(){ return view('daftar.lupa-passwd');}    
    function lupapasswd_act(Request $request){
        $validated = Validator::make($request->all(), [
           'email' => [ 'required','email:filter_unicode'  ],  
        ]); 
        if ($validated->fails()) {  
            return $this->retJSON(false, 'Errors',   $validated->errors()  );
        } 
        $email = $request->email;
        $cek = Daftar::where('terverifikasi','Y')
                    ->where('email', $email);
        if($cek->count() < 1){  
            return $this->retJSON(false, 'Errors',   ["email" => ["Email tidak terdaftar"] ] );
        }
        $res = $cek->get(); 
        $now    = date("Y-m-d H:i:s"); 
        $expired = date('Y-m-d H:i:s', strtotime("+1 hour")); 
        $nama = $res[0]->nama;
        $link = md5("{$nama}::{$email}::{$res[0]->created_at}::{$now}"); 

        // Insert to reset db
        $data = ['email' => $email,
                 'tabel' => 'perusahaan_pendaftar',
                 'link' => $link,
                 'kadaluarsa' => $expired,
                 'created_at' => $now   
        ];
        $insert = DB::table('password_reset')->insert($data);
        
        /**
         * Script kirim email here, 
         * - link-byemail   {{url(passreset-verifikasi?link=$link)}} 
         */ 
        $this->mail_notif_resetpassword($nama, $email, $link);

        if($insert == true){ 
            return response()->json([
                'status' => true, 
                'msg' => 'Cek email anda',  
                'redirect' => url("lupapasswd-sent/{$link}"),
                'data' =>  [] 
            ]);
        }
    } 
    function lupapasswd_sent($link=null){ 
        $res = DB::table('password_reset')
                    ->where('link', '=', $link)
                    ->where('kadaluarsa', '>=', date("Y-m-d H:i:s"))
                    ->where('create_new', '=', null )
                    ->select('email');
        if($res->count() < 1){
            return view('daftar.lupa-passwd-reject');
        }
        return view('daftar.lupa-passwd-sukses');
    }
    /**
     * Form passwd baru dari proses lupa password, dan attachment dri email
     */
    function passreset_verifikasi($link=null){ 
        $now = date("Y-m-d H:i:s"); 
        $res = DB::table('password_reset')
                    ->where('link', '=', $link)
                    ->where('kadaluarsa', '>=', $now )
                    ->where('create_new', '=', null )
                    ->select('email');
        if($res->count() < 1){
            return view('daftar.lupa-passwd-reject');
        }
        $res = $res->get(); 
        return view( 'daftar.lupa-passwd-verifikasi', ['data' => $res[0]] );
    }

    /**
     * Action from function passreset_verifikasi($link=null)
     */
    function resetpassword_act(Request $request){

        $validated = Validator::make($request->all(), [ 
            'password' => 'required|max:15|min:6',
            'konfirmasi' => 'required|same:password'
        ]);  
        if ($validated->fails()) {  
            return $this->retJSON( false,   "Errs",  $validated->errors()  ); 
        }  
                         
        // Transaction
        try{
            // Start Transaction
            DB::transaction(function () use ( $request) {   
                Daftar::where('email', $request->email)
                        ->where('terverifikasi', 'Y')
                        ->update([ 'password' => Hash::make($request->password) ]);  
    
                DB::table('password_reset')->where('email', $request->email)
                    ->update(['create_new' =>  date("Y-m-d H:i:s") ]);
            }); 
            // end transaction   
            return $this->retJSON( true, "Reset Password berhasil",   [] ); 
        } 
        // Error transaction  
        catch(Exception $e){  
            return $this->retJSON( true, "Err",  ["konfirmasi" => ["Periksa koneksi, dan ulangi lagi"] ]);
        } 

    }

    function mail_notif_resetpassword($nama, $email, $link){ 
        $url = "passreset-verifikasi?link=$link";
        $subject = 'Permintaan Reset Password';
        $text = "<p>Halo $nama</p>";
        $text .= "<p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda tidak meminta reset password, 
                 Anda dapat mengabaikan email ini.</p>"; 
        $text .= "<p>Untuk melanjutkan proses reset password, silakan klik tautan di bawah ini:</p>";   
        $text .= "<p>{$url}</p>";
        $text .="<p> Tautan ini akan kedaluwarsa dalam 1 jam. Pastikan untuk membuat password baru yang kuat dan aman.</p>"; 
        $text .="<p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>";
        $text .="<br /><br /><br />Terima kasih,
                 <br /><p><b>Gaspire Teknologi</b></p><p>http://www.attendface.com</p>";
        // mail($email, $subject, $text);
    }

    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }
}#End
