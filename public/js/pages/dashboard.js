masa_transisi_sni_dt();

function masa_transisi_sni_dt() {
    $("#masa-transisi-sni-dt").DataTable({
        language: {
            url: "/json/id.json",
        },
        dom: "Bfrtip",
        buttons: ["excel"],
        serverside: true,
        ajax: {
            url: "/dashboard/masa-transisi-sni-dt",
            type: "GET",
            dataType: "JSON",
        },
        columnDefs: [
            {
                className: "my_class",
                targets: [4],
            },
        ],
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "new.standards.nmr_std",
                name: "new.standards.nmr_std",
                render: function (data, type, row) {
                    return (
                        row.new.standards.nmr_std +
                        " " +
                        row.new.standards.jdl_std
                    );
                },
            },
            {
                data: "old_standards.nmr_std",
                name: "old_standards.nmr_std",
                render: function (data, type, row) {
                    return (
                        row.old_standards.nmr_std +
                        " " +
                        row.old_standards.jdl_std
                    );
                },
            },
            {
                data: "memos.nmr_kepka",
                name: "memos.nmr_kepka",
            },
            {
                data: "transition_times.batas_transisi",
                name: "transition_times.batas_transisi",
            },
            {
                data: "masa_berlaku",
                render: function (data, type, row) {
                    // Set the date we're counting down to
                    var countDownDate = new Date(row.batas_transisi).getTime();

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for years, months, days, hours, minutes and seconds
                    var years = Math.floor(
                        distance / (1000 * 60 * 60 * 24 * 365)
                    );
                    var months = Math.floor(
                        (distance % (1000 * 60 * 60 * 24 * 365)) /
                            (1000 * 60 * 60 * 24 * 30.41)
                    );
                    var days = Math.floor(
                        (distance % (1000 * 60 * 60 * 24 * 30.41)) /
                            (1000 * 60 * 60 * 24)
                    );
                    var hours = Math.floor(
                        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                    );

                    // Display the result in the element with id="demo"
                    var time = document.getElementsByClassName("my_class");
                    var remaining = (time.innerHTML =
                        years +
                        " tahun " +
                        months +
                        " bulan " +
                        days +
                        " hari");

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        return (time.innerHTML =
                            '<h4 class="badge badge-danger">KADALUARSA</h4>');
                    } else {
                        return remaining;
                    }
                },
            },
        ],
        order: [[4, "asc"]],
    });
}

sni_lama_pencabutan_dt();

function sni_lama_pencabutan_dt() {
    $("#sni-lama-pencabutan-dt").DataTable({
        language: {
            url: "/json/id.json",
        },
        dom: "Bfrtip",
        buttons: ["excel"],
        serverside: true,
        ajax: {
            url: "/dashboard/sni-lama-pencabutan-dt",
            type: "GET",
            dataType: "JSON",
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "old_standards.nmr_std",
                name: "old_standards.nmr_std",
            },
            {
                data: "old_standards.jdl_std",
                name: "old_standards.jdl_std",
            },
            {
                data: "identifications.komtek",
                name: "identifications.komtek",
            },
            {
                data: "memos.nmr_kepka",
                name: "memos.nmr_kepka",
            },
        ],
        order: [[1, "asc"]],
    });
}
