@extends('internal.layouts.app')

@section('title', 'Penggajian | Internal &raquo; Karyawan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Karyawan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Karyawan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a onclick="create()" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah data karyawan
                </a>

                <hr />

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="karyawan-table">
                        <thead>
                            <tr>
                                <th width="100">NIK</th>
                                <th>Nama Karyawan</th>
                                <th>No Rekening</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
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
                <h4 class="modal-title" id="myModalLabel">Form tambah data karyawan</h4>
            </div>
            <form id="modal-form">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div id="form-add-nik" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Nomor Induk Karyawan</label>
                                <input type="text" name="nik" class="form-control" id="nik">
                                <p class="help-block" id="error-add-nik">Nomor Induk Karyawan Perlu Diisi!</p>
                                <p class="help-block" id="error-add-duplicate-nik">Nomor Induk Karyawan Sudah ada!</p>
                            </div>
                        </div>
                    </div>
                    <div id="form-add-nama" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama">
                                <p class="help-block" id="error-add-nama">Nomor Lengkap Perlu Diisi!</p>
                            </div>
                        </div>
                    </div>
                    <div id="form-add-nama" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">No Rekening</label>
                                <input type="text" name="no_rekening" class="form-control" id="no_rekening">
                            </div>
                        </div>
                    </div>
                    <div id="form-add-alamat" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Alamat</label>
                                <textarea type="text" name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="form-add-jabatan" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Jabatan</label>
                                <select name="jabatan" class="form-control basic" id="jabatan">
                                   <option value="">Pilih Jabatan</option>
                                   @foreach ($jabatan as $item)
                                        <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
                                   @endforeach
                                </select>
                                <p class="help-block" id="error-add-jabatan">Jabatan Lengkap Perlu Diisi!</p>
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
                            <div class="col-md-5 col-xs-12">
                                <label for="">Nomor Induk Karyawan</label>
                                <input type="hidden" name="id" id="edit-id">
                                <input type="text" name="nik" class="form-control" id="edit-nik">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7 col-xs-12">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="edit-nama">
                            </div>
                        </div>
                    </div>
                    <div id="form-add-nama" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">No Rekening</label>
                                <input type="text" name="no_rekening" class="form-control" id="edit-no_rekening">
                            </div>
                        </div>
                    </div>
                    <div id="form-add-alamat" class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Alamat</label>
                                <textarea type="text" name="alamat" class="form-control" id="edit-alamat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <label for="">Jabatan</label>
                                <select name="jabatan" class="form-control basic" id="edit-jabatan">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                         <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
                                    @endforeach
                                 </select>
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
                <h4 class="modal-title" id="myModalLabel">Form edit data karyawan</h4>
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
        $(document).ready(function() {
            $('.basic').select2();
        });
        $("#error-add-nik").hide("true");
        $("#error-add-nama").hide("true");
        $("#error-add-jabatan").hide("true");
        $("#error-add-duplicate-nik").hide("true");

        var karyawan_table = $('#karyawan-table').DataTable({
                                    serverSide: true,
                                    processing: true,
                                    ajax: '/internal/karyawan/data_karyawan',
                                    columns: [
                                        {data: 'nik'},
                                        {data: 'nama'},
                                        {data : 'no_rekening'},
                                        {data : 'alamat'},
                                        {data: 'nama_jabatan'},
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
                url: "/internal/karyawan/single_data_karyawan/"+id,
                type: "get",
                dataType: "json",
                success: function(data){
                    console.log(data);
                    $('#edit-modal').modal('show');
                    $('#edit-id').val(data.id);
                    $('#edit-nik').val(data.nik);
                    $('#edit-nama').val(data.nama);
                    $('#edit-jabatan').select2("val", data.id_jabatan);
                    $('#edit-no_rekening').select2("val", data.no_rekening);
                    $('#edit-alamat').select2("val", data.alamat);

                }
            });
        }

        function delete_data(id){
            $('#destroy-modal').modal('show');
            $('#destroy-id').val(id);
        }

        function printpdf(id)
        {
            var id = id;

            $.ajax({
                url: "/internal/karyawan/print_pdf/"+id,
                type: "get",
                data: {'id' : id},
                dataType: 'json',
                success:function(data){
                    console.log(data);
                }
            });
        }

        $('.store_button').click(function(){
            var nik         = $('#nik').val();
            var nama        = $('#nama').val();
            var jabatan     = $('#jabatan').val();
            var no_rekening     = $('#no_rekening').val();
            var alamat     = $('#alamat').val();


            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/karyawan/store",
                type: "post",
                data: {'nik' : nik, 'nama' : nama, 'jabatan' : jabatan , 'no_rekening' : no_rekening , 'alamat' : alamat},
                dataType: "json",
                success:function(data){
                    console.log(data);
                    if(data.status == 0){
                      if(data.errors.nik[0] != null){
                        console.log('Error');
                        $("#form-add-nik").addClass("has-error");
                        $("#error-add-nik").show("true");
                      }
                      if(data.errors.nama[0] != null){
                        console.log('Error');
                        $("#form-add-nama").addClass("has-error");
                        $("#error-add-nama").show("true");
                      }
                      if(data.errors.jabatan[0] != null){
                        console.log('Error');
                        $("#form-add-jabatan").addClass("has-error");
                        $("#error-add-jabatan").show("true");
                      }
                    }else if(data.status == 2){
                      if(data.errors == "duplicate"){
                        $("#form-add-nik").addClass("has-error");
                        $("#error-add-duplicate-nik").show("true");
                      }
                    }else{
                      $('#create-modal').modal('hide');
                      alert('Data berhasil disimpan!');
                      karyawan_table.ajax.reload();
                    }
                }
            });


        });

        $('.update_button').click(function(){
            var id          = $('#edit-id').val();
            var nik         = $('#edit-nik').val();
            var nama        = $('#edit-nama').val();
            var jabatan     = $('#edit-jabatan').val();
            var no_rekening     = $('#edit-no_rekening').val();
            var alamat     = $('#edit-alamat').val();

            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/internal/karyawan/update/"+id,
                type: "put",
                data: {'id' : id, 'nik' : nik, 'nama' : nama, 'jabatan' : jabatan , 'no_rekening' : no_rekening , 'alamat' : alamat},
                dataType: "json",
                success:function(data){
                    $('#edit-modal').modal('hide');
                    alert('Data berhasil diedit!');
                    karyawan_table.ajax.reload();
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
                url: "/internal/karyawan/destroy/"+id,
                type: "delete",
                data: {'id' : id},
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#destroy-modal').modal('hide');
                    alert('Data berhasil dihapus!');
                    karyawan_table.ajax.reload();
                }
            });
        });
    </script>
@endpush
