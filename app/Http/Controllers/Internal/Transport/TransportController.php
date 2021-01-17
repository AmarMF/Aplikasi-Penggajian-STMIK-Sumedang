<?php

namespace App\Http\Controllers\Internal\Transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transport;
use App\Jabatan;
use DataTables;
use Validator;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jabatan'] = Jabatan::select('id' , 'nama_jabatan')->get();
        return view('internal.transport.index',$data);
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
            'nominal'        => 'required',
            'id_jabatan'        => 'required',
        ];

        $messages = [
          'nama.required'     => 'Nominal perlu diisi!',
          'id_jabatan.required'     => 'Jabatan  perlu diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if($validation->fails()){
          return response()->json(['status' => 0, 'errors' => $validation->errors()], 200);
        }else{
            $nominal       = $request->nominal;
            $id_jabatan       = $request->id_jabatan;
            $is_malam = $request->is_malam ? 1 : 0 ;


            $data = [
                        'nominal'      => $nominal,
                        'id_jabatan'      => $id_jabatan,
                        'is_malam'      => $is_malam,
                    ];
            $query = Transport::create($data);
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
        $nominal       = $request->nominal;
        $id_jabatan       = $request->id_jabatan;
        $is_malam = $request->is_malam ? 1 : 0 ;
        $data = [
            'nama_transport'      => $nominal,
            'id_jabatan'      => $id_jabatan,
            'is_malam'      => $is_malam,
            ];
        $query = Transport::find($id)->update($data);
        
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
        $query = Transport::find($id)->delete();
        return response()->json(200);
    }

    public function singledatatransport($id)
    {
        return $query = Transport::find($id);
    }

    public function datatransport(DataTables $datatables)
    {
        $query = Transport::getAllTransportData();

        return DataTables::of($query)
                ->addColumn('is_malam' , function($query) {
                    return $query->is_malam == 1 ? '<span class="badge badge-warning">Malam</span>' : '<span class="badge badge-success">Siang</span>';
                })
                ->addColumn('action', function($query){
                    return '<center><a onclick="edit('.$query->id.')" class="edit_button btn btn-warning btn-circle"><i class="fa fa-pencil"></i></a> <a onclick="delete_data('.$query->id.')" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a></center>';
                })
                ->rawColumns(['action' , 'is_malam'])
                ->make(true);
    }
}
