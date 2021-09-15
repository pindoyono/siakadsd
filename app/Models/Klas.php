<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Klas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama','tingkat',
    ];
}
