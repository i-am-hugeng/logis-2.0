@extends('layouts.main', ['title' => 'Rapat Pembahasan'])

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Rapat Pembahasan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <input type="hidden" id="level" value="{{ Auth::user()->level }}">
    <input type="hidden" id="id_admin" value="{{ Auth::user()->id }}">
    <div id="konten"></div>

    {{-- Modal Lihat Penerap --}}
    <div class="modal fade" data-backdrop="static" id="modal-lihat-penerap">
        <form id="form-penerap">
            <div class="modal-dialog modal-lg modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Penerap</h4>
                        <button type="button" class="close" id="tutup-modal-lihat-penerap" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="body-lihat-penerap" class="modal-body">

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>
    {{-- End of - Modal SNI Lama, Komtek, Penerap --}}

    {{-- Modal Konfirmasi Hapus SNI --}}
    <div class="modal fade" id="modal-konfirmasi-hapus-sni">
        <form id="form-konfirmasi-hapus-sni">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Data SNI Pembahasan</h4>
                    <button type="button" class="close tutup-modal-konfirmasi-hapus-sni" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="body-konfirmasi-hapus-sni">
                      
                      
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default tutup-modal-konfirmasi-hapus-sni" data-dismiss="modal">Batal</button>
                    <button type="submit" id="tombol-hapus-sni" class="btn btn-danger">Hapus</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    {{-- End of - Modal Konfirmasi Hapus SK --}}

    <!-- {{-- Modal Lihat Detail Rapat Pembahasan --}} -->
    <div class="modal fade" id="modal-lihat-detail-rapat-pembahasan">
        <form id="form-lihat-detail-rapat-pembahasan" enctype="multipart/form-data">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title inline">
                            Data Detail Rapat Pembahasan
                            <button type="button" class="btn btn-sm btn-success" id="tombol-unduh-excel" title="unduh tabel">
                                <span class="fas fa-file-excel"></span>
                            </button>
                        </h4>
                        <button type="button" class="close tutup-modal-lihat-detail-rapat-pembahasan" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" id="id_rapat">
                        </div>

                        <table class="mb-3">
                            <tr class="form-group">
                                <th class="col-sm-2">PIC Rapat</th>
                                <td>:</td>
                                <td class="col-sm-10 reset-value" id="pic_rapat"></td>
                            </tr>
                            <tr class="form-group">
                                <th class="col-sm-2">Tanggal Rapat</th>
                                <td>:</td>
                                <td class="col-sm-10 reset-value"  id="tanggal_rapat"></td>
                            </tr>
                        </table>
                        <table class="mb-3 table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">SNI Revisi</th>
                                    <th class="text-center">SNI Direvisi</th>
                                    <th class="text-center">Komtek</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Batas Transisi</th>
                                    <th class="text-center">Catatan</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-pembahasan">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger tutup-modal-lihat-detail-rapat-pembahasan" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    <!-- {{-- End of - Modal Lihat Detail Rapat Pembahasan --}} -->

    {{-- Modal Edit Rapat Pembahasan --}}
    <div class="modal fade" data-backdrop="static" id="modal-edit-rapat-pembahasan">
        <form id="form-edit-rapat-pembahasan">
            <div class="modal-dialog modal-xl modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Hasil Rapat Pembahasan</h4>
                        <button type="button" class="close" id="tutup-modal-edit-rapat-pembahasan" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="body-edit-rapat-pembahasan" class="modal-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">SNI Baru</th>
                                <th class="text-center">SNI Lama</th>
                                <th class="text-center">Komtek</th>
                                <th class="text-center">Status Pembahasan</th>
                                <th class="text-center">Catatan</th>
                            </thead>
                            <tbody id="data-edit-rapat-pembahasan">
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button id="tombol-edit-rapat-pembahasan" type="submit" class="btn btn-primary col-sm-2">Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>
    {{-- End of - Modal SNI Lama, Komtek, Penerap --}}

@endsection

@push('css')
    
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            //define Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            if($('#level').val() == 0) {
                $.ajax({
                    type: "GET",
                    url: "/rapat-pembahasan/konten-super-admin",
                    dataType: "JSON",
                    success: function (response) {
                        $('#konten').append(
                            '<div class="card">\
                                <div class="card-header">\
                                    <h3 class="card-title">Pembahasan Rapat Masa Transisi SNI</h3>\
                                </div>\
                                <div class="card-body">\
                                    <table class="table table-bordered table-hover" id="pembahasan-dt">\
                                        <thead class="bg-dark text-white">\
                                            <tr>\
                                                <th>Tanggal Rapat</th>\
                                                <th>PIC Rapat</th>\
                                                <th>Jumlah SNI</th>\
                                                <th>Status Pembahasan</th>\
                                            </tr>\
                                        </thead>\
                                    </table>\
                                </div>\
                                <!-- /.card-body -->\
                            </div>'
                        );

                        rapat_pembahasan_dt();

                        function rapat_pembahasan_dt() {
                            $('#pembahasan-dt').DataTable({
                                language: {
                                    url: "/json/id.json"
                                },
                                serverside: true,
                                ajax: {
                                    url: "/rapat-pembahasan/konten-super-admin",
                                    type: "GET",
                                },
                                columns: [
                                    {
                                        data : 'tanggal_rapat',
                                        name : 'tanggal_rapat',
                                        render : function(data, type, row, meta) {
                                            return '<a href="javascript:void(0)" id="'+ row.id +'" class="lihat-detail-pembahasan" title="lihat detail pembahasan">'+ row.tanggal_rapat +'</a>';
                                        }
                                    },
                                    {
                                        data : 'pic_rapat',
                                        name : 'pic_rapat',
                                    },
                                    {
                                        data : 'jumlah_sni',
                                        name : 'jumlah_sni',
                                    },
                                    {
                                        data : 'status_pembahasan',
                                        name : 'status_pembahasan',
                                        orderable : false,
                                        searchable : false,
                                        render :
                                            function(data, type, row) {
                                                if(row.status_pembahasan == 0) {
                                                    return row.status_pembahasan = '<span class="badge badge-warning">Belum dibahas</span>';
                                                }
                                                else {
                                                    return row.status_pembahasan = '<span class="badge badge-success">Sudah dibahas</span>';
                                                }
                                            }
                                    },
                                ],
                                order : [[0, 'desc']],
                            });
                        }

                        /**********************************************/
                        /******* Lihat Detail Rapat Pembahasan ********/
                        /**********************************************/
                        $('body').on('click', '.lihat-detail-pembahasan', function() {
                            var id_rapat = $(this).attr('id');

                            $('#modal-lihat-detail-rapat-pembahasan').modal('show');

                            $.ajax({
                                type: "GET",
                                url: "/rapat-pembahasan/konten-super-admin/lihat-detail-pembahasan/"+id_rapat,
                                success: function(response) {
                                    $('#id_rapat').val(response.detail_rapat.id);
                                    $('#pic_rapat').html(response.detail_rapat.pic_rapat);
                                    $('#tanggal_rapat').html(response.detail_rapat.tanggal_rapat);
                                    
                                    $.each(response.pembahasan, function(key, item) {
                                        $('#tabel-pembahasan').append(
                                            '<tr>\
                                                <td class="text-center align-text-top">'+(key+1)+'</td>\
                                                <td style="width:20%" class="align-text-top">'+item.nmr_sni_baru+'<br/>'+item.jdl_sni_baru+'</td>\
                                                <td style="width:20%" class="align-text-top">'+item.nmr_sni_lama+'<br/>'+item.jdl_sni_lama+'</td>\
                                                <td style="width:20%" class="align-text-top">'+item.komtek+'</td>\
                                                <td style="width:10%" class="align-text-top">'+(item.status_sni_lama == 0 ? 'Pencabutan' : 'Transisi')+'</td>\
                                                <td style="width:10%" class="align-text-top">'+(item.batas_transisi == null ? '-' : item.batas_transisi)+'</td>\
                                                <td class="align-text-top">'+(item.catatan == null ? '-' : item.catatan)+'</td>\
                                            </tr>'
                                        );
                                    })
                                }
                            });
                        });

                        $('body').on('click','#tombol-unduh-excel', function() {
                            $id = $('#id_rapat').val();

                            $(location).prop('href', '/rapat-pembahasan/konten-super-admin/export-rapat-pembahasan/'+$id);

                            $('#modal-lihat-detail-jadwal-rapat').modal('hide');
                            $('#tabel-sni-lama-detail tr').html('');
                            $('.reset-value').html('');
                        });

                        $('.tutup-modal-lihat-detail-rapat-pembahasan').click(function() {
                            $('#tabel-pembahasan tr').html('');
                            $('.reset-value').html('');
                        });
                    }
                });
            }
            else {
                var id_admin = $('#id_admin').val();

                $.ajax({
                    type: "GET",
                    url: "/rapat-pembahasan/konten-admin",
                    dataType: "JSON",
                    success: function (response) {
                        $('#konten').append(
                            '<div class="card">\
                                <div class="card-header">\
                                    <h3 class="card-title">Pembahasan Rapat Masa Transisi SNI</h3>\
                                </div>\
                                <div class="card-body">\
                                    <table class="table table-bordered table-hover" id="aksi-pembahasan-dt">\
                                        <thead class="bg-dark text-white">\
                                            <tr>\
                                                <th>Tanggal Rapat</th>\
                                                <th>PIC Rapat</th>\
                                                <th>Jumlah SNI</th>\
                                                <th>Status Pembahasan</th>\
                                                <th>Aksi</th>\
                                            </tr>\
                                        </thead>\
                                    </table>\
                                </div>\
                                <!-- /.card-body -->\
                            </div>\
                            \
                            <div class="card">\
                                <div class="card-header">\
                                    <h3 class="card-title">Papan Pembahasan Masa Transisi SNI</h3>\
                                </div>\
                                <div class="card-body" id="papan-pembahasan">\
                                </div>\
                                <!-- /.card-body -->\
                            </div>'
                        );

                        aksi_rapat_pembahasan_dt();

                        function aksi_rapat_pembahasan_dt() {
                            $('#aksi-pembahasan-dt').DataTable({
                                language: {
                                    url: "/json/id.json"
                                },
                                serverside: true,
                                ajax: {
                                    url: "/rapat-pembahasan/konten-admin/pembahasan-dt/"+id_admin,
                                    type: "GET",
                                },
                                columns: [
                                    {
                                        data : 'tanggal_rapat',
                                        name : 'tanggal_rapat',
                                    },
                                    {
                                        data : 'pic_rapat',
                                        name : 'pic_rapat',
                                    },
                                    {
                                        data : 'jumlah_sni',
                                        name : 'jumlah_sni',
                                    },
                                    {
                                        data : 'status_pembahasan',
                                        name : 'status_pembahasan',
                                        orderable : false,
                                        searchable : false,
                                        render :
                                            function(data, type, row) {
                                                if(row.status_pembahasan == 0) {
                                                    return row.status_pembahasan = '<span class="badge badge-warning">Belum dibahas</span>';
                                                }
                                                else {
                                                    return row.status_pembahasan = '<span class="badge badge-success">Sudah dibahas</span>';
                                                }
                                            }
                                    },
                                    {
                                        data : 'aksi',
                                        name : 'aksi',
                                        orderable : false,
                                        searchable : false,
                                    },
                                ],
                                order : [[0, 'desc']],
                            });
                        }
                    }
                });

                $('body').on('click','.bahas',function() {
                    if($(this).hasClass('disabled')) {
                        Toast.fire({
                            icon : "warning",
                            title: "Pembahasan telah dilakukan.",
                        });
                    }
                    else {
                        var id_bahas = $(this).attr('id');

                        $('.bahas').html('<i class="spinner-border spinner-border-sm text-light" role="status"></i>');
                        $('.bahas').attr('disabled', true);

                        $('#papan-pembahasan').append(
                            '<form id="form-bahas-masa-transisi" enctype="multipart/form-data">\
                                <table class="table table-sm table-bordered">\
                                    <thead>\
                                        <th class="text-center">No</th>\
                                        <th class="text-center">SNI Baru</th>\
                                        <th class="text-center">SNI Lama</th>\
                                        <th class="text-center">Komtek</th>\
                                        <th class="text-center">Status Pembahasan</th>\
                                        <th class="text-center">Catatan</th>\
                                    </thead>\
                                    <tbody id="data-pembahasan">\
                                    </tbody>\
                                </table>\
                                <div class="form-group">\
                                    <button id="tombol-simpan-pembahasan" type="submit" class="btn btn-primary col-sm-2">Simpan</button>\
                                </div>\
                            </form>'
                        );

                        $.ajax({
                            type: "GET",
                            url: "/rapat-pembahasan/data-pembahasan/"+id_bahas,
                            dataType: "JSON",
                            success: function (response) {
                                $('#data-pembahasan').append(
                                    '<input type="hidden" name="id_rapat" value="'+response.id_rapat.id+'">'
                                );

                                $.each(response.data_pembahasan, function (key, item) { 
                                    $('#data-pembahasan').append(
                                        '<tr class="record">\
                                            <input type="hidden" name="id_sni_lama['+item.id+']" value="'+item.id+'">\
                                            <td class="text-center">\
                                                <p>'+(key+1)+'</p>\
                                                <button type="button" id="'+item.id+'" class="hapus btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>\
                                            </td>\
                                            <td style="width:20%">\
                                                <p>'+item.nmr_sni_baru+'</p>\
                                                <p>'+item.jdl_sni_baru+'</p>\
                                            </td>\
                                            <td style="width:20%">\
                                                <p>'+item.nmr_sni_lama+'</p>\
                                                <p>'+item.jdl_sni_lama+'</p>\
                                            </td>\
                                            <td style="width:15%">\
                                                <p>'+item.komtek+'</p>\
                                                <p class="inline">Jumlah penerap : <a href="javascript:void(0)" class="lihat-penerap" id="'+item.id+'">'+item.jumlah_penerap+'<a/></p>\
                                            </td>\
                                            <td>\
                                                <div class="form-group">\
                                                    <select id="'+item.id+'" class="status form-control mb-3" name="status_sni_lama['+item.id+']">\
                                                        <option value="" selected>--Status--</option>\
                                                        <option value="0">Pencabutan</option>\
                                                        <option value="1">Transisi</option>\
                                                    </select>\
                                                </div>\
                                                <div class="form-group">\
                                                    <input type="text" class="form-control hidden-transisi" name="batas_transisi['+item.id+']" placeholder="pilih batas waktu..." hidden>\
                                                </div>\
                                            </td>\
                                            <td>\
                                                <textarea rows="5" id="'+item.id+'" name="catatan['+item.id+']" class="form-control reset-value" placeholder="Masukkan catatan bila diperlukan..."></textarea>\
                                            </td>\
                                        </tr>'
                                    );
                                });

                                $('.status').on('change',function() {
                                    var input_transisi = $(this).parent().siblings().children('.hidden-transisi');
                                    if($(this).val() == 1) {
                                        input_transisi.prop('hidden', false);
                                        input_transisi.prop('readonly', true);
                                        input_transisi.addClass('batas_transisi');

                                        $(".batas_transisi").datepicker({
                                            todayBtn   :'linked',
                                            changeYear : true,
                                            yearRange  : '+0:+5',
                                            dateFormat : 'yy-mm-dd',
                                            orientation: 'top auto',
                                            autoclose  : true,
                                            minDate: '0',
                                        });
                                    }
                                    else {
                                        input_transisi.prop('hidden', true);
                                        input_transisi.prop('readonly', false);
                                        input_transisi.removeClass('batas_transisi');
                                        input_transisi.html('');
                                        // counter -= 1;
                                    }
                                });

                                $('.bahas').html('<i class="fas fa-arrow-down"></i>');

                                /**********************************************/
                                /*************** Lihat Penerap ****************/
                                /**********************************************/
                                $('body').on('click','.lihat-penerap',function() {
                                    $('#modal-lihat-penerap').modal('show');

                                    var id = $(this).attr('id');

                                    $.ajax({
                                        type: "GET",
                                        url: "/rapat-pembahasan/data-penerap/"+id,
                                        dataType: "JSON",
                                        success: function (response) {
                                            $.each(response.data_penerap, function (key, item) {
                                                $('#body-lihat-penerap').append('<p>'+item.penerap+'</p>');
                                            });
                                        }
                                    })
                                });

                                $('#tutup-modal-lihat-penerap').click(function() {
                                    $('#body-lihat-penerap').html('');
                                });

                                /**********************************************/
                                /***************** Hapus SNI ******************/
                                /**********************************************/
                                $('body').on('click','.hapus',function() {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    var id_konfirmasi_hapus_sni = $(this).attr('id');

                                    $.ajax({
                                        type: "GET",
                                        url: "/rapat-pembahasan/konfirmasi-hapus-sni/"+id_konfirmasi_hapus_sni,
                                        success: function(response) {
                                            $('#body-konfirmasi-hapus-sni').append(
                                            '<input type="hidden" id="id_hapus_sni">\
                                            <h6>Apakah anda yakin menghapus data : <strong>'+ response.data.nmr_sni_lama +'</strong> ?</h6>\
                                            <p>Apabila data SNI dihapus, maka tidak masuk dalam data rapat pembahasan.</p>'
                                            );

                                            $('#id_hapus_sni').val(response.data.id);
                                        }
                                    });

                                    $('#modal-konfirmasi-hapus-sni').modal('show');

                                    $('#tombol-hapus-sni').off('click').on('click', function(e) {

                                        e.preventDefault();
                                    
                                        var id_hapus_sni = $('#id_hapus_sni').val();

                                        $(this).html('<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menghapus...');
                                        $(this).attr('disabled', true);

                                        $.ajax({
                                            type: "DELETE",
                                            url: "/rapat-pembahasan/hapus-sni/"+id_hapus_sni,
                                            success: function(response) {
                                                Toast.fire({
                                                    icon : "success",
                                                    title: "Berhasil hapus data SNI Lama.",
                                                });
                                                $('#modal-konfirmasi-hapus-sni').modal('hide');
                                                $('#tombol-hapus-sni').html('Hapus');
                                                $('#tombol-hapus-sni').attr('disabled', false);
                                                $('#body-konfirmasi-hapus-sni').html('');
                                                $('#aksi-pembahasan-dt').DataTable().ajax.reload(function() {
                                                    $('.bahas').attr('disabled',true);
                                                });
                                                $('#data-pembahasan').html('');
                                                $.ajax({
                                                    type: "GET",
                                                    url: "/rapat-pembahasan/data-pembahasan/"+id_bahas,
                                                    dataType: "JSON",
                                                    success: function (response) {
                                                        $('#data-pembahasan').append(
                                                            '<input type="hidden" name="id_rapat" value="'+response.id_rapat.id+'">'
                                                        );

                                                        $.each(response.data_pembahasan, function (key, item) { 
                                                            $('#data-pembahasan').append(
                                                                '<tr class="record">\
                                                                    <input type="hidden" name="id_sni_lama['+item.id+']" value="'+item.id+'">\
                                                                    <td class="text-center">\
                                                                        <p>'+(key+1)+'</p>\
                                                                        <button type="button" id="'+item.id+'" class="hapus btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>\
                                                                    </td>\
                                                                    <td style="width:20%">\
                                                                        <p>'+item.nmr_sni_baru+'</p>\
                                                                        <p>'+item.jdl_sni_baru+'</p>\
                                                                    </td>\
                                                                    <td style="width:20%">\
                                                                        <p>'+item.nmr_sni_lama+'</p>\
                                                                        <p>'+item.jdl_sni_lama+'</p>\
                                                                    </td>\
                                                                    <td style="width:15%">\
                                                                        <p>'+item.komtek+'</p>\
                                                                        <p class="inline">Jumlah penerap : <a href="javascript:void(0)" class="lihat-penerap" id="'+item.id+'">'+item.jumlah_penerap+'<a/></p>\
                                                                    </td>\
                                                                    <td>\
                                                                        <div class="form-group">\
                                                                            <select id="'+item.id+'" class="status form-control mb-3" name="status_sni_lama['+item.id+']">\
                                                                                <option value="" selected>--Status--</option>\
                                                                                <option value="0">Pencabutan</option>\
                                                                                <option value="1">Transisi</option>\
                                                                            </select>\
                                                                        </div>\
                                                                        <div class="form-group">\
                                                                            <input type="text" class="form-control hidden-transisi" name="batas_transisi['+item.id+']" placeholder="pilih batas waktu..." hidden>\
                                                                        </div>\
                                                                    </td>\
                                                                    <td>\
                                                                        <textarea rows="5" id="'+item.id+'" name="catatan['+item.id+']" class="form-control reset-value" placeholder="Masukkan catatan bila diperlukan..."></textarea>\
                                                                    </td>\
                                                                </tr>'
                                                            );
                                                        });

                                                        $('.status').on('change',function() {
                                                            var input_transisi = $(this).parent().siblings().children('.hidden-transisi');
                                                            if($(this).val() == 1) {
                                                                input_transisi.prop('hidden', false);
                                                                input_transisi.prop('readonly', true);
                                                                input_transisi.addClass('batas_transisi');

                                                                $(".batas_transisi").datepicker({
                                                                    todayBtn   :'linked',
                                                                    changeYear : true,
                                                                    yearRange  : '+0:+5',
                                                                    dateFormat : 'yy-mm-dd',
                                                                    orientation: 'top auto',
                                                                    autoclose  : true,
                                                                    minDate: '0',
                                                                });
                                                            }
                                                            else {
                                                                input_transisi.prop('hidden', true);
                                                                input_transisi.prop('readonly', false);
                                                                input_transisi.removeClass('batas_transisi');
                                                                input_transisi.html('');
                                                                // counter -= 1;
                                                            }
                                                        });

                                                        $('.bahas').html('<i class="fas fa-arrow-down"></i>');
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });

                                $('.tutup-modal-konfirmasi-hapus-sni').on('click', function() {
                                    $('#body-konfirmasi-hapus-sni').html('');
                                });

                                /**********************************************/
                                /************* Simpan Pembahasan **************/
                                /**********************************************/
                                $('#form-bahas-masa-transisi').on('click','#tombol-simpan-pembahasan', function(e) {
                                            
                                    if($('.batas_transisi').length > 0) {
                                        $('.batas_transisi').each(function() {
                                            if($(this).val() == 0) {
                                                e.preventDefault();
                                                Toast.fire({
                                                    icon : "warning",
                                                    title: "Tanggal batas masa transisi tidak boleh kosong.",
                                                });
                                            }
                                        });
                                    }

                                    $('.status').each(function() {
                                        $(this).rules('add',
                                            {
                                                required: true,
                                                messages: {
                                                    required: "Pilih status SNI lama.",
                                                }
                                            }
                                        );
                                    });
                                }).validate({
                                    errorElement: 'span',
                                    errorPlacement: function (error, element) {
                                        error.addClass('invalid-feedback');
                                        element.closest('.form-group').append(error);
                                    },
                                    highlight: function (element, errorClass, validClass) {
                                        $(element).addClass('is-invalid');
                                    },
                                    unhighlight: function (element, errorClass, validClass) {
                                        $(element).removeClass('is-invalid');
                                    },
                                    submitHandler: function(form) {
                                        Swal.fire({
                                            title: 'Anda yakin untuk simpan data rapat pembahasan?',
                                            showDenyButton: false,
                                            showCancelButton: true,
                                            confirmButtonText: 'Simpan',
                                            cancelButtonText: 'Batal',
                                            customClass: {
                                                actions: 'my-actions',
                                                cancelButton: 'order-1 right-gap',
                                                confirmButton: 'order-2',
                                                denyButton: 'order-3',
                                            }
                                        }).then((result) => {
                                            if(result.isConfirmed) {
                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });

                                                $('#tombol-simpan-pembahasan').html('<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menyimpan...');
                                                $('#tombol-simpan-pembahasan').attr('disabled', true);

                                                $.ajax({
                                                    type        : "POST",
                                                    dataType    : "JSON",
                                                    url         : "/rapat-pembahasan/simpan-data-pembahasan",
                                                    contentType : false,
                                                    processData : false,
                                                    cache       : false,
                                                    data        : new FormData($(form)[0]),
                                                    success: function(response) {
                                                        Toast.fire({
                                                            icon : "success",
                                                            title: "Masa Transisi SNI telah ditetapkan.",
                                                        });                     
                                                    },
                                                    error: function(response) {
                                                        Toast.fire({
                                                            icon : "error",
                                                            title: "Gagal menyimpan data pembahasan.",
                                                        });
                                                    },
                                                    complete: function(response) {
                                                        $('#papan-pembahasan').html('');
                                                        $('#counter').val(0);
                                                        $('#tombol-simpan-pembahasan').text('Simpan');
                                                        $('#tombol-simpan-pembahasan').attr('disabled', false);
                                                        $('#aksi-pembahasan-dt').DataTable().ajax.reload();
                                                    }
                                                });
                                            }
                                        })
                                    }
                                });
                            }
                        });
                    }
                });

                /**********************************************/
                /*********** Modal Edit Pembahasan ************/
                /**********************************************/
                $('body').on('click','.edit', function() {
                    if($(this).hasClass('disabled')) {
                        Toast.fire({
                            icon : "warning",
                            title: "Belum bisa mengubah, pembahasan belum dilakukan.",
                        });
                    }
                    else {
                        $('#modal-edit-rapat-pembahasan').modal('show');
                        var id_edit_pembahasan = $(this).attr('id');
                        $.ajax({
                            type: "GET",
                            url: "/rapat-pembahasan/modal-edit/"+id_edit_pembahasan,
                            dataType: "JSON",
                            success: function(response) {
                                $('#data-edit-rapat-pembahasan').append(
                                    '<input type="hidden" name="id_edit_rapat_pembahasan" value="'+response.id_rapat.id+'">'
                                );

                                $.each(response.data, function(key, item) {
                                    $('#data-edit-rapat-pembahasan').append(
                                        '<tr class="record">\
                                            <input type="hidden" name="id_sni_lama['+item.id+']" value="'+item.id+'">\
                                            <td class="text-center">\
                                                <p>'+(key+1)+'</p>\
                                                <button type="button" id="'+item.id+'" class="hapus-sni-edit-pembahasan btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>\
                                            </td>\
                                            <td style="width:20%">\
                                                <p>'+item.nmr_sni_baru+'</p>\
                                                <p>'+item.jdl_sni_baru+'</p>\
                                            </td>\
                                            <td style="width:20%">\
                                                <p>'+item.nmr_sni_lama+'</p>\
                                                <p>'+item.jdl_sni_lama+'</p>\
                                            </td>\
                                            <td style="width:15%">\
                                                <p>'+item.komtek+'</p>\
                                            </td>\
                                            <td>\
                                                <div class="form-group">\
                                                    <select class="status form-control mb-3" name="status_sni_lama['+item.id+']">\
                                                        <option value="" selected>--Status--</option>\
                                                        <option value="0">Pencabutan</option>\
                                                        <option value="1">Transisi</option>\
                                                    </select>\
                                                </div>\
                                                <div class="transisi form-group">\
                                                    <input type="hidden" name="id_batas_transisi['+item.id+']" value="'+item.id_batas_transisi+'">\
                                                    <input type="text" class="form-control hidden-transisi" name="batas_transisi['+item.id+']" placeholder="pilih batas waktu..." hidden>\
                                                </div>\
                                            </td>\
                                            <td>\
                                                <textarea rows="5" name="catatan['+item.id+']" class="catatan form-control" placeholder="Masukkan catatan bila diperlukan...">'+item.catatan+'</textarea>\
                                            </td>\
                                        </tr>'
                                    );
                                    $('select[name="status_sni_lama['+item.id+']"] option[value='+item.status_sni_lama+']').attr('selected','selected');
                                    if(item.status_sni_lama == 1) {
                                        $('input[name="batas_transisi['+item.id+']"]').prop('hidden',false);
                                        $('input[name="batas_transisi['+item.id+']"]').prop('readonly',true);
                                        $('input[name="batas_transisi['+item.id+']"]').val(item.batas_transisi);
                                        $(".hidden-transisi").datepicker({
                                            todayBtn   :'linked',
                                            changeYear : true,
                                            yearRange  : '+0:+5',
                                            dateFormat : 'yy-mm-dd',
                                            orientation: 'top auto',
                                            autoclose  : true,
                                            minDate: '0',
                                        });
                                    }
                                    // $('.catatan').val(item.catatan);
                                    var str = $('textarea[name="catatan['+item.id+']"]').val();
                                    var regex = /<br\s*[\/]?>/gi;
                                    $('textarea[name="catatan['+item.id+']"]').val(str.replace(regex, ""));
                                });
                            }
                        });
                    }
                });

                $('#tutup-modal-edit-rapat-pembahasan').click(function() {
                    $('#data-edit-rapat-pembahasan').html('');
                });

                /**********************************************/
                /********* Hapus SNI pada modal edit **********/
                /**********************************************/
                $('body').on('click','.hapus-sni-edit-pembahasan',function() {

                    alert('test woy!');

                    // e.preventDefault();
                    
                    // var id_hapus_sni = $('#id_hapus_sni').val();

                    // $(this).html('<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menghapus...');
                    // $(this).attr('disabled', true);

                    // $.ajax({
                    //     type: "DELETE",
                    //     url: "/rapat-pembahasan/hapus-sni/"+id_hapus_sni,
                    //     success: function(response) {
                    //         Toast.fire({
                    //             icon : "success",
                    //             title: "Berhasil hapus data SNI Lama.",
                    //         });
                    //         $('#modal-konfirmasi-hapus-sni').modal('hide');
                    //         $('#tombol-hapus-sni').html('Hapus');
                    //         $('#tombol-hapus-sni').attr('disabled', false);
                    //         $('#body-konfirmasi-hapus-sni').html('');
                    //         $('#aksi-pembahasan-dt').DataTable().ajax.reload(function() {
                    //             $('.bahas').attr('disabled',true);
                    //         });
                    //         $('#data-pembahasan').html('');
                    //         $.ajax({
                    //             type: "GET",
                    //             url: "/rapat-pembahasan/data-pembahasan/"+id_bahas,
                    //             dataType: "JSON",
                    //             success: function (response) {
                    //                 $('#data-pembahasan').append(
                    //                     '<input type="hidden" name="id_rapat" value="'+response.id_rapat.id+'">'
                    //                 );

                    //                 $.each(response.data_pembahasan, function (key, item) { 
                    //                     $('#data-pembahasan').append(
                    //                         '<tr class="record">\
                    //                             <input type="hidden" name="id_sni_lama['+item.id+']" value="'+item.id+'">\
                    //                             <td class="text-center">\
                    //                                 <p>'+(key+1)+'</p>\
                    //                                 <button type="button" id="'+item.id+'" class="hapus btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>\
                    //                             </td>\
                    //                             <td style="width:20%">\
                    //                                 <p>'+item.nmr_sni_baru+'</p>\
                    //                                 <p>'+item.jdl_sni_baru+'</p>\
                    //                             </td>\
                    //                             <td style="width:20%">\
                    //                                 <p>'+item.nmr_sni_lama+'</p>\
                    //                                 <p>'+item.jdl_sni_lama+'</p>\
                    //                             </td>\
                    //                             <td style="width:15%">\
                    //                                 <p>'+item.komtek+'</p>\
                    //                                 <p class="inline">Jumlah penerap : <a href="javascript:void(0)" class="lihat-penerap" id="'+item.id+'">'+item.jumlah_penerap+'<a/></p>\
                    //                             </td>\
                    //                             <td>\
                    //                                 <div class="form-group">\
                    //                                     <select id="'+item.id+'" class="status form-control mb-3" name="status_sni_lama['+item.id+']">\
                    //                                         <option value="" selected>--Status--</option>\
                    //                                         <option value="0">Pencabutan</option>\
                    //                                         <option value="1">Transisi</option>\
                    //                                     </select>\
                    //                                 </div>\
                    //                                 <div class="form-group">\
                    //                                     <input type="text" class="form-control hidden-transisi" name="batas_transisi['+item.id+']" placeholder="pilih batas waktu..." hidden>\
                    //                                 </div>\
                    //                             </td>\
                    //                             <td>\
                    //                                 <textarea rows="5" id="'+item.id+'" name="catatan['+item.id+']" class="form-control reset-value" placeholder="Masukkan catatan bila diperlukan..."></textarea>\
                    //                             </td>\
                    //                         </tr>'
                    //                     );
                    //                 });

                    //                 $('.status').on('change',function() {
                    //                     var input_transisi = $(this).parent().siblings().children('.hidden-transisi');
                    //                     if($(this).val() == 1) {
                    //                         input_transisi.prop('hidden', false);
                    //                         input_transisi.prop('readonly', true);
                    //                         input_transisi.addClass('batas_transisi');

                    //                         $(".batas_transisi").datepicker({
                    //                             todayBtn   :'linked',
                    //                             changeYear : true,
                    //                             yearRange  : '+0:+5',
                    //                             dateFormat : 'yy-mm-dd',
                    //                             orientation: 'top auto',
                    //                             autoclose  : true,
                    //                             minDate: '0',
                    //                         });
                    //                     }
                    //                     else {
                    //                         input_transisi.prop('hidden', true);
                    //                         input_transisi.prop('readonly', false);
                    //                         input_transisi.removeClass('batas_transisi');
                    //                         input_transisi.html('');
                    //                         // counter -= 1;
                    //                     }
                    //                 });

                    //                 $('.bahas').html('<i class="fas fa-arrow-down"></i>');
                    //             }
                    //         });
                    //     }
                    // });
                });

                /**********************************************/
                /*********** Edit Rapat Pembahasan ************/
                /**********************************************/
                $('#form-edit-rapat-pembahasan').on('click','#tombol-edit-rapat-pembahasan', function(e) {
                            
                    if($('.hidden-transisi').length > 0) {
                        $('.hidden-transisi').each(function() {
                            if($(this).val() == 0) {
                                e.preventDefault();
                                Toast.fire({
                                    icon : "warning",
                                    title: "Tanggal batas masa transisi tidak boleh kosong.",
                                });
                            }
                        });
                    }

                    $('.status').each(function() {
                        $(this).rules('add',
                            {
                                required: true,
                                messages: {
                                    required: "Pilih status SNI lama.",
                                }
                            }
                        );
                    });
                }).validate({
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $('#tombol-edit-rapat-pembahasan').html('<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menyimpan...');
                        $('#tombol-edit-rapat-pembahasan').attr('disabled', true);

                        $.ajax({
                            type        : "POST",
                            dataType    : "JSON",
                            url         : "/rapat-pembahasan/edit",
                            contentType : false,
                            processData : false,
                            cache       : false,
                            data        : new FormData($(form)[0]),
                            success: function(response) {
                                Toast.fire({
                                    icon : "success",
                                    title: "Data rapat pembahasan berhasil diubah.",
                                });                     
                            },
                            error: function(response) {
                                Toast.fire({
                                    icon : "error",
                                    title: "Gagal menyimpan perubahan data.",
                                });
                            },
                            complete: function(response) {
                                $('#modal-edit-rapat-pembahasan').modal('hide');
                                $('#data-edit-rapat-pembahasan').html('');
                                $('#tombol-edit-rapat-pembahasan').text('Simpan');
                                $('#tombol-edit-rapat-pembahasan').attr('disabled', false);
                                $('#aksi-pembahasan-dt').DataTable().ajax.reload();
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush