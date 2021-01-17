<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Slip Gaji</title>
</head>
@foreach ($query as $item => $value)
<body>
    <table  width="100%">
      <thead>
        <tr>
          <th rowspan="3">
            <img src="{{asset('assets/img/logo.png')}}" width="100">
          </th>
        </tr>
        <tr>
          <th colspan="11">HONOR, TRANSPORT, DAN TUNJANGAN</th>
        </tr>
        <tr>
          <th colspan="11">PIMPINAN/STRUKTURAL/STAF/PEGAWAI TETAP YPS</th>
        </tr>
        <th colspan="11"><hr></th>
        <tr>
          <th>NIK</th>
          <th>:</th>
          <td>{{$value->nik}}</td>
          <td colspan="3"></td>
          <th style="text-align: end">Gaji Pokok</th>
          <th>:</th>
          <td>Rp. {{number_format($value->gaji_pokok,2)}}</td>
        <tr/>
        <tr>
          <th>Nama</th>
          <th>:</th>
          <td>{{$value->nama}}</td>
          <td colspan="3"></td>
          <th style="text-align: end">Tunjangan</th>
          <th>:</th>
          <td>Rp. {{number_format($value->tunjangan,2)}}</td>
        </tr>
        <tr>
          <th>Jabatan</th>
          <th>:</th>
          <td>{{$value->nama_jabatan}}</td>
          <td colspan="3"></td>
          <th style="text-align: end">Transport Pagi ({{$value->jumlah_jam_pagi}}*{{$value->per_jam_pagi}})</th>
          <th>:</th>
          <td>Rp. {{number_format(($value->jumlah_jam_pagi*$value->per_jam_pagi),2)}}</td>
        </tr>
        <tr>
          <th>Periode</th>
          <th>:</th>
          <td>{{Carbon\Carbon::parse($value->periode)->format('M-Y')}}</td>
          <td colspan="3"></td>
          <th  style="text-align: end">Transport Malam ({{$value->jumlah_jam_malam}}*{{$value->per_jam_malam}})</th>
          <th>:</th>
          <td>Rp. {{number_format(($value->jumlah_jam_malam*$value->per_jam_malam),2)}}</td>
        </tr>
          <th colspan="6"></th>
          <th  style="text-align: end">Total</th>
          <th>:</th>
          <td><b>Rp. {{number_format(($value->gaji_pokok)+($value->tunjangan)+($value->jumlah_jam_pagi*$value->per_jam_pagi)+($value->jumlah_jam_malam*$value->per_jam_malam),2)}}</b></td>
        <tr>
      </thead>
    </table>
</body>
@endforeach
<script>
  window.print()
</script>
</html>