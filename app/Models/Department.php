<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_department';

    protected $primaryKey = 'id_department';

    
    protected $fillable = [   
        'id_perusahaan', 
        'nama_departemen', 
    ];

}
