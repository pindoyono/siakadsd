<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi_rombel_mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rombel','id_mapel','id_guru',
    ];
}
