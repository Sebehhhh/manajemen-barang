@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="card-box pd-20 height-100-p mb-30">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="vendors/images/banner-img.png" alt="">
            </div>
            <div class="col-md-8">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    Selamat Datang <div class="weight-600 font-30 text-blue">di Sistem Manajemen Barang</div>
                </h4>
                <p class="font-18 max-width-600">Selamat datang di sistem manajemen barang untuk usaha fotokopian.
                    Sistem ini dirancang untuk membantu Anda mengelola stok barang masuk dan keluar dengan mudah,
                    memberikan rekap data yang akurat, serta mendukung kelancaran operasional bisnis Anda.</p>
            </div>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->isAdmin)
        <div class="card-box pd-20 mb-30">
            <h4 class="font-20 weight-500 mb-10 text-blue">Rekap Laporan</h4>
            <form action="{{ route('laporan.download-excel') }}" method="GET" target="_blank">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">Unduh Laporan</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-box pd-20 mb-30">
            <h4 class="font-20 weight-500 mb-10 text-blue">Statistik Barang</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box pd-20 text-center">
                        <h5 class="font-15">Jumlah Jenis Barang</h5>
                        <h1 class="font-30 weight-600">{{ $barangCount }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box pd-20 mb-30">
            <h4 class="font-20 weight-500 mb-10">Detail Barang Masuk</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Total Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangMasuk as $masuk)
                            <tr>
                                <td>{{ $masuk->barang->nama_barang }}</td>
                                <td>{{ $masuk->total_masuk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-box pd-20 mb-30">
            <h4 class="font-20 weight-500 mb-10">Detail Barang Keluar</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Total Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangKeluar as $keluar)
                            <tr>
                                <td>{{ $keluar->barang->nama_barang }}</td>
                                <td>{{ $keluar->total_keluar }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-box pd-20 mb-30">
            <h4 class="font-20 weight-500 mb-10">Detail Barang Rusak</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Total Rusak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangRusak as $rusak)
                            <tr>
                                <td>{{ $rusak->barang->nama_barang }}</td>
                                <td>{{ $rusak->total_rusak }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
