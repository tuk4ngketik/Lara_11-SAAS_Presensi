<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
use Illuminate\Foundation\Auth\User as Authenticatable; // Wajib untuk Auth

// class Daftar extends Model
class Daftar extends Authenticatable // Ganti
{
    use HasFactory;

    protected $table = 'perusahaan_pendaftar';

    protected $primaryKey = 'id_pendaftar';

    
    protected $fillable = [   
        'nama',
        'email',
        'password', 
    ];


}
