<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_department_divisi';

    protected $primaryKey = 'id_divisi';

    
    protected $fillable = [    
    ];

}
