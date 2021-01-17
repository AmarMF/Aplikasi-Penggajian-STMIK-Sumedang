@extends('internal.layouts.app')

@section('title', 'Penggajian | Internal &raquo; Upload')

@push('css')
  <style>
    td.details-control {
      background: url('/assets/img/details_open.png') no-repeat center center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('/assets/img/details_close.png') no-repeat center center;
    }
  </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Penggajian</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            @if(Session::has('notification'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">&times;</button>
                    {{ Session::get('notification') }}
                </div>
            @endif
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Form Input Penggajian
                </div>
                <div class="panel-body">
                    <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data" id="formupload">
                        {{ csrf_field() }}
                        <input type="hidden" name="nik" id="nik">
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-12 col-xs-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <label for="">Karyawan</label>
                                <div class="form-group">
                                  <select class="form-control basic-select" name="id_karyawan" id="id_karyawan" required>
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($karyawan as $item)
                                      <option value="{{$item->id}}">{{$item->nik}} - {{$item->nama}}</option>
                                    @endforeach 
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-3">
                                    <label for="">Periode</label>
                                    <div class="input-group date" id="periode">
                                      <input type="text" name="periode" class="form-control" readonly required/>
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                    </div>
                                    <input type="hidden" name="temp_periode" id="temp_periode" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Tanggal Penggajian</label>
                                    <div class="input-group date" id="penggajian">
                                      <input type="text" name="penggajian" class="form-control" readonly/>
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                    </div>
                                    <input type="hidden" name="temp_penggajian" id="temp_penggajian">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                          <tr>
                            <th>Gaji Pokok</th>
                            <th>:</th>
                            <th></th>
                            <th></th>
                            <td><input type="number" name="gaji_pokok" class="form-control" id="gaji_pokok" readonly></td>
                          </tr>
                          <tr>
                            <th>Tunjangan</th>
                            <th>:</th>
                            <th></th>
                            <th></th>
                            <td ><input type="number" name="tunjangan" class="form-control" id="tunjangan" readonly></td>
                          </tr>
                          <tr>
                            <th>Bonus</th>
                            <th>:</th>
                            <th></th>
                            <th></th>
                            <td ><input type="number" name="bonus" class="form-control" id="bonus" value="0"></td>
                          </tr>
                          <tr>
                            <th>Transport</th>
                            <th>:</th>
                            <td>Hari (* 9 Jam Kerja)<input type="number" name="hari_pagi" class="form-control" id="hari_pagi" required></td>
                            <td>Transport/Perjam<input type="number" name="transport_pagi" class="form-control" id="transport_pagi" readonly></td>
                            <td>Total<input type="number" name="total_transport_pagi" class="form-control" id="total_transport_pagi" value="0" readonly></td>
                          </tr>
                          <tr id="is_malam" style="display: none">
                            <th>Transport Malam</th>
                            <th>:</th>
                            <td>Hari<input type="number" name="hari_malam" class="form-control" id="hari_malam" value="0"></td>
                            <td>Transport/Perjam<input type="number" name="transport_malam" class="form-control" id="transport_malam" value="0" readonly></td>
                            <td>Total<input type="number" name="total_transport_malam" class="form-control" id="total_transport_malam" value="0" readonly></td>
                          </tr>
                          <tr>
                            <th></th>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td>Gaji Bersih<input type="number" name="gaji_bersih" class="form-control" id="gaji_bersih" readonly></td>
                          </tr>
                        </table>
                        <button type="submit" name="store" id="upload" class="btn btn-sm btn-primary"><i class="fa fa-upload" id="iconupload"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Reset</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
  
@endsection

@push('js')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/id.js"></script>

  <script>

  $(document).ready(function() {
      $('.basic-select').select2();
      $(".basic-select").change(function(e){
          var nik = $(this).val() ;
          $.ajax({
                url: "/internal/karyawan/single_data_karyawan/"+nik,
                type: "get",
                dataType: "json",
                success: function(data){
                  $('#tunjangan').val(data.tunjangan)
                  $('#nik').val(data.nik)
                  $('#gaji_pokok').val(data.gaji_pokok)
                  $('#transport_pagi').val(data.transport_pagi)
                  $('#transport_malam').val(data.transport_malam)
                  $('#is_malam').hide();
                  if(data.is_malam == 1)
                  {
                    $('#is_malam').show();
                  }
                  gaji_bersih()
                }
            });
      });
      $("#hari_pagi").on("input" , function(){
          var val = $(this).val()
          if(val > 0)
          {
              var hasil = (val*9) * $('#transport_pagi').val()
              $('#total_transport_pagi').val(hasil)
              gaji_bersih()
              
          }else
          {
            $('#total_transport_pagi').val(0)
            gaji_bersih()
          }
      })
      $("#hari_malam").on("input" , function(){
          var val = $(this).val()
          if(val > 0)
          {
              var hasil = (val*9) * $('#transport_malam').val()
              $('#total_transport_malam').val(hasil)
              gaji_bersih()
              
          }else
          {
            $('#total_transport_malam').val(0)
            gaji_bersih()
          }
      })
      $("#bonus").on("input" , function(){
          var val = $(this).val()
          if(val > 0)
          {
            
              gaji_bersih()
              
          }
      })
  });

  function gaji_bersih()
  {
    var total = parseInt($('#gaji_pokok').val())+parseInt($('#tunjangan').val())+parseInt($('#total_transport_pagi').val())+parseInt($('#total_transport_malam').val())+parseInt($('#bonus').val());

    if(total > 0)
    {
      $('#gaji_bersih').val(total)
    }else
    {
      $('#gaji_bersih').val(0)
    }
  }

  $("#excel_gaji").change(function(e){
    var excel_gaji_file_name = e.target.files[0].name;
    $("#temp_excel_gaji").val(excel_gaji_file_name);
    console.log(excel_gaji_file_name);
  });

  $("#excel_rekap_absensi").change(function(e){
    var excel_rekap_absensi_file_name = e.target.files[0].name;
    $("#temp_excel_rekap_absensi").val(excel_rekap_absensi_file_name);
    console.log(excel_rekap_absensi_file_name);
  });

  var upload_table = $('#upload-table').DataTable({
                              serverSide: true,
                              processing: true,
                              ajax: '/internal/upload/data_upload',
                              columns: [
                                  {
                                      "className": 'details-control',
                                      "orderable": false,
                                      "data": null,
                                      "defaultContent": ''
                                  },
                                  {data: 'periode'},
                                  {data: 'created_at'},
                                  {data: 'action', orderable: false, searchable: false}
                              ]
                          });

    function format(item){
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>File :</td>'+
                '<td>'+item.file+'</td>'+
            '</tr>'+
        '</table>';
    }

    $('#upload-table tbody').on('click', 'td.details-control', function (){
      var tr = $(this).closest('tr');
      var row = upload_table.row(tr);

      if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          // Open this row
          row.child(format(row.data())).show();
          tr.addClass('shown');
      }
    });

    $("#formupload").submit(function(){
      $("#upload").prop('disabled', true);
      $("#iconupload").removeClass('fa fa-upload').addClass('fa fa-refresh fa-spin');
    });

    $('#periode').datepicker({
      locale: 'id',
      format: {
        toDisplay: function (date, format, language) {
            var mm     = date.getMonth()+1;
            var yyyy   = date.getFullYear();

            if(mm == 01){
              return today = 'Januari'+'-'+yyyy;
            }else if(mm == 02){
              return today = 'Februari'+'-'+yyyy;
            }else if(mm == 03){
              return today = 'Maret'+'-'+yyyy;
            }else if(mm == 04){
              return today = 'April'+'-'+yyyy;
            }else if(mm == 05){
              return today = 'Mei'+'-'+yyyy;
            }else if(mm == 06){
              return today = 'Juni'+'-'+yyyy;
            }else if(mm == 07){
              return today = 'Juli'+'-'+yyyy;
            }else if(mm == 08){
              return today = 'Agustus'+'-'+yyyy;
            }else if(mm == 09){
              return today = 'September'+'-'+yyyy;
            }else if(mm == 10){
              return today = 'Oktober'+'-'+yyyy;
            }else if(mm == 11){
              return today = 'November'+'-'+yyyy;
            }else if(mm == 12){
              return today = 'Desember'+'-'+yyyy;
            }
        },
        toValue: function (date, format, language) {
          var mm     = date.getMonth()+1;
          var yyyy   = date.getFullYear();
            return mm;
        }
      },
      minViewMode: "months"
    });

    $('#periode').change(function(){
      console.log('Running');
      $('#temp_periode').val(moment($('#periode').datepicker('getDate')).format('YYYY/MM/DD'));
    });

    $('#penggajian').datepicker({
      locale: 'id',
      format: {
        toDisplay: function (date, format, language) {
            var dd     = date.getDate();
            var mm     = date.getMonth()+1;
            var yyyy   = date.getFullYear();

            if(mm == 01){
              return today = dd+' '+'Januari'+' '+yyyy;
            }else if(mm == 02){
              return today = dd+' '+'Februari'+' '+yyyy;
            }else if(mm == 03){
              return today = dd+' '+'Maret'+' '+yyyy;
            }else if(mm == 04){
              return today = dd+' '+'April'+' '+yyyy;
            }else if(mm == 05){
              return today = dd+' '+'Mei'+' '+yyyy;
            }else if(mm == 06){
              return today = dd+' '+'Juni'+' '+yyyy;
            }else if(mm == 07){
              return today = dd+' '+'Juli'+' '+yyyy;
            }else if(mm == 08){
              return today = dd+' '+'Agustus'+' '+yyyy;
            }else if(mm == 09){
              return today = dd+' '+'September'+' '+yyyy;
            }else if(mm == 10){
              return today = dd+' '+'Oktober'+' '+yyyy;
            }else if(mm == 11){
              return today = dd+' '+'November'+' '+yyyy;
            }else if(mm == 12){
              return today = dd+' '+'Desember'+' '+yyyy;
            }
        },
        toValue: function (date, format, language) {
          var mm     = date.getMonth()+1;
          var yyyy   = date.getFullYear();
            return mm;
        }
      }
    });

    $('#penggajian').change(function(){
      console.log('Running');
      $('#temp_penggajian').val(moment($('#penggajian').datepicker('getDate')).format('YYYY/MM/DD'));
    });

    function delete_data(id){
      $.ajax({
          url: "/internal/upload/data/"+id,
          type: "get",
          dataType: 'json',
          success:function(data){
                $('#destroy-modal').modal('show');
                $('#destroy-periode').val(data.periode);
          }
      });
    }

    $('.destroy_button').click(function(){
        var periode = $('#destroy-periode').val();
        var token = $('meta[name="csrf-token').attr('content');
        console.log(periode);
        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/internal/upload/destroy/",
            type: "delete",
            data: {'periode' : periode},
            dataType: 'json',
            success:function(data){
                console.log(data);
                $('#destroy-modal').modal('hide');
                alert('Data berhasil dihapus!');
                upload_table.ajax.reload();
            }
        });
    });
  </script>
@endpush
