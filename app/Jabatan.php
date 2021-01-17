<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = ['nama_jabatan' , 'gaji_pokok' , 'tunjangan' , 'transport_malam','transport_pagi' , 'is_malam'];
}