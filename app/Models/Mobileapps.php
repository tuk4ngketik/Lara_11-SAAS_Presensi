<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// add sanctum
use Laravel\Sanctum\HasApiTokens;

class Mobileapps extends Authenticatable // Ganti
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'karyawans';

    protected $primaryKey = 'id_karyawan';

    
    protected $fillable = [    
        'id_perusahaan', 
        'nama_karyawan', 
    ];
}
