<?php

namespace App\Http\Controllers\Internal\Slipgaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penggajian;
use Carbon\Carbon;
use App\Karyawan;
use App\Absensi;
use App\Upload;
use DataTables;
use Terbilang;
use PDF;
use DB;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;

class SlipgajiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('internal.slipgaji.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function review()
    {
      $query      = Karyawan::GetAllKaryawanDataWithPayrollReview();
      $periode    = Penggajian::orderBy('created_at', 'desc')->groupBy('periode')->first();

      return view('internal.penggajian.review_data', compact('query', 'periode'));
    }

    public function publish()
    {
      $query_penggajian = Penggajian::where('status', '=', 'uploaded')->update(['status' => 1]);
      //$query_absensi = Absensi::where('status', '=', 'uploaded')->update(['status' => 'published']);
    //  $query_upload = Upload::where('status', '=', 'uploaded')->update(['status' => 1]);

      $periode    = Carbon::now()->formatLocalized('%B'.'-'.'%Y');
      $bulan      = Carbon::now()->month;
      $tahun      = Carbon::now()->year;

      return view('internal.slipgaji.index', compact('periode', 'bulan', 'tahun'));
    }

    public function cancelpublish()
    {
      $query_penggajian = Penggajian::where('status', '=', 'uploaded')->delete();
      $query_absensi = Absensi::where('status', '=', 'uploaded')->delete();
      $query_upload = Upload::where('status', '=', 'uploaded')->delete();

      $periode    = Carbon::now()->formatLocalized('%B'.'-'.'%Y');
      $bulan      = Carbon::now()->month;
      $tahun      = Carbon::now()->year;

      return view('internal.slipgaji.index', compact('periode', 'bulan', 'tahun'));
    }

    public function data(DataTables $datatables)
    {
        $upload = Penggajian::orderBy('periode', 'desc')->first();

        if($upload == NULL){
          $bulan = NULL;
        }else{
          $bulan  = $upload->periode;
        }

        $query = Karyawan::GetAllKaryawanDataWithPayroll($bulan);

        return DataTables::of($query)
                ->addColumn('print', function($query){
                  return '<center> <a href="/internal/slipgaji/print_pdf/'.$query->id.'/'.$query->periode->formatLocalized('%B'.'-'.'%Y').'" class="btn btn-primary btn-circle"><i class="fa fa-print"></i></a></center>';
                })
                ->editColumn('periode', function($query){
                  return $query->periode;
                })
                ->rawColumns(['print', 'periode'])
                ->make(true);
    }

    public function datafilter($bulan, $tahun, DataTables $datatables)
    {
        $query = Karyawan::GetFilterAllKaryawanDataWithPayroll($bulan, $tahun);

        return DataTables::of($query)
                ->addColumn('print', function($query){
                    return '<center> <a href="/internal/slipgaji/print_pdf/'.$query->id.'/'.$query->periode->formatLocalized('%B'.'-'.'%Y').'" class="btn btn-primary btn-circle"><i class="fa fa-print"></i></a></center>';
                })
                ->editColumn('periode', function($query){
                  return $query->periode;
                })
                ->rawColumns(['print', 'periode'])
                ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return data into pdf using blade
     */
    public function exportpdfbyid($id, $date)
    {
        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        $query = Karyawan::GetSingleDataKaryawanWithPayroll($id, $date);
        $karyawan = Karyawan::find($id);
        $periode = Karyawan::GetSingleDataKaryawanWithPayroll($id, $date)->first();
        $temp_periode = $periode->periode->format('M_Y');
        return view('internal.penggajian.slip_gaji' , compact('query'));

    }

    /**
    * Export all data to pdf.
    * @return data into pdf using blade
    */
    public function exportpdfall(Request $request)
    {
        $bulan = Carbon::parse($request->tgl_mulai)->format('m');
        $tahun = Carbon::parse($request->tgl_mulai)->format('Y');
        $query = Karyawan::GetFilterAllKaryawanDataWithPayroll($bulan, $tahun);
        $no = [];
        $nama = [];
        $jabatan = [];
        $gaji_pokok = [];
        $tunjangan = [];
        $jumlah = [];
        $hari = [] ;
        $per_jam = [];
        $hari_malam = [] ;
        $per_jam_malam = [];
        $jumlah_transport = [] ;
        $total = [] ;
        $tanda_tangan = [];


        foreach($query as $q => $value)
        {
          array_push($no , ($q+1));
          array_push($nama , $value->nama);
          array_push($jabatan , $value->nama_jabatan);
          array_push($gaji_pokok , $value->gaji_pokok);
          array_push($tunjangan , $value->tunjangan);
          array_push($jumlah , $value->tunjangan+$value->gaji_pokok);
          array_push($hari , $value->jumlah_jam_pagi);
          array_push($per_jam , $value->per_jam_pagi);
          array_push($hari_malam , $value->jumlah_jam_malam);
          array_push($per_jam_malam , $value->per_jam_malam);
          array_push($jumlah_transport , ($value->per_jam_pagi*$value->jumlah_jam_pagi) + ($value->per_jam_malam*$value->jumlah_jam_malam));
          array_push($total , (($value->per_jam_pagi*$value->jumlah_jam_pagi) + ($value->per_jam_malam*$value->jumlah_jam_malam) + ($value->tunjangan+$value->gaji_pokok)));
          array_push($tanda_tangan ,($q+1) );
        }

        $data = [
          '{tgl}' => Carbon::parse($request->tgl_mulai)->format('d-m-Y'),
          '[no]' => $no,
          '[nama]' => $nama,
          '[jabatan]' => $jabatan,
          '[gaji_pokok]' => $gaji_pokok,
          '[tunjangan]' => $tunjangan,
          '[jumlah]' => $jumlah,
          '[hari]' => $hari,
          '[per_jam]' => $per_jam,
          '[hari_malam]' => $hari_malam,
          '[per_jam_malam]' => $per_jam_malam,
          '[jumlah_transport]' => $jumlah_transport,
          '[total]' => $total,
          '[tanda_tangan]' => $tanda_tangan
        ];

        $template = public_path('laporan/template.xlsx');
        
        PhpExcelTemplator::saveToFile($template, public_path('laporan/slip_gaji_periode_'.Carbon::parse($request->tgl_mulai)->format('mY').'.xlsx'), $data);
        PhpExcelTemplator::saveToFile($template, public_path('laporan/slip_gaji_periode_'.Carbon::parse($request->tgl_mulai)->format('mY').'.xlsx'), $data);
        $patahfile = public_path('/laporan/slip_gaji_periode_'.Carbon::parse($request->tgl_mulai)->format('mY').'.xlsx');
        return response()->download($patahfile);
    }
}
