@extends('internal.layouts.app')

@section('title', 'Penggajian | Internal &raquo; Tunjangan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tunjangan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Tunjangan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a onclick="create()" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah data tunjangan
                </a>

                <hr />

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="tunjangan-table">
                        <thead>
                            <tr>
                                <th>Jabatan</th>
                                <th>Nominal</th>
                                <th width="100">Opsi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Form tambah data tunjangan</h4>
            </div>
            <form id="modal-form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div id="form-add-nama" class="form-group">
                        <div class="row">
                            <div class="col-md-7 col-xs-12">
                                <label for="">Jabatan</label>
                                <select name="id_jabatan" class="form-control" id="id_jabatan">
                                    <option value=""> Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{$item->id}}"> {{$item->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block" id="error-add-id_jabatan">Jabatan Perlu Diisi!</p>
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label for="">Nominal</label>
                                <input type="number" name="nominal" class="form-control" id="nominal">
                                <p class="help-block" id="error-add-nominal">Nominal Perlu Diisi!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary store_button">Simpan</button>
                </div>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Form edit data karyawan</h4>
            </div>
            <form id="edit-modal-form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7 col-xs-12">
                                <label for="">Jabatan</label>
                                <select name="id_jabatan" class="form-control" id="edit-id_jabatan">
                                    <option value=""> Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{$item->id}}"> {{$item->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block" id="error-add-id_jabatan">Jabatan Perlu Diisi!</p>
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label for="">Nominal</label>
                                <input type="hidden" name="id" id="edit-id">
                                <input type="text" name="nominal" class="form-control" id="edit-nominal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary update_button">Simpan</button>
                </div>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Form hapus data tunjangan</h4>
            </div>
            <form id="destroy-modal-form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-xs-12">
                                Yakin akan menghapus data ini?
                                <input type="hidden" name="_method" value="DELETE" id="destroy-method">
                                <input type="hidden" name="id" id="destroy-id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger destroy_button">Hapus</button>
                </div>
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@push('js')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

    <script>
        $("#error-add-nominal").hide("true");
        $("#error-add-id_jabatan").hide("true");
        var tunjangan_table = $('#tunjangan-table').DataTable({
                                    serverSide: true,
                                    processing: true,
                                    ajax: '/internal/tunjangan/data_tunjangan',
                                    columns: [
                                        {data: 'nama_jabatan'},
                                        {data: 'nominal'},
                                        {data: 'action', orderable: false, searchable: false}
                                    ]
                                });

        function create()
        {
            $('#modal-form')[0].reset();
            $('#create-modal').modal('show');
        }

        function edit(id)
        {
            $.ajax({
                url: "/internal/tunjangan/single_data_tunjangan/"+id,
                type: "get",
                dataType: "json",
                success: function(data){
                    console.log(data);
                    $('#edit-modal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-nominal').val(data.nominal);
                    $('#edit-id_jabatan').val(data.id_jabatan);
                }
            });
        }

        function delete_data(id){
            $('#destroy-modal').modal('show');
            $('#destroy-id').val(id);
        }

        $('.store_button').click(function(){
            var nominal        = $('#nominal').val();
            var id_jabatan        = $('#id_jabatan').val();
            

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/tunjangan/store",
                type: "post",
                data: {'nominal' : nominal , 'id_jabatan' : id_jabatan},
                dataType: "json",
                success:function(data){
                    if(data.status == 0){
                      if(data.errors.nominal[0] != null){
                        $("#form-add-nominal").addClass("has-error");
                        $("#error-add-nominal").show("true");
                      }
                    }else{
                      $('#create-modal').modal('hide');
                      alert('Data berhasil disimpan!');
                      tunjangan_table.ajax.reload();
                    }
                }
            });


        });

        $('.update_button').click(function(){
            var id          = $('#edit-id').val();
            var nominal        = $('#edit-nominal').val();
            var id_jabatan        = $('#edit-id_jabatan').val();

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/tunjangan/update/"+id,
                type: "put",
                data: {'id' : id,'nominal' : nominal , 'id_jabatan' : id_jabatan},
                dataType: "json",
                success:function(data){
                    $('#edit-modal').modal('hide');
                    alert('Data berhasil diedit!');
                    tunjangan_table.ajax.reload();
                }
            });


        });

        $('.destroy_button').click(function(){
            var id = $('#destroy-id').val();
            var token = $('meta[name="csrf-token').attr('content');

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/tunjangan/destroy/"+id,
                type: "delete",
                data: {'id' : id},
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#destroy-modal').modal('hide');
                    alert('Data berhasil dihapus!');
                    tunjangan_table.ajax.reload();
                }
            });
        });
    </script>
@endpush
