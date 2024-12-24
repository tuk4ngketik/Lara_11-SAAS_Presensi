<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensilokasi extends Model
{
    use HasFactory;

    protected $table = 'absensi_lokasi';

    protected $primaryKey = 'id_lokasi';

    
    protected $fillable = [    
        'id_perusahaan', 
        'nama_lokasi',
        'alamat_lokasi', 
    ];
}
