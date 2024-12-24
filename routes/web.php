<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { 
    if(Auth::user()){  return redirect()->route('beranda'); }
    return view('daftar/login');
});

use App\Http\Controllers\DaftarController;  // Daftar
use App\Http\Controllers\Checkvalid;        // Check Validation
//Register, Login, Forgot Password
Route::get('/logout', [DaftarController::class, 'logout']);
Route::get('/login', function () {  
    if(Auth::user()){  return redirect()->route('beranda'); } 
    return view('daftar/login'); 
})->name('login');  //OK
Route::get('/daftar', function () {   
    if(Auth::user()){ return redirect()->route('beranda'); }
    return view('daftar/daftar'); 
}); //OK
Route::post('/login_act', [DaftarController::class, 'login_act']);
Route::post('/daftar_act', [DaftarController::class, 'daftar_act']);   
Route::get('/daftar-sukses/{hash?}', [DaftarController::class, 'daftar_sukses']); //OK


// diakses dari link tautan email setelah berhasil daftar
Route::get('/verifikasi-pendaftaran/{kode_hash}', [DaftarController::class, 'verifikasi_pendaftaran']);

// lupa password 
Route::get('/lupapasswd', [DaftarController::class, 'lupapasswd']);
Route::post('/lupapasswd-act', [DaftarController::class, 'lupapasswd_act']);
Route::get('/lupapasswd-sent/{link?}', [DaftarController::class, 'lupapasswd_sent']);
// Form reset passwd
Route::get('/passreset-verifikasi/{link?}',  [DaftarController::class, 'passreset_verifikasi'] );  
Route::post('/resetpassword-act', [DaftarController::class, 'resetpassword_act']);

// Form setelah reset kata sandi, form untuk konfirmasi kode
Route::get('/konfirmasi-kata-sandi-baru', function () {   return view('daftar/konfirmasi_kata_sandi_baru'); });
Route::post('/verifikasi_act', [DaftarController::class, 'verifikasi_act']);

Route::get('/spv-login', function () {   return view('spv/login'); }); 

// SPV Beranda / Home
Route::get('/spv-beranda', function () {   return view('supervisor'); });

use App\Http\Controllers\BerandaController;         // Perusahaan / PT
use App\Http\Controllers\PerusahaanController;      // Perusahaan / PT
use App\Http\Controllers\DepartmentController;      // Departement
use App\Http\Controllers\JabatanController;         // Jabatan
use App\Http\Controllers\KaryawanController;        // Karyawan n Keluarga Karyawan 
use App\Http\Controllers\KaryawanConfig;            //  Ajx  
use App\Http\Controllers\AbsensilokasiController;   // Lokasi kerja
use App\Http\Controllers\AbsensiwaktuController;    // Jam  kerja / Absensi waktu
use App\Http\Controllers\PresensiController;        // Presensi / Kehadiran
use App\Http\Controllers\FaceapiController;
use App\Http\Controllers\ApiService;
 
 
 
Route::middleware(['auth'])->group(function () {
 
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');   

    // ADD PT         
        Route::get('/buat-perusahaan', [PerusahaanController::class, 'perusahaan_add']); // OK
        Route::post('/perusahaan-act', [PerusahaanController::class, 'perusahaan_act']); // OK
        Route::get('/edit-perusahaan',  [PerusahaanController::class, 'perusahaan_edit']); // OK  
        Route::post('/perusahaan-edit-act', [PerusahaanController::class, 'perusahaan_edit_act']); 
    //
    
    // ADD DEPARTEMENT
        Route::get('/department', [DepartmentController::class, 'index']); // ok?
        Route::get('/buat-department', [DepartmentController::class, 'department_add']); //ok
        Route::post('/department-act', [DepartmentController::class, 'act']); // ok
        Route::get('/edit-department/{id_depertemen}', [DepartmentController::class, 'edit']); // ok  
        Route::get('/department-del/{id_depertemen}', [DepartmentController::class, 'del']); //    
        Route::post('/department-edit-act', [DepartmentController::class, 'edit_act']); // ok? masalah query dngn perusahaan yg sama
        Route::get('/department-del/{id_depertemen}', [DepartmentController::class, 'del']); //    
        Route::post('/department-del-act', [DepartmentController::class, 'del_act']); // ok? masalah query dngn perusahaan yg sama
        Route::get('/divisi', [DepartmentController::class, 'divisi']); // ok?
        Route::get('/buat-divisi/{id_departemen}', [DepartmentController::class, 'divisi_add']); //ok
        Route::post('/divisi-act', [DepartmentController::class, 'divisi_act']); // ok? masalah query dngn perusahaan yg sama
        Route::get('/edit-divisi/{id_divisi}', [DepartmentController::class, 'divisi_edit']); //ok
        Route::post('/divisi-edit-act', [DepartmentController::class, 'divisi_edit_act']); // ok? masalah query dngn perusahaan yg sama
        Route::get('/divisi-del/{id_divisi}', [DepartmentController::class, 'divisi_del']); // 
        Route::post('/divisi-del-act', [DepartmentController::class, 'divisi_del_act']); // ok? masalah query dngn perusahaan yg sama
       
    //
    
    // ADD JABATAN
        Route::get('/jabatan', [JabatanController::class, 'index']); // ok
        Route::get('/buat-jabatan',  [JabatanController::class, 'add']);  //ok
        Route::post('/jabatan-act', [JabatanController::class, 'act']); //ok
        Route::get('/edit-jabatan/{id_jabatan}', [JabatanController::class, 'edit']); //ok  
        Route::post('/jabatan-edit-act', [JabatanController::class, 'edit_act']); //ok
        Route::get('/jabatan-del/{id_jabatan}', [JabatanController::class, 'jabatan_del']); //ok  
        Route::post('/jabatan-del-act', [JabatanController::class, 'edit_del_act']); //ok
    //

    // KARYAWAN
        Route::get('/karyawan/{status?}', [KaryawanController::class, 'index'] ); // ok
        Route::get('/karyawan-detail/{id_karyawan}',  [KaryawanController::class, 'karyawan_detail'] ); // ok
        Route::get('/tambah-karyawan',  [KaryawanController::class, 'karyawan_add']);   // ok
        Route::post('/karyawan-act', [KaryawanController::class, 'karyawan_act']);      // ok
        // Route::get('/edit-karyawan/{id_perusahaan}/{id_karyawan}', [KaryawanController::class, 'karyawan_edit']);  // ok
        Route::get('/edit-karyawan/{id_karyawan}', [KaryawanController::class, 'karyawan_edit']);  // ok
        Route::post('/karyawan-edit-act', [KaryawanController::class, 'karyawan_edit_act']); // ok
        //Ajx
        Route::get('/karyawan-set-lokasi/{id_perusahaan}/{id_karyawan}',  [KaryawanConfig::class, 'set_lokasi_kerja']); //  !
        Route::post('/karyawan-set-lokasi-act',  [KaryawanConfig::class, 'set_lokasi_kerja_act']); // ok 
        Route::get('/karyawan-set-non-aktif/{id_perusahaan}/{id_karyawan}',  [KaryawanConfig::class, 'set_nonaktif']); //  ok
        Route::post('/karyawan-set-nonaktif-act',  [KaryawanConfig::class, 'set_nonaktif_act']); // ok  
         
        Route::get('/karyawan-jadwal',  [KaryawanConfig::class, 'jadwal']); //  
        Route::get('/karyawan-set-jadwal/{id_perusahaan}/{id_karyawan}',  [KaryawanConfig::class, 'set_jadwal']); //  OK
        Route::post('/karyawan-set-jadwal-act',  [KaryawanConfig::class, 'set_jadwal_act']); //  ok
        Route::get('/karyawan-edit-jadwal/{id_perusahaan}/{id_jadwal}',  [KaryawanConfig::class, 'edit_jadwal']); //  ok 
        Route::post('/karyawan-edit-jadwal-act',  [KaryawanConfig::class, 'edit_jadwal_act']); //  ok
        Route::get('/karyawan-del-jadwal/{id_jadwal}',  [KaryawanConfig::class, 'del_jadwal']);  
        Route::post('/karyawan-del-jadwal-act',  [KaryawanConfig::class, 'del_jadwal_act']); //  ok
        
        Route::get('/karyawan-get-divisi/{id_perusahaan}/{id_department}',  [KaryawanController::class, 'get_divisi']); //  ok 
       
    //

    // FACE API
        Route::get('/face-detect', [FaceapiController::class, 'face_detect']);  
        Route::post('/face-detect-act', [FaceapiController::class, 'face_detect_act']);  
        Route::get('/face-extract', [FaceapiController::class, 'face_extract']);  
        Route::post('/face-extract-act', [FaceapiController::class, 'face_extract_act']);  
    //

    // ADD KARYAWAN KELUARGA
        Route::get('/buat-keluarga-karyawan', function () {   return view('karyawan/add-keluarga-karyawan'); });  
        Route::post('/keluarga-karyawan-act', [KaryawanController::class, 'karyawan/keluarga_karyawan_act']);
        Route::get('/edit-keluarga-karyawan/{id_karyawan}', function () {   return view('karyawan/edit-keluarga-karyawan'); });  
        Route::post('/keluarga-karyawan-edit-act', [KaryawanController::class, 'keluarga_karyawan_edit_act']);
    //

    // ABSENSI LOKASI : MENETAPKAN LOKASI KERJA, HINGGA JARAK MAKS SAAT ABSEN
        Route::get('/lokasi-kerja', [AbsensilokasiController::class, 'index']); // ok
        Route::get('/tambah-lokasi-kerja',  [AbsensilokasiController::class, 'add']);  //ok
        Route::post('/lokasi-act', [AbsensilokasiController::class, 'act']); //ok
        Route::get('/edit-lokasi-kerja/{id_perusahaan}/{id_lokasi}', [AbsensilokasiController::class, 'edit']); //ok  
        Route::post('/lokasi-edit-act', [AbsensilokasiController::class, 'edit_act']); //ok
        Route::get('/lokasi-del/{id_lokasi}', [AbsensilokasiController::class, 'del']); //
        Route::post('/lokasi-del-act', [AbsensilokasiController::class, 'del_act']); //ok
        Route::get('/cari-lokasi/{nama_lokasi}', [AbsensilokasiController::class, 'reverse_geomora']); //ok
    //

    /**
     * ABSENSI
     */
    // ABSENSI WAKTU : MENETAPKAN WAKTU KERJA SHIFT 1, 2 ATAU 3
        Route::get('/jamkerja', [AbsensiwaktuController::class, 'index']); // ok
        Route::get('/buat-jamkerja',  [AbsensiwaktuController::class, 'add']);  //ok
        Route::post('/jamkerja-act', [AbsensiwaktuController::class, 'act']); //ok
        Route::get('/edit-jamkerja/{id_perusahaan}/{id_waktu}', [AbsensiwaktuController::class, 'edit']); //ok  
        Route::post('/jamkerja-edit-act', [AbsensiwaktuController::class, 'edit_act']); //ok
        Route::get('/jamkerja-del/{id_waktu}', [AbsensiwaktuController::class, 'del']); //
        Route::post('/jamkerja-del-act', [AbsensiwaktuController::class, 'del_act']); //ok
    //
    

    // ABSENSI SKEDUL : MENETAPKAN SKEDUL / JADWAL KARYAWAN
    //

    // ABSENSI REKAP : REKAPITULASI KEHADIRAN - CUTI - IZIN - SAKIT
    //

    //Khadiran
        Route::get('/master-cuti', [PresensiController::class, 'master_cuti']); //  
        Route::post('/master-cuti-create', [PresensiController::class, 'master_cuti_create']); //  
        Route::get('/jenis-cuti', [PresensiController::class, 'jenis_cuti']); //  
        Route::get('/tambah-jenis-cuti', [PresensiController::class, 'jenis_cuti_add']); //  
        Route::post('/tambah-jenis-cuti-act', [PresensiController::class, 'jenis_cuti_act']); //  
        Route::post('/tambah-jenis-cuti-act', [PresensiController::class, 'jenis_cuti_act']); //  
        Route::get('/jenis-cuti-edit/{id}', [PresensiController::class, 'jenis_cuti_edit']); //  
        Route::post('/jenis-cuti-edit-act', [PresensiController::class, 'jenis_cuti_edit_act']); //  
        Route::get('/presensi', [PresensiController::class, 'index']); //  kehadiran
        Route::post('/presensi-act', [PresensiController::class, 'presensi_act']); //   
        Route::get('/cuti', [PresensiController::class, 'cuti']); //   
        Route::get('/sakit', [PresensiController::class, 'sakit']); //  
        //Approve Cuti, sakit, izin, klaim
        Route::post('/approve-cuti', [PresensiController::class, 'approve_cuti']); // 
        Route::post('/approve-lembur', [PresensiController::class, 'approve_lembur']); //
        Route::post('/approve-sakit', [PresensiController::class, 'approve_sakit']); // 
        Route::post('/approve-klaim', [PresensiController::class, 'approve_klaim']); //  

    //

    /**
     * KEHADIRAN DI LAKUKAN OLEH KARYAWAN PADA MOBILE :
     * - ABSENSI
     * - CUTI
     * - IZIN
     * - Klaim
     */


});

