@extends('layouts.main', ['title' => 'Dashboard'])

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Default box -->
    {{-- <h1 id="batas-transisi" class="mb-3"></h1> --}}
    {{-- <h1 id="demo" class="mb-5"></h1> --}}

    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $sni_wajib }}</h3>

                    <h4>SNI Wajib</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-earth-asia"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $sni_sukarela }}</h3>

                    <h4>SNI Sukarela</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $sk_total }}</h3>

                    <h4>Total SNI</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="statistik-sk-penetapan-sni-pie-chart">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="statistik-identifikasi-petugas-stacked-bar-chart">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="statistik-pembahasan-sni-pie-chart">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="statistik-masa-transisi-sni-pie-chart">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Masa Transisi SNI Lama</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover" id="masa-transisi-sni-dt">
                <thead class="bg-info text-white">
                    <tr>
                        <th>No</th>
                        <th style="width: 23%">SNI Revisi</th>
                        <th style="width: 23%">SNI Direvisi</th>
                        <th style="width: 20%">Nomor KEPKA</th>
                        <th>Batas Transisi</th>
                        <th>Masa Berlaku</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SNI Lama - Pencabutan</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover" id="sni-lama-pencabutan-dt">
                <thead class="bg-warning text-white">
                    <tr>
                        <th>No</th>
                        <th>Nomor SNI</th>
                        <th style="width: 25%">Judul SNI</th>
                        <th>Komite Teknis</th>
                        <th>Nomor KEPKA</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {

            // Pie Chart SK Penetapan SNI
            Highcharts.chart('statistik-sk-penetapan-sni-pie-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik SK Penetapan SNI Revisi'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'SK Penetapan SNI',
                    data: [{
                            name: 'Teridentifikasi <br/> (' + {!! $teridentifikasi !!} + ' SK )',
                            y: {!! $teridentifikasi !!}
                        },
                        {
                            name: 'Belum Teridentifikasi <br/> (' +
                                {!! $belum_teridentifikasi !!} + ' SK )',
                            y: {!! $belum_teridentifikasi !!}
                        },
                    ]
                }]
            });


            //Stacked Bar Chart Identifikasi Petugas
            Highcharts.chart('statistik-identifikasi-petugas-stacked-bar-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Statistik Identifikasi Petugas'
                },
                xAxis: {
                    categories: [
                        @foreach ($list_pic as $pic)
                            '{{ $pic->pic }}',
                        @endforeach
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Penugasan Identifikasi SK'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'gray',
                            textOutline: 'none'
                        }
                    }
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [{
                        name: 'Teridentifikasi',
                        data: [
                            @foreach ($list_pic as $pic)
                                {{ $pic->teridentifikasi }},
                            @endforeach
                        ]
                    },
                    {
                        name: 'Belum Teridentifikasi',
                        data: [
                            @foreach ($list_pic as $pic)
                                {{ $pic->belum_teridentifikasi }},
                            @endforeach
                        ]
                    },
                ]
            });

            // Pie Chart pembahasan SNI
            Highcharts.chart('statistik-pembahasan-sni-pie-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik Pembahasan SNI'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Pembahsan SNI',
                    data: [{
                            name: 'Belum dibahas <br/> (' + {{ $belum_dibahas }} + ' judul )',
                            y: {{ $belum_dibahas }}
                        },
                        {
                            name: 'Sudah dibahas <br/> (' + {{ $sudah_dibahas }} + ' judul )',
                            y: {{ $sudah_dibahas }}
                        },
                    ]
                }]
            });

            // Pie Chart masa transisi SNI
            Highcharts.chart('statistik-masa-transisi-sni-pie-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Statistik Masa Transisi SNI'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Masa Transisi SNI',
                    data: [{
                            name: 'Pencabutan <br/> (' + {{ $pencabutan }} + ' judul )',
                            y: {{ $pencabutan }}
                        },
                        {
                            name: 'Transisi <br/> (' + {{ $transisi }} + ' judul )',
                            y: {{ $transisi }}
                        },
                    ]
                }]
            });

        });
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
@endpush
