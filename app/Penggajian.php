<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    protected $table = 'penggajian';
    protected $fillable = [
        'nik', 'gaji_pokok' , 'periode' , 'status' , 'penggajian' , 'tunjangan',
        'jumlah_jam_pagi' ,'per_jam_pagi','jumlah_jam_malam','per_jam_malam','bonus'
    ];
    // protected $dates = ['periode', 'penggajian'];

    public function scopeGetAllPenggajianData($query)
    {
    	return $query->join('karyawan', 'penggajian.nik', '=', 'karyawan.nik')->select('penggajian.*', 'karyawan.nama')->get();
    }

   	public function scopeGetSingleDataPenggajian($query, $id)
   	{
    	return $query->join('karyawan', 'penggajian.nik', '=', 'karyawan.nik')->select('penggajian.*', 'karyawan.nama')->where('penggajian.id', '=', $id)->select('karyawan.*', 'penggajian.*')->get();
   	}
}
