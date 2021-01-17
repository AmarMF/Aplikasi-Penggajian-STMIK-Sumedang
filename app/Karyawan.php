<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Karyawan extends Authenticatable implements JWTSubject
{
    protected $table = 'karyawan';
    protected $hidden = ['password'];
    protected $guard = 'karyawan';
    protected $fillable = ['nik', 'nama', 'password','id_jabatan','no_rekening' , 'alamat'];
    protected $dates = ['periode', 'penggajian'];

    public function scopeGetAllKaryawanData($query)
    {
        return $query->join('jabatan' ,'jabatan.id' ,'=','karyawan.id_jabatan')->select('karyawan.*','jabatan.nama_jabatan')
            ->orderBy('nik', 'desc')
            ->get();
    }

    public function scopeGetAllKaryawanDataWithPayroll($query, $bulan)
    {
    	return $query
        ->join('penggajian', 'karyawan.nik', '=', 'penggajian.nik')
        ->whereDate('penggajian.periode', '=', $bulan)
        ->where('penggajian.status', '=', 1)
        ->groupBy('karyawan.id')
        ->get();
    }

    public function scopeGetFilterAllKaryawanDataWithPayroll($query, $bulan, $tahun)
    {
        return $query
          ->select('*' , 'karyawan.id as id' , 'jabatan.nama_jabatan')
          ->join('jabatan' , 'jabatan.id' ,'=','karyawan.id_jabatan')
          ->join('penggajian', 'karyawan.nik', '=', 'penggajian.nik')
          ->whereMonth('penggajian.periode', $bulan)
          ->whereYear('penggajian.periode', $tahun)
          ->groupBy('karyawan.id')
          ->get();
    }

    public function scopeAPIGetFilterAllKaryawanDataWithPayroll($query, $id, $bulan)
    {
        return $query
          ->join('penggajian', 'karyawan.nik', '=', 'penggajian.nik')
          ->whereDate('penggajian.periode', '=', $bulan)
          ->where('karyawan.id', '=', $id)
          ->groupBy('karyawan.id')
          ->get();
    }

    public function scopeGetSingleDataKaryawan($query, $id )
    {
        return $query->join('jabatan' ,'jabatan.id','=','karyawan.id_jabatan')
                    ->findOrFail($id);
    }

    public function scopeGetSingleDataKaryawanWithPayroll($query, $id, $date = NULL)
    {
        $hasil = $query
          ->join('penggajian', 'karyawan.nik', '=', 'penggajian.nik')
          ->join('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan');
          if($date)
          {
            $hasil = $hasil->where('penggajian.periode', '=', \Carbon\Carbon::parse($date)->format('Y-m-d'));
          }
          
          $hasil = $hasil->where('karyawan.id', '=', $id)
          //->groupBy('karyawan.id')
          ->get();

          return $hasil;

        
    }

    public function scopeGetAllKaryawanDataWithPayrollReview($query)
    {
      return $query
        ->select('*' , 'karyawan.id as id')
        ->join('penggajian', 'karyawan.nik', '=', 'penggajian.nik')
        ->where('penggajian.status', '=', 0)
        ->get();
    }

    public function scopeStoreDataKaryawan($query, $data)
    {
        return $query->create($data);
    }

    public function scopeUpdateDataKaryawan($query, $data, $id)
    {
        return $query->where('id', '=', $id)->update($data);
    }

    public function scopeDestroyDataKaryawan($query, $id)
    {
        return $query->where('id', '=', $id)->delete();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
