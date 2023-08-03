@if (Auth::user()->level != 0)
    <script type="text/javascript">
        window.location = "{{ url('/dashboard') }}"; //here double curly bracket
    </script>
@endif

@extends('layouts.main', ['title' => 'SK Penetapan SNI'])

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>SK Penetapan SNI</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rekap Identifikasi Komtek dan Penerap SNI</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="rekap-identifikasi-dt">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Nama</th>
                        <th>Belum Teridentifikasi</th>
                        <th>Teridentifikasi</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title inline">
                Data SK Penetapan SNI Revisi
                <button type="button" class="btn btn-sm btn-dark" id="tombol-tambah-data" title="tambah data"
                    data-toggle="modal" data-target="#modal-tambah-sk">
                    <span class="fa fa-plus"></span>
                </button>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover" id="sk-penetapan-dt">
                <thead class="bg-dark text-white">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nomor SK</th>
                        <th>Tanggal SK</th>
                        <th>Uraian SK</th>
                        <th>PIC</th>
                        <th>Waktu Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('modals.modal-sk-penetapan')
@endsection

@push('css')
@endpush

@push('js')
    <script src="{{ asset('js/pages/skPenetapan.js') }}"></script>
@endpush
