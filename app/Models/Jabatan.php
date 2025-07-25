<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_jabatan';

    protected $primaryKey = 'id_jabatan';

    
    protected $fillable = [    
        'nama_jabatan', 
        'kode_jabatan', 
    ];
}
