<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari','jam_mulai','jam_selesai','ruang','id_mapel','id_rombel','id_guru',
    ];

}
