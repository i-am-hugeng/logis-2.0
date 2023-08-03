const Toast = Swal.mixin({
    toast: true,
    position: "top-right",
    iconColor: "white",
    customClass: {
        popup: "colored-toast",
    },
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

$(".tanggal").datepicker({
    todayBtn: "linked",
    changeYear: true,
    yearRange: "-2:+0",
    dateFormat: "yy-mm-dd",
    orientation: "top auto",
    autoclose: true,
    maxDate: "0",
});

rekap_petugas_dt();

function rekap_petugas_dt() {
    $("#rekap-identifikasi-dt").DataTable({
        searching: false,
        paging: false,
        info: false,
        language: {
            url: "/json/id.json",
        },
        serverside: true,
        ajax: {
            url: "/sk-penetapan/rekap-petugas",
            type: "GET",
        },
        columns: [
            {
                data: "pic_identifikasi",
                name: "pic_identifikasi",
            },
            {
                data: "belum_terproses",
                name: "belum_terproses",
            },
            {
                data: "terproses",
                name: "terproses",
            },
            {
                data: "total",
                name: "total",
            },
        ],
        order: [[3, "desc"]],
    });
}

sk_penetapan_dt();

function sk_penetapan_dt() {
    $("#sk-penetapan-dt").DataTable({
        language: {
            url: "/json/id.json",
        },
        serverside: true,
        ajax: {
            url: "/sk-penetapan",
            type: "GET",
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "nmr_sk",
                name: "nmr_sk",
                render: function (data, type, row, meta) {
                    return (
                        '<a href="javascript:void(0)" id="' +
                        row.id +
                        '" class="lihat-detail-sk">' +
                        row.nmr_sk +
                        "</a>"
                    );
                },
            },
            {
                data: "tgl_terbit_sk",
                name: "tgl_terbit_sk",
            },
            {
                data: "uraian_sk",
                name: "uraian_sk",
                render: function (data, type, row) {
                    return data.substr(0, 50) + "...";
                },
            },
            {
                data: "pic_identifikasi",
                name: "pic_identifikasi",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "aksi",
                name: "aksi",
                orderable: false,
                searchable: false,
            },
        ],
        columnDefs: [
            {
                targets: 3,
                width: "25%",
            },
            {
                targets: 2,
                width: "13%",
            },
            {
                targets: 5,
                width: "13%",
            },
        ],
        order: [[5, "desc"]],
    });
}

//{{-- Tambah baris SNI lama --}}
$("#tombol-tambah-sni-lama")
    .off("click")
    .on("click", function () {
        tambah_sni_lama();
    });

function tambah_sni_lama() {
    var counter_sni_lama = parseInt($("#counter-sni-lama").val());
    var html =
        '<div id="record-sni-lama[' +
        counter_sni_lama +
        ']" class="record-sni-lama row">\
                                                <div class="col-sm-9">\
                                                    <div class="form-group">\
                                                        <input type="text" class="form-control nmr_sni_lama" placeholder="Masukkan nomor SNI Lama..." name="nmr_sni_lama[' +
        counter_sni_lama +
        ']">\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <textarea rows="2" placeholder="Masukkan judul SNI Lama..." name="jdl_sni_lama[' +
        counter_sni_lama +
        ']" class="form-control jdl_sni_lama"></textarea>\
                                                    </div>\
                                                </div>\
                                                <div class="col-md-3">\
                                                    <button type="button" class="btn btn-dark form-control hapus-sni-lama">Hapus</button>\
                                                </div>\
                                            </div>';

    $("#div_tambah_sni_lama").append(html);
    $("#counter-sni-lama").val(counter_sni_lama + 1);
}

$(document).on("click", ".hapus-sni-lama", function () {
    $(this).closest(".record-sni-lama").remove();
});

$(".tutup-modal-tambah").click(function () {
    $("#div_tambah_sni_lama").html("");
    $("#pic").prop("selectedIndex", 0);
});

/**********************************************/
/******** Tambah Data SK Penetapan SNI ********/
/**********************************************/
$("#tombol-tambah-data")
    .off("click")
    .on("click", function () {
        $("#modal-tambah-sk").modal("show");
    });

$("#tambah-data-sk").on("click", function (e) {
    if ($("#tanggal_sk").val() == 0) {
        e.preventDefault();
        Toast.fire({
            icon: "warning",
            title: "Tanggal SK tidak boleh kosong.",
        });
    }
    if ($("#tanggal_terima").val() == 0) {
        e.preventDefault();
        Toast.fire({
            icon: "warning",
            title: "Tanggal terima SK tidak boleh kosong.",
        });
    } else if ($(".record-sni-lama").length == 0) {
        e.preventDefault();
        Toast.fire({
            icon: "warning",
            title: "Tambah minimal satu data SNI lama.",
        });
    } else {
        /******** Validasi penambahan data SNI lama dan penerap SNI *********/
        $("#form-tambah-sk")
            .on("submit", function (e) {
                $(".nmr_sni_lama").each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "Masukkan nomor SNI lama.",
                        },
                    });
                });
                $(".jdl_sni_lama").each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "Masukkan judul SNI lama.",
                        },
                    });
                });
            })
            .validate({
                rules: {
                    nmr_sk_sni: {
                        required: true,
                    },
                    uraian_sk: {
                        required: true,
                    },
                    nmr_sni_baru: {
                        required: true,
                    },
                    jdl_sni_baru: {
                        required: true,
                    },
                    tahun_sni_baru: {
                        required: true,
                        number: true,
                        minlength: 4,
                        maxlength: 4,
                    },
                },
                messages: {
                    nmr_sk_sni: {
                        required: "Masukkan nomor SK Penetapan SNI Revisi.",
                    },
                    uraian_sk: {
                        required: "Masukkan uraian SK Penetapan SNI Revisi.",
                    },
                    nmr_sni_baru: {
                        required: "Masukkan nomor SNI baru.",
                    },
                    jdl_sni_baru: {
                        required: "Masukkan judul SNI baru.",
                    },
                    tahun_sni_baru: {
                        required: "Masukkan tahun SNI baru.",
                        number: "Tahun SNI harus berupa karakter angka.",
                        minlength: "Terdiri dari empat karakter angka.",
                        maxlength: "Terdiri dari empat karakter angka.",
                    },
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-control").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    $("#tambah-data-sk").html(
                        '<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menyimpan...'
                    );
                    $("#tambah-data-sk").attr("disabled", true);

                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: "/sk-penetapan/tambah-data-sk",
                        contentType: false,
                        processData: false,
                        cache: false,
                        data: new FormData($(form)[0]),
                        success: function (response) {
                            if (response.sk_sni) {
                                Toast.fire({
                                    icon: "warning",
                                    title: "Duplikasi data SK SNI Revisi.",
                                });
                            } else {
                                Toast.fire({
                                    icon: "success",
                                    title: "Data SK telah tersimpan.",
                                });
                            }
                        },
                        error: function (response) {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal upload data.",
                            });
                        },
                        complete: function (response) {
                            $("#modal-tambah-sk").modal("hide");
                            $("#form-tambah-sk").find("textarea").val("");
                            $("#form-tambah-sk").find("input").val("");
                            $("#pic").prop("selectedIndex", 0);
                            $(".record-sni-lama").remove();
                            $("#tambah-data-sk").html("");
                            $("#tambah-data-sk").text("Simpan");
                            $("#tambah-data-sk").attr("disabled", false);
                            $("#counter-sni-lama").val(0);
                            $("#sk-penetapan-dt").DataTable().ajax.reload();
                            $("#rekap-identifikasi-dt")
                                .DataTable()
                                .ajax.reload();
                        },
                    });
                },
            });
    }
});

/**********************************************/
/******* Lihat Detail SK Penetapan SNI ********/
/**********************************************/
$("body").on("click", ".lihat-detail-sk", function () {
    var id_sk = $(this).attr("id");

    $("#modal-lihat-detail-sk").modal("show");

    $.ajax({
        type: "GET",
        url: "/sk-penetapan/lihat-detail-sk/" + id_sk,
        success: function (response) {
            $("#id_detail").val(response.detail_sk.id);
            $("#pic_detail").html(response.detail_sk.pic);
            $("#tanggal_terima_detail").html(response.detail_sk.tanggal_terima);
            $("#nmr_sk_sni_detail").html(response.detail_sk.nmr_sk_sni);
            $("#tanggal_sk_detail").html(response.detail_sk.tanggal_sk);
            $("#uraian_sk_detail").html(response.detail_sk.uraian_sk);
            $("#nmr_sni_baru_detail").html(response.detail_sk.nmr_sni_baru);
            $("#jdl_sni_baru_detail").html(response.detail_sk.jdl_sni_baru);
            $("#tahun_sni_baru_detail").html(response.detail_sk.tahun_sni_baru);
            if (response.detail_sk.sifat_sni == 0) {
                $("#sifat_sni").html("Wajib").addClass("text-primary");
                $("#komtek_detail")
                    .html("Tidak dilakukan identifikasi lebih lanjut")
                    .addClass("text-primary");
                $("#sekretariat_komtek_detail")
                    .html("Tidak dilakukan identifikasi lebih lanjut")
                    .addClass("text-primary");
            } else {
                if (response.detail_sk.komtek == undefined) {
                    $("#sifat_sni")
                        .html("Belum diidentifikasi")
                        .addClass(["text-danger", "font-italic"]);
                    $("#komtek_detail")
                        .html("Belum diidentifikasi")
                        .addClass(["text-danger", "font-italic"]);
                    $("#sekretariat_komtek_detail")
                        .html("Belum diidentifikasi")
                        .addClass(["text-danger", "font-italic"]);
                } else {
                    $("#sifat_sni").html("Sukarela");
                    $("#komtek_detail").html(response.detail_sk.komtek);
                    $("#sekretariat_komtek_detail").html(
                        response.detail_sk.sekretariat_komtek
                    );
                }
            }
            $.each(response.detail_sni_lama, function (key, item) {
                $("#tabel-sni-lama").append(
                    '<tr>\
                                                    <td class="text-center align-text-top">' +
                        (key + 1) +
                        '</td>\
                                                    <td style="width:30%" class="align-text-top">' +
                        item.nmr_sni_lama +
                        "</td>\
                                                    <td>" +
                        item.jdl_sni_lama +
                        "</td>\
                                                </tr>"
                );
            });
            $.each(response.detail_penerap, function (key, item) {
                if (item.penerap == null) {
                    if (response.detail_sk.sifat_sni == 0) {
                        $("#tabel-penerap-sni").append(
                            '<tr>\
                                                            <td style="width:10%" class="text-center align-text-top">1</td>\
                                                            <td class="text-primary align-text-top">Tidak dilakukan identifikasi lebih lanjut</td>\
                                                        </tr>'
                        );
                    } else {
                        $("#tabel-penerap-sni").append(
                            '<tr>\
                                                            <td style="width:10%" class="text-center align-text-top">1</td>\
                                                            <td class="text-danger font-italic align-text-top">Belum diidentifikasi</td>\
                                                        </tr>'
                        );
                    }
                } else {
                    $("#tabel-penerap-sni").append(
                        '<tr>\
                                                        <td style="width:10%" class="text-center align-text-top">' +
                            (key + 1) +
                            '</td>\
                                                        <td class="align-text-top">' +
                            item.penerap +
                            "</td>\
                                                    </tr>"
                    );
                }
            });
            if (response.tanggal_rapat == null) {
                $("#tanggal_rapat_detail").html("-");
                $("#catatan_detail").html("-");
            } else {
                $("#tanggal_rapat_detail").html(
                    response.tanggal_rapat.tanggal_rapat
                );
                $("#catatan_detail").html(response.tanggal_rapat.catatan);
            }
        },
    });
});

$(".tutup-modal-lihat-detail-sk").click(function () {
    $("#tabel-sni-lama tr").html("");
    $("#tabel-penerap-sni tr").html("");
    $(".reset-value").html("");
    $(".reset-value").removeClass([
        "text-danger",
        "text-primary",
        "font-italic",
    ]);
});

// /*********************************************/
// /******** Edit Data SK Penetapan SNI *********/
// /*********************************************/
$("body").on("click", ".edit", function (e) {
    if ($(this).hasClass("disabled")) {
        Toast.fire({
            icon: "warning",
            title: "SK yang sudah teridentifikasi tidak dapat diubah.",
        });
    } else {
        var id_sk_edit = $(this).attr("id");
        $("#modal-edit-sk").modal("show");

        //{{-- Tambah baris SNI lama --}}
        $("#tombol-tambah-sni-lama-edit")
            .off("click")
            .on("click", function () {
                tambah_sni_lama_edit();
            });

        function tambah_sni_lama_edit() {
            var counter_sni_lama_edit = parseInt(
                $("#counter-sni-lama-edit").val()
            );
            var html =
                '<div id="record-sni-lama-edit[' +
                counter_sni_lama_edit +
                ']" class="record-sni-lama-edit row">\
                                                        <div class="col-sm-9">\
                                                            <input type="hidden" name="id_sni_lama_edit[' +
                counter_sni_lama_edit +
                ']" class="id_sni_lama_edit" value="">\
                                                            <div class="form-group">\
                                                                <input type="text" class="form-control nmr_sni_lama_edit" placeholder="Masukkan nomor SNI Lama..." name="nmr_sni_lama_edit[' +
                counter_sni_lama_edit +
                ']">\
                                                            </div>\
                                                            <div class="form-group">\
                                                                <textarea rows="2" placeholder="Masukkan judul SNI Lama..." name="jdl_sni_lama_edit[' +
                counter_sni_lama_edit +
                ']" class="form-control jdl_sni_lama_edit"></textarea>\
                                                            </div>\
                                                        </div>\
                                                        <div class="col-md-3">\
                                                            <button type="button" class="btn btn-dark form-control hapus-sni-lama-edit">Hapus</button>\
                                                        </div>\
                                                    </div>';

            $("#div_tambah_sni_lama_edit").append(html);
            $("#counter-sni-lama-edit").val(counter_sni_lama_edit + 1);
        }

        $.ajax({
            type: "GET",
            url: "/sk-penetapan/modal-sk-edit/" + id_sk_edit,
            success: function (response) {
                $("#id_sk_edit").val(response.data_sk.id);
                $(
                    '#pic_edit option[value="' + response.data_sk.pic + '"]'
                ).prop("selected", true);
                $("#tanggal_terima_edit").val(response.data_sk.tanggal_terima);
                $("#nmr_sk_sni_edit").val(response.data_sk.nmr_sk_sni);
                $("#tanggal_sk_edit").val(response.data_sk.tanggal_sk);
                $("#uraian_sk_edit").val(response.data_sk.uraian_sk);
                var str = $("#uraian_sk_edit").val();
                var regex = /<br\s*[\/]?>/gi;
                $("#uraian_sk_edit").val(str.replace(regex, ""));
                $("#nmr_sni_baru_edit").val(response.data_sk.nmr_sni_baru);
                $("#jdl_sni_baru_edit").val(response.data_sk.jdl_sni_baru);
                $("#tahun_sni_baru_edit").val(response.data_sk.tahun_sni_baru);

                $.each(response.data_sni_lama, function (key, item) {
                    $("#div_tambah_sni_lama_edit").append(
                        '<div id="record-sni-lama-edit[' +
                            key +
                            ']" class="record-sni-lama-edit row">\
                                                        <div class="col-sm-9">\
                                                            <input type="hidden" name="id_sni_lama_edit[' +
                            key +
                            ']" class="id_sni_lama_edit" value="' +
                            item.id +
                            '">\
                                                            <div class="form-group">\
                                                                <input type="text" class="form-control nmr_sni_lama_edit" placeholder="Masukkan nomor SNI Lama..." name="nmr_sni_lama_edit[' +
                            key +
                            ']" value="' +
                            item.nmr_sni_lama +
                            '">\
                                                            </div>\
                                                            <div class="form-group">\
                                                                <textarea rows="2" placeholder="Masukkan judul SNI Lama..." name="jdl_sni_lama_edit[' +
                            key +
                            ']" class="form-control jdl_sni_lama_edit">' +
                            item.jdl_sni_lama +
                            '</textarea>\
                                                            </div>\
                                                        </div>\
                                                        <div class="col-md-3">\
                                                            <button type="button" class="btn btn-dark form-control hapus-sni-lama-edit">Hapus</button>\
                                                        </div>\
                                                    </div>'
                    );
                    $("#counter-sni-lama-edit").val(key + 1);
                });
            },
        });
    }
});

$("#edit-data-sk")
    .off("click")
    .on("click", function () {
        /******** Validasi penambahan data SNI lama *********/
        $("#form-edit-sk")
            .on("click", "#edit-data-sk", function () {
                $(".nmr_sni_lama_edit").each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "Masukkan nomor SNI lama.",
                        },
                    });
                });
                $(".jdl_sni_lama_edit").each(function () {
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "Masukkan judul SNI lama.",
                        },
                    });
                });
            })
            .validate({
                rules: {
                    nmr_sk_sni: {
                        required: true,
                    },
                    uraian_sk: {
                        required: true,
                    },
                    nmr_sni_baru: {
                        required: true,
                    },
                    jdl_sni_baru: {
                        required: true,
                    },
                    tahun_sni_baru: {
                        required: true,
                        number: true,
                        minlength: 4,
                        maxlength: 4,
                    },
                },
                messages: {
                    nmr_sk_sni: {
                        required: "Masukkan nomor SK Penetapan SNI Revisi.",
                    },
                    uraian_sk: {
                        required: "Masukkan uraian SK Penetapan SNI Revisi.",
                    },
                    nmr_sni_baru: {
                        required: "Masukkan nomor SNI baru.",
                    },
                    jdl_sni_baru: {
                        required: "Masukkan judul SNI baru.",
                    },
                    tahun_sni_baru: {
                        required: "Masukkan tahun SNI baru.",
                        number: "Tahun SNI harus berupa karakter angka.",
                        minlength: "Terdiri dari empat karakter angka.",
                        maxlength: "Terdiri dari empat karakter angka.",
                    },
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    $("#edit-data-sk").html(
                        '<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menyimpan...'
                    );
                    $("#edit-data-sk").attr("disabled", true);

                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: "/sk-penetapan/edit-data-sk",
                        contentType: false,
                        processData: false,
                        cache: false,
                        data: new FormData($(form)[0]),
                        success: function (response) {
                            Toast.fire({
                                icon: "success",
                                title: "Data SNI lama telah diubah.",
                            });
                        },
                        error: function (response) {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal upload data.",
                            });
                        },
                        complete: function (response) {
                            $("#modal-edit-sk").modal("hide");
                            $("#form-edit-sk").find("input").val("");
                            $(".record-sni-lama-edit").html("");
                            $("#edit-data-sk").html("");
                            $("#edit-data-sk").text("Simpan");
                            $("#edit-data-sk").attr("disabled", false);
                            $("#div_tambah_sni_lama_edit").html("");
                            $(".reset-value").html("");
                            $("#sk-penetapan-dt").DataTable().ajax.reload();
                            $("#rekap-identifikasi-dt")
                                .DataTable()
                                .ajax.reload();
                        },
                    });
                    return false;
                },
            });
    });

//{{-- hapus baris SNI lama yang berisi data --}}
$("#modal-edit-sk")
    .off("click")
    .on("click", ".hapus-sni-lama-edit", function () {
        id_sni_lama_edit = $(this)
            .closest(".record-sni-lama-edit")
            .find(".id_sni_lama_edit")
            .val();
        id_sk_edit = $("#id_sk_edit").val();
        if ($(".record-sni-lama-edit").length <= 1) {
            Toast.fire({
                icon: "warning",
                title: "Minimal terdapat satu data SNI lama.",
            });
        } else {
            if (id_sni_lama_edit != "") {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $(this).html(
                    '<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menghapus...'
                );
                $(this).attr("disabled", true);

                $.ajax({
                    type: "DELETE",
                    dataType: "JSON",
                    url: "/sk-penetapan/hapus-sni-lama/" + id_sni_lama_edit,
                    success: function (response) {
                        Toast.fire({
                            icon: "success",
                            title: "Data SNI lama telah terhapus.",
                        });
                    },
                    error: function (response) {
                        Toast.fire({
                            icon: "error",
                            title: "Gagal hapus data.",
                        });
                    },
                    complete: function (response) {
                        $("#div_tambah_sni_lama_edit").html("");
                        //memuat ulang SNI lama
                        $.ajax({
                            type: "GET",
                            url: "/sk-penetapan/modal-sk-edit/" + id_sk_edit,
                            success: function (response) {
                                $.each(
                                    response.data_sni_lama,
                                    function (key, item) {
                                        $("#div_tambah_sni_lama_edit").append(
                                            '<div id="record-sni-lama-edit[' +
                                                key +
                                                ']" class="record-sni-lama-edit row">\
                                                                    <div class="col-sm-9">\
                                                                        <input type="hidden" name="id_sni_lama[' +
                                                key +
                                                ']" class="id_sni_lama" value="' +
                                                item.id +
                                                '">\
                                                                        <div class="form-group">\
                                                                            <input type="text" class="form-control nmr_sni_lama_edit" placeholder="Masukkan nomor SNI Lama..." name="nmr_sni_lama_edit[' +
                                                key +
                                                ']" value="' +
                                                item.nmr_sni_lama +
                                                '">\
                                                                        </div>\
                                                                        <div class="form-group">\
                                                                            <textarea rows="2" placeholder="Masukkan judul SNI Lama..." name="jdl_sni_lama_edit[' +
                                                key +
                                                ']" class="form-control jdl_sni_lama_edit">' +
                                                item.jdl_sni_lama +
                                                '</textarea>\
                                                                        </div>\
                                                                    </div>\
                                                                    <div class="col-md-3">\
                                                                        <button type="button" class="btn btn-dark form-control hapus-sni-lama-edit">Hapus</button>\
                                                                    </div>\
                                                                </div>'
                                        );
                                        $("#counter-sni-lama-edit").val(
                                            key + 1
                                        );
                                    }
                                );
                            },
                        });
                    },
                });
            } else {
                $(this).closest(".record-sni-lama-edit").remove();
            }
        }
    });

// /*********************************************/
// /******** Hapus Data SK Penetapan SNI ********/
// /*********************************************/
$("body").on("click", ".hapus", function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var id_konfirmasi_hapus_sk = $(this).attr("id");

    $.ajax({
        type: "GET",
        url: "/sk-penetapan/konfirmasi-hapus-sk/" + id_konfirmasi_hapus_sk,
        success: function (response) {
            $("#body-konfirmasi-hapus-sk").append(
                '<input type="hidden" id="id_hapus_sk">\
                                        <h6>Apakah anda yakin menghapus SK Penetapan SNI nomor : <strong>' +
                    response.data.nmr_sk_sni +
                    "</strong> ?</h6>\
                                        <p>Apabila data SK penetapan SNI dihapus, maka data hasil identifikasi juga akan terhapus.</p>"
            );

            $("#id_hapus_sk").val(response.data.id);
        },
    });

    $("#modal-konfirmasi-hapus-sk").modal("show");

    $(".tombol-hapus-sk")
        .off("click")
        .on("click", function (e) {
            e.preventDefault();

            var id_hapus_sk = $("#id_hapus_sk").val();

            $(this).html(
                '<i class="spinner-border spinner-border-sm text-light" role="status"></i> Menghapus...'
            );
            $(this).attr("disabled", true);

            $.ajax({
                type: "DELETE",
                url: "/sk-penetapan/hapus-sk/" + id_hapus_sk,
                success: function (response) {
                    Toast.fire({
                        icon: "success",
                        title: "Berhasil hapus data SK Penetapan SNI.",
                    });
                    $("#modal-konfirmasi-hapus-sk").modal("hide");
                    $("#body-konfirmasi-hapus-sk").html("");
                    $(".tombol-hapus-sk").attr("disabled", false);
                    $(".tombol-hapus-sk").html("Hapus");
                    $("#sk-penetapan-dt").DataTable().ajax.reload();
                    $("#rekap-identifikasi-dt").DataTable().ajax.reload();
                },
            });
        });
});

$(".tutup-modal-edit").click(function () {
    $("#div_tambah_sni_lama_edit").html("");
    $(".reset-value").html("");
    $("#counter-sni-lama-edit").val(0);
});

$(".tutup-modal-konfirmasi-hapus-sk").on("click", function () {
    $("#body-konfirmasi-hapus-sk").html("");
});
