<?php

namespace App\Http\Controllers\Internal\Jabatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jabatan;
use DataTables;
use Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.jabatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nama_jabatan'        => 'required',
            'gaji_pokok'        => 'required',
            'tunjangan'        => 'required',
            'transport_pagi'        => 'required',
            
        ];

        $messages = [
          'nama.required'     => 'Nama Jabatan perlu diisi!',
          'gaji_pokok.required'     => 'Gaji Pokok perlu diisi!',
          'tunjangan.required'     => 'Tunjangan Jabatan perlu diisi!',
          'transport_pagi.required'     => 'Transport Pagi perlu diisi!',

        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if($validation->fails()){
          return response()->json(['status' => 0, 'errors' => $validation->errors()], 200);
        }else{
            $nama       = $request->nama_jabatan;
            $gaji_pokok = $request->gaji_pokok;
            $tunjangan       = $request->tunjangan;
            $is_malam =  $request->is_malam;
            $transport_pagi =  $request->transport_pagi;


            $data = [
                        'nama_jabatan'      => $nama,
                        'gaji_pokok' =>$gaji_pokok,
                        'tunjangan' => $tunjangan,
                        'transport_pagi' => $transport_pagi,

                    ];
            if($is_malam == 1)
            {
                $data['transport_malam'] = $request->transport_malam;
            }

            $query = Jabatan::create($data);
            
            return response()->json(['status' => 1], 200);
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
        $nama        = $request->nama_jabatan;

        $data = [
                    'nama_jabatan'       => $nama,
            ];
        $query = Jabatan::find($id)->update($data);
        
        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Jabatan::find($id)->delete();
        return response()->json(200);
    }

    public function singledatajabatan($id)
    {
        return $query = Jabatan::find($id);
    }

    public function datajabatan(DataTables $datatables)
    {
        $query = Jabatan::all();

        return DataTables::of($query)
                ->addColumn('action', function($query){
                    return '<center><a onclick="edit('.$query->id.')" class="edit_button btn btn-warning btn-circle"><i class="fa fa-pencil"></i></a> <a onclick="delete_data('.$query->id.')" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a></center>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
