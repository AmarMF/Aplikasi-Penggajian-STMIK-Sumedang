<?php

namespace App\Http\Controllers\Internal\Upload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penggajian;
use App\Karyawan;
use Carbon\Carbon;
use App\Absensi;
use App\Upload;
use DataTables;
use Session;
use Excel;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data['karyawan'] = Karyawan::getAllKaryawanData();
      return view('internal.upload.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $temp_periode = $request->temp_periode;
        $penggajian   = Carbon::parse($request->temp_penggajian)->format('Y-m-d H:i:s');;

        $periode      = Carbon::parse($temp_periode)->format('Y-m-d');
      

        $penggajian_cek = Penggajian::where('nik' , $request->nik)->where('periode' , $periode)->first();
        if(!$penggajian_cek)
        {
          
          $newPenggajian = new Penggajian;
          $newPenggajian->nik = $request->nik;
          $newPenggajian->gaji_pokok = $request->gaji_pokok;
          $newPenggajian->periode = $periode;
          $newPenggajian->status = 0;
          $newPenggajian->bonus = $request->bonus;
          $newPenggajian->penggajian = $penggajian;
          $newPenggajian->tunjangan = $request->tunjangan;
          $newPenggajian->jumlah_jam_pagi = $request->hari_pagi*9;
          $newPenggajian->per_jam_pagi = $request->transport_pagi;
          $newPenggajian->jumlah_jam_malam = $request->hari_malam*9;
          $newPenggajian->per_jam_malam = $request->transport_malam;
          $newPenggajian->save();
        }
  

        Session::flash('notification', 'File berhasil di upload ...');
        return redirect(route('slipgaji'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $periode = $request->periode;

      $query_upload = Upload::where('periode', '=', $periode)->delete();
      $query_penggajian = Penggajian::where('periode', '=', $periode)->delete();
      $query_absensi = Absensi::where('periode', '=', $periode)->delete();

      return response()->json([$query_upload, $query_penggajian, $query_absensi]);
    }

    public function data($id)
    {
      $query = Upload::where('id', $id)->first();

      return response()->json($query);
    }

    public function dataupload(Datatables $datatables)
    {
        $query = Upload::GetAllUploadData();

        return DataTables::of($query)
                ->editColumn('periode', function($query){
                    return '<b>'.$query->periode->formatLocalized('%B'.'-'.'%Y').'</b>';
                })
                ->editColumn('created_at', function($query){
                    return '<b>'.$query->created_at->formatLocalized('%d'.'-'.'%B'.'-'.'%Y').'</b>';
                })
                ->addColumn('action', function($query){
                  return '<center><a onclick="delete_data('.$query->id.')" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a></center>';
                })
                ->rawColumns(['periode', 'action', 'created_at'])
                ->make(true);
    }
}
