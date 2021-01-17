<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    protected $table = 'tunjangan';
    protected $fillable = ['nominal' , 'id_jabatan'];

    public function scopeGetAllTunjanganData($query)
    {
    	return $query->join('jabatan', 'jabatan.id', '=', 'tunjangan.id_jabatan')->select('tunjangan.*', 'jabatan.nama_jabatan')->get();
    }

}