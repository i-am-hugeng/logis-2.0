<!-- {{-- Modal Tambah SK Penetapan --}} -->
<div class="modal fade" id="modal-tambah-sk">
    <form id="form-tambah-sk" enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data SK Penetapan</h4>
                    <button type="button" class="close tutup-modal-tambah" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- {{-- Start : id counter untuk menambah field SNI Lama --}} -->
                    <input type="hidden" id="counter-sni-lama" value="0">
                    <!-- {{-- End : id counter --}} -->

                    <div class="form-group">
                        <label class="form-label">PIC Identifikasi SNI</label>
                        <select id="pic" class="form-control" name="pic_identifikasi">
                            @foreach ($data_pic as $pic)
                                <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_terima_sk">Tanggal Terima SK</label>
                        <input type="text" class="form-control tanggal" id="tgl_terima_sk" name="tgl_terima_sk"
                            placeholder="Masukkan tanggal terima SK..." readonly>
                    </div>
                    <div class="form-group">
                        <label for="nmr_sk">Nomor SK</label>
                        <input type="text" class="form-control" id="nmr_sk" name="nmr_sk"
                            placeholder="Masukkan nomor SK...">
                    </div>
                    <div class="form-group">
                        <label for="tgl_terbit_sk">Tanggal SK</label>
                        <input type="text" class="form-control tanggal" id="tgl_terbit_sk" name="tgl_terbit_sk"
                            placeholder="Masukkan tanggal SK..." readonly>
                    </div>
                    <div class="form-group">
                        <label for="uraian_sk">Uraian SK</label>
                        <textarea rows="5" id="uraian_sk" name="uraian_sk" class="form-control" placeholder="Masukkan Uraian SK..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nmr_sni_baru">Nomor SNI Baru</label>
                        <input type="text" class="form-control" id="nmr_std_baru" name="nmr_std_baru"
                            placeholder="Masukkan nomor SNI Baru...">
                    </div>
                    <div class="form-group">
                        <label for="jdl_std_baru">Judul SNI Baru</label>
                        <textarea rows="5" id="jdl_std_baru" name="jdl_std_baru" class="form-control"
                            placeholder="Masukkan judul SNI Baru..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tahun_std">Tahun SNI Baru</label>
                        <input type="text" class="form-control" id="tahun_std" name="tahun_std"
                            placeholder="Masukkan tahun SNI Baru...">
                    </div>
                    <div class="form-group">
                        <select id="status_identifikasi" class="form-select" name="status_identifikasi" hidden>
                            <option value="0" selected></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="status_bahan_rapat" class="form-select" name="status_bahan_rapat" hidden>
                            <option value="0" selected></option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="button" id="tombol-tambah-sni-lama"
                                class="form-control btn btn-secondary">Tambah Data SNI Lama</button>
                        </div>
                    </div>
                    <div id="div_tambah_sni_lama">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger tutup-modal-tambah" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tambah-data-sk">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- {{-- End of - Modal Tambah SK --}} -->


<!-- {{-- Modal Edit SK Penetapan --}} -->
<div class="modal fade" id="modal-edit-sk">
    <form id="form-edit-sk" enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data SK Penetapan</h4>
                    <button type="button" class="close tutup-modal-edit" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id_sk_edit" id="id_sk_edit">

                    <!-- {{-- Start : id counter untuk menambah field SNI Lama --}} -->
                    <input type="hidden" id="counter-sni-lama-edit" value="0">
                    <!-- {{-- End : id counter SNI lama --}} -->

                    <div class="form-group">
                        <label class="form-label">PIC Identifikasi SNI</label>
                        <select id="pic_edit" class="form-control" name="pic_edit">
                            @foreach ($data_pic as $pic)
                                <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_terima_edit">Tanggal Terima SK</label>
                        <input type="text" class="form-control tanggal" id="tanggal_terima_edit"
                            name="tanggal_terima_edit" placeholder="Masukkan tanggal terima SK..." readonly>
                    </div>
                    <div class="form-group">
                        <label for="nmr_sk_sni_edit">Nomor SK</label>
                        <input type="text" class="form-control" id="nmr_sk_sni_edit" name="nmr_sk_sni_edit"
                            placeholder="Masukkan nomor SK...">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sk_edit">Tanggal SK</label>
                        <input type="text" class="form-control tanggal" id="tanggal_sk_edit"
                            name="tanggal_sk_edit" placeholder="Masukkan tanggal SK..." readonly>
                    </div>
                    <div class="form-group">
                        <label for="uraian_sk_edit">Uraian SK</label>
                        <textarea rows="5" id="uraian_sk_edit" name="uraian_sk_edit" class="form-control"
                            placeholder="Masukkan Uraian SK..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nmr_sni_baru_edit">Nomor SNI Baru</label>
                        <input type="text" class="form-control" id="nmr_sni_baru_edit" name="nmr_sni_baru_edit"
                            placeholder="Masukkan nomor SNI Baru...">
                    </div>
                    <div class="form-group">
                        <label for="jdl_sni_baru_edit">Judul SNI Baru</label>
                        <textarea rows="5" id="jdl_sni_baru_edit" name="jdl_sni_baru_edit" class="form-control"
                            placeholder="Masukkan judul SNI Baru..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tahun_sni_baru_edit">Tahun SNI Baru</label>
                        <input type="text" class="form-control" id="tahun_sni_baru_edit"
                            name="tahun_sni_baru_edit" placeholder="Masukkan tahun SNI Baru...">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="button" id="tombol-tambah-sni-lama-edit"
                                class="form-control btn btn-secondary">Tambah Data SNI Lama</button>
                        </div>
                    </div>
                    <div id="div_tambah_sni_lama_edit">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger tutup-modal-edit"
                        data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="edit-data-sk">Ubah</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- {{-- End of - Modal Edit SK --}} -->


{{-- Modal Konfirmasi Hapus SK --}}
<div class="modal fade" id="modal-konfirmasi-hapus-sk">
    <form id="form-konfirmasi-hapus-sk">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data SK Penetapan SNI</h4>
                    <button type="button" class="close tutup-modal-konfirmasi-hapus-sk" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body-konfirmasi-hapus-sk">


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default tutup-modal-konfirmasi-hapus-sk"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger tombol-hapus-sk">Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
{{-- End of - Modal Konfirmasi Hapus SK --}}


<!-- {{-- Modal Lihat Detail SK SNI --}} -->
<div class="modal fade" id="modal-lihat-detail-sk">
    <form id="form-lihat-detail-sk" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Detail SK SNI Revisi</h4>
                    <button type="button" class="close tutup-modal-lihat-detail-sk" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" id="id_detail">
                    </div>

                    <table class="mb-3">
                        <tr class="form-group">
                            <th class="col-sm-3">PIC</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="pic_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Tanggal Terima SK</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="tanggal_terima_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Nomor SK</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="nmr_sk_sni_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Tanggal SK</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="tanggal_sk_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3 align-text-top">Uraian SK</th>
                            <td class="align-text-top">:</td>
                            <td class="col-sm-9 reset-value" id="uraian_sk_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Nomor SNI Baru</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="nmr_sni_baru_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3 align-text-top">Judul SNI Baru</th>
                            <td class="align-text-top">:</td>
                            <td class="col-sm-9 reset-value" id="jdl_sni_baru_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Tahun SNI Baru</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="tahun_sni_baru_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Sifat SNI</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="sifat_sni"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3">Komite Teknis</th>
                            <td>:</td>
                            <td class="col-sm-9 reset-value" id="komtek_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3 align-text-top">Sekretariat Komtek</th>
                            <td class="align-text-top">:</td>
                            <td class="col-sm-9 reset-value" id="sekretariat_komtek_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3 align-text-top">Tanggal Rapat</th>
                            <td class="align-text-top">:</td>
                            <td class="col-sm-9 reset-value" id="tanggal_rapat_detail"></td>
                        </tr>
                        <tr class="form-group">
                            <th class="col-sm-3 align-text-top">Catatan Rapat</th>
                            <td class="align-text-top">:</td>
                            <td class="col-sm-9 reset-value" id="catatan_detail"></td>
                        </tr>
                    </table>
                    <table class="mb-3 table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor SNI Lama</th>
                                <th class="text-center">Judul SNI Lama</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-sni-lama">

                        </tbody>
                    </table>
                    <table class="mb-3 table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Penerap</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-penerap-sni">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger tutup-modal-identifikasi"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- {{-- End of - Modal LihatDetail SK SNI --}} -->
