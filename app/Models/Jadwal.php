<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'absensi_jadwal';

    protected $primaryKey = 'id_jadwal';

    
    protected $fillable = [     
    ];
}
