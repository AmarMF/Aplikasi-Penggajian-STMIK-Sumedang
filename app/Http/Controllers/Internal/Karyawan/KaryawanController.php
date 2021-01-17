<?php

namespace App\Http\Controllers\Internal\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\Jabatan;
use DataTables;
use Validator;
use PDF;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jabatan'] = Jabatan::all();
        return view('internal.karyawan.index',$data);
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
        $rules = [
            'nik'     => 'required',
            'nama'    => 'required',
            'jabatan' => 'required'
        ];

        $messages = [
          'nik.required'      => 'Nomor Induk Karyawan (NIK) perlu diisi!',
          'nama.required'     => 'Nama Lengkap perlu diisi!',
          'jabatan.required'  => 'Jabatan perlu diisi!'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if($validation->fails()){
          return response()->json(['status' => 0, 'errors' => $validation->errors()], 200);
        }else{
          $nik        = $request->nik;
          $nama       = $request->nama;
          $no_rekening       = $request->no_rekening;
          $alamat       = $request->alamat;
          $jabatan    = $request->jabatan;
          $password   = bcrypt($nik);

          $checkdata = Karyawan::where('nik', '=', $nik)->first();

          if(!empty($checkdata)){
            return response()->json(['status' => 2, 'errors' => 'duplicate'], 200);
          }else{
            $data = [
                        'nik'       => $nik,
                        'nama'      => $nama,
                        'id_jabatan'   => $jabatan,
                        'password'  => $password,
                        'no_rekening' => $no_rekening,
                        'alamat' => $alamat
                    ];

            $query = Karyawan::StoreDataKaryawan($data);

            return response()->json(['status' => 1], 200);
          }
        }
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
        $nik        = $request->nik;
        $nama       = $request->nama;
        $jabatan    = $request->jabatan;
        $no_rekening       = $request->no_rekening;
        $alamat       = $request->alamat;

        $data = [
                    'nik'       => $nik,
                    'nama'      => $nama,
                    'id_jabatan'   => $jabatan,
                    'no_rekening' => $no_rekening,
                    'alamat' => $alamat
                ];

        return $query = Karyawan::UpdateDataKaryawan($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Karyawan::DestroyDataKaryawan($id);

        return response()->json(200);
    }

    public function datakaryawan(Datatables $datatables)
    {
        $query = Karyawan::GetAllKaryawanData();

        return DataTables::of($query)
                ->addColumn('action', function($query){
                    return '<center><a onclick="edit('.$query->id.')" class="edit_button btn btn-warning btn-circle"><i class="fa fa-pencil"></i></a> <a onclick="delete_data('.$query->id.')" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a></center>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function singledatakaryawan($id)
    {
        return $query = Karyawan::GetSingleDataKaryawan($id);
    }

    public function printpdf($id)
    {
        $query = Karyawan::GetSingleDataKaryawanWithPayroll($id);

        $pdf = PDF::loadView('internal.penggajian.slip_gaji', compact('query'));
        return $pdf->download('slip_gaji.pdf');
    }
}
