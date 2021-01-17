<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transport';
    protected $fillable = ['nominal' , 'id_jabatan' , 'is_malam'];

    public function scopeGetAllTransportData($query)
    {
    	return $query->join('jabatan', 'jabatan.id', '=', 'transport.id_jabatan')->select('transport.*', 'jabatan.nama_jabatan')->get();
    }
}