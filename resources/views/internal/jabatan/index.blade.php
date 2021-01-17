@extends('internal.layouts.app')

@section('title', 'Penggajian | Internal &raquo; Jabatan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Jabatan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Jabatan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a onclick="create()" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah data jabatan
                </a>

                <hr />

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="jabatan-table">
                        <thead>
                            <tr>
                                <th>Nama Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan</th>
                                <th>Transport Pagi</th>
                                <th>Transport Malam</th>
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
                <h4 class="modal-title" id="myModalLabel">Form tambah data jabatan</h4>
            </div>
            <form id="modal-form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div id="form-add-nama" class="form-group">
                        <div class="row">
                            <div class="col-md-7 col-xs-12">
                                <label for="">Nama Jabatan</label>
                                <input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label for="">Gaji Pokok</label>
                                <input type="number" name="nama_jabatan" class="form-control" id="gaji_pokok">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label for="">Tunjangan</label>
                                <input type="number" name="tunjangan" class="form-control" id="tunjangan">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <label for="">Transport</label>
                                <input type="number" name="transport_pagi" class="form-control" id="transport_pagi">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <hr>
                                <label for="is_malam">Sip Malam</label>
                                <input type="checkbox" name="is_malam" value="1"  id="is_malam">
                            </div>
                            <div class="col-md-7 col-xs-12" id="transport_malam">
                                <label for="">Transport Malam</label>
                                <input type="number" name="transport_malam" class="form-control" id="transport_malam_form">
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
                                <label for="">Nama Jabatan</label>
                                <input type="hidden" name="id" id="edit-id">
                                <input type="text" name="nama_jabatan" class="form-control" id="edit-nama">
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
                <h4 class="modal-title" id="myModalLabel">Form hapus data jabatan</h4>
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
        $("#error-add-nama").hide("true");
        $("#error-add-email").hide("true");
        $("#error-add-password").hide("true");
        $("#error-add-duplicate-email").hide("true");
        var jabatan_table = $('#jabatan-table').DataTable({
                                    serverSide: true,
                                    processing: true,
                                    ajax: '/internal/jabatan/data_jabatan',
                                    columns: [
                                        {data: 'nama_jabatan'},
                                        {data: 'gaji_pokok'},
                                        {data: 'tunjangan'},
                                        {data: 'transport_pagi'},
                                        {data: 'transport_malam'},
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
                url: "/internal/jabatan/single_data_jabatan/"+id,
                type: "get",
                dataType: "json",
                success: function(data){
                    console.log(data);
                    $('#edit-modal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-nama').val(data.nama_jabatan);
                }
            });
        }

        function delete_data(id){
            $('#destroy-modal').modal('show');
            $('#destroy-id').val(id);
        }

        $('.store_button').click(function(){
            var nama        = $('#nama_jabatan').val();
            var gaji_pokok        = $('#gaji_pokok').val();
            var tunjangan        = $('#tunjangan').val();
            var is_malam        = $('#is_malam').is(':checked') ? 1 : 0;
            var transport_pagi        = $('#transport_pagi').val();
            var transport_malam        = $('#transport_malam_form').val();


            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/jabatan/store",
                type: "post",
                data: {
                    'nama_jabatan' : nama,
                    'gaji_pokok' : gaji_pokok,
                    'tunjangan' : tunjangan,
                    'is_malam' : is_malam,
                    'transport_pagi' : transport_pagi,
                    'transport_malam' : transport_malam
                },
                dataType: "json",
                success:function(data){
                    if(data.status == 0){
                      if(data.errors.nama_jabatan[0] != null){
                        $("#form-add-nama").addClass("has-error");
                        $("#error-add-nama").show("true");
                      }
                    }else{
                      $('#create-modal').modal('hide');
                      alert('Data berhasil disimpan!');
                      jabatan_table.ajax.reload();
                    }
                }
            });


        });

        $('.update_button').click(function(){
            var id          = $('#edit-id').val();
            var nama        = $('#edit-nama').val();

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/jabatan/update/"+id,
                type: "put",
                data: {'id' : id, 'nama_jabatan' : nama},
                dataType: "json",
                success:function(data){
                    console.log(data);
                    $('#edit-modal').modal('hide');
                    alert('Data berhasil diedit!');
                    jabatan_table.ajax.reload();
                }
            });


        });
        $('#transport_malam').hide();
        $('#is_malam').click(function(){
            if($('#is_malam').is(':checked')){
               
                $('#transport_malam').show();
            }else
            {
                $('#transport_malam').hide();
            }
        })
        

        $('.destroy_button').click(function(){
            var id = $('#destroy-id').val();
            var token = $('meta[name="csrf-token').attr('content');

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/jabatan/destroy/"+id,
                type: "delete",
                data: {'id' : id},
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#destroy-modal').modal('hide');
                    alert('Data berhasil dihapus!');
                    jabatan_table.ajax.reload();
                }
            });
        });
    </script>
@endpush
