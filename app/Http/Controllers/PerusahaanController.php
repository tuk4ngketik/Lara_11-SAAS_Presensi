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
use Exception;
use App\Exceptions\InvalidOrderException;


class PerusahaanController extends Controller
{
    function perusahaan_edit(){
        $pt = Perusahaan::where('id_pendaftar', Auth::user()->id_pendaftar)->get();  
        return view('perusahaan.perusahaan-edit',['pt' =>  $pt[0] ]);
    }
    function perusahaan_add(){  
        $pt = Perusahaan::where('id_pendaftar', Auth::user()->id_pendaftar)->count(); 
        if ($pt < 1)   {  return view('perusahaan.perusahaan-add');}
        return redirect('edit-perusahaan');
    }  

    function perusahaan_act(Request $request){  
         
        $validated = Validator::make($request->all(), [  
            'logo' => [
                'required',
                File::image()
                    // ->min('50kb')
                    ->max('1mb')  
            ], 
            'nama_perusahaan' =>'required|min:5|max:50',  
            'alamat_perusahaan' =>   ['required', 'max:200'],   
            'email_perusahaan' =>'required|max:50|email:filter_unicode|unique:perusahaan,email_perusahaan',// live 
            'telp_perusahaan' => 'nullable|numeric|digits_between:10,15|unique:perusahaan,telp_perusahaan',   
            'industri' => 'required|min:4|max:50', 
            'deskripsi_perusahaan' => 'max:200', 
            'website' => 'nullable|url:http,https',
        ]);
         
        if ($validated->fails()) { // All Error  
            return   $this->retJSON(false, 'Errors',  $validated->errors()  );
        }  

        $logo = $request->file('logo');  
        $blob = file_get_contents($logo);  // manggilnya di encode:  base64_encode($blob)  
        $image = base64_encode($blob); 
        // return $image;
        try{ 
            $id_perusahaan = Perusahaan::insertGetId([
                'id_pendaftar' => Auth::user()->id_pendaftar,  
                'nama_perusahaan' => $request->nama_perusahaan,  
                'logo_perusahaan' => $image,  
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email_perusahaan' => $request->email_perusahaan,
                'telp_perusahaan' => $request->telp_perusahaan,
                'industri' => $request->industri,
                'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
                'website' => $request->website,
            ]);  

            // Create Folder @ SErvcie
            try{

                $ApiService = new ApiService();
                $res_api =  $ApiService->create_perusahaan('create_perusahaan', $id_perusahaan);   
                return $res_api; 
            }
            catch(Exception $e){    
                return   $this->retJSON(false, $e,  ["logo" => ["Format file tidak mendukung"] ] );
            }
        }
        catch(Exception $e){  
            return   $this->retJSON(false, $e,  ["logo" => ["Format file tidak mendukung"] ] );
        }
         
    }

    function perusahaan_edit_act(Request $request){   
        $validated = Validator::make($request->all(), [
            'nama_perusahaan' =>'required|min:5|max:50',
            // 'logo' => 'nullable|file|max:1240|dimensions:min_width=100,min_height=200',
            'logo' => [
                'nullable',
                File::image()
                    // ->min('50kb')
                    ->max('1mb')  
            ], 
            'website' => 'nullable|url:http,https', 
            'alamat_perusahaan' =>   ['required', 'max:200'],
            'email_perusahaan' =>'required|max:50|email:filter_unicode|unique:perusahaan,email_perusahaan,'.$request->id.',id_perusahaan',// live 
            'telp_perusahaan' => 'nullable|numeric|digits_between:10,15|unique:perusahaan,telp_perusahaan,'.$request->id.',id_perusahaan',  
            'industri' => 'required|min:4|max:50', 
            'deskripsi_perusahaan' => 'max:200',  
        ]);  
        if ($validated->fails()) { // All Error 
            return   $this->retJSON(false, 'Errors',  $validated->errors() );
        } 
 
        $pt = Perusahaan::find($request->id);
        $pt->nama_perusahaan = $request->nama_perusahaan;  
        $pt->alamat_perusahaan = $request->alamat_perusahaan;
        $pt->email_perusahaan = $request->email_perusahaan;
        $pt->telp_perusahaan = $request->telp_perusahaan;
        $pt->industri = $request->industri;
        $pt->deskripsi_perusahaan = $request->deskripsi_perusahaan;
        $pt->website = $request->website;
        $logo = $request->file('logo');      
        if($logo != ''){ 
            // return $logo; // OK
            $blob =   file_get_contents($logo, FILE_BINARY);   
            $image = base64_encode($blob);
            $pt->logo_perusahaan  = $image;    
       }  
       try{ 
        $pt->save(); 
        return   $this->retJSON(true, 'Perusahaan  berhasil diperbaharui', null );
       }
       catch (Exception $e){ 
            return   $this->retJSON(false, $e,  ["logo" => ["Format file tidak mendukung"] ] );
       } 
        
    }  


    function retJSON($status, $msg, $data){ 
        return response()->json([
            'status' => $status, 
            'msg' => $msg,
            'data' =>  $data
        ]);
    }

}// 
