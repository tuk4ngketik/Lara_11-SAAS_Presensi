<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensiwaktu extends Model
{
    use HasFactory;

    protected $table = 'absensi_waktu';

    protected $primaryKey = 'id_waktu';

    
    protected $fillable = [    
        'id_perusahaan',  
        'shift', 
    ];
}
