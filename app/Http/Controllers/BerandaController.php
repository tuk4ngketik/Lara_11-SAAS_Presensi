<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Perusahaan;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;  
use Illuminate\Validation\Rules\File;

class BerandaController extends Controller
{ 
    function index(Request $request){ 
        $pt = Perusahaan::where('id_pendaftar', Auth::user()->id_pendaftar);
        if( $pt->count() < 1 ){   return  view('perusahaan.perusahaan-empty'); }  

        $pt = $pt->get();  
        $data = [
                 'pt' => $pt[0], 
                 'karyawans' => $this->karyawans(),
                 'kehadiran' => $this->kehadiran(),
                ];      
    //    return  view('beranda', $data); // Err blm diteliti
       return  view('beranda.beranda', $data); 
    } 

    function karyawans(){
        return null;
    }

    function kehadiran(){
        return null;
    }
}
