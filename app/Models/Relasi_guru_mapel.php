<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi_guru_mapel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_guru','id_mapel','id_rombel',
    ];
}
