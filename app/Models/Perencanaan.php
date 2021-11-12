<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perencanaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mapel','id_rombel','id_guru','bobot','nama_penilaian'
    ];
}
