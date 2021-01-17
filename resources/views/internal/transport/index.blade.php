@extends('internal.layouts.app')

@section('title', 'Penggajian | Internal &raquo; Transport')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transport</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Transport
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a onclick="create()" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah data transport
                </a>

                <hr />

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="transport-table">
                        <thead>
                            <tr>
                                <th>Jabatan</th>
                                <th>Nominal</th>
                                <th>Sip</th>
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
                <h4 class="modal-title" id="myModalLabel">Form tambah data transport</h4>
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
                            <label class="mt-2" for="">Nominal</label>
                            <input type="number" name="nominal" class="form-control" id="nominal">
                            <p class="help-block" id="error-add-nominal">Nominal Perlu Diisi!</p>
                        </div>
                        <div class="col-md-7 col-xs-12">
                            <hr>
                            <label for="is_malam">Sip Malam</label>
                            <input type="checkbox" name="is_malam" value="1"  id="is_malam">
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
                        <input type="hidden" name="id" id="edit-id">
                        <div class="row">
                            <div class="col-md-7 col-xs-12">
                                <label for="">Jabatan</label>
                                <select name="id_jabatan" class="form-control" id="edit-id_jabatan">
                                    <option value=""> Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{$item->id}}"> {{$item->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label class="mt-2" for="">Nominal</label>
                                <input type="number" name="nominal" class="form-control" id="edit-nominal">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <hr>
                                <label for="is_malam">Sip Malam</label>
                                <input type="checkbox" name="is_malam" value="1"  id="edit-is_malam">
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
                <h4 class="modal-title" id="myModalLabel">Form hapus data transport</h4>
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
        $("#error-add-id_jabatan").hide("true");
        $("#error-add-nominal").hide("true");
        var transport_table = $('#transport-table').DataTable({
                                    serverSide: true,
                                    processing: true,
                                    ajax: '/internal/transport/data_transport',
                                    columns: [
                                        {data: 'nama_jabatan'},
                                        {data: 'nominal'},
                                        {data: 'is_malam'},
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
                url: "/internal/transport/single_data_transport/"+id,
                type: "get",
                dataType: "json",
                success: function(data){
                    $('#edit-modal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-nominal').val(data.nominal);
                    $('#edit-id_jabatan').val(data.id_jabatan);
                    if(data.is_malam == 1)
                    {
                        $('#edit-is_malam').prop("checked" , true);
                    }
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
            var is_malam        = $('#is_malam').is(':checked') ? 1 : 0;

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/transport/store",
                type: "post",
                data: {'nominal' : nominal , 'id_jabatan' : id_jabatan , 'is_malam' : is_malam},
                dataType: "json",
                success:function(data){
                    if(data.status == 0){
                      if(data.errors.nominal[0] != null){
                        $("#form-add-nominal").addClass("has-error");
                        $("#error-add-nominal").show("true");
                      }else if(data.errors.id_jabatan[0] != null){
                        $("#form-add-id_jabatan").addClass("has-error");
                        $("#error-add-id_jabatan").show("true");
                      }
                    }else{
                      $('#create-modal').modal('hide');
                      alert('Data berhasil disimpan!');
                      transport_table.ajax.reload();
                    }
                }
            });


        });

        $('.update_button').click(function(){
            var id          = $('#edit-id').val();
            var nominal        = $('#edit-nominal').val();
            var id_jabatan        = $('#edit-id_jabatan').val();
            var is_malam        = $('#edit-is_malam').is(':checked') ? 1 : 0;

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/transport/update/"+id,
                type: "put",
                data: {'id' : id,'nominal' : nominal , 'id_jabatan' : id_jabatan , 'is_malam' : is_malam},
                dataType: "json",
                success:function(data){
                    console.log(data);
                    $('#edit-modal').modal('hide');
                    alert('Data berhasil diedit!');
                    transport_table.ajax.reload();
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
                url: "/internal/transport/destroy/"+id,
                type: "delete",
                data: {'id' : id},
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#destroy-modal').modal('hide');
                    alert('Data berhasil dihapus!');
                    transport_table.ajax.reload();
                }
            });
        });
    </script>
@endpush
