<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nama','email','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','alamat','hp',
    ];

}
