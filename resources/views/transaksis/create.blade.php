@extends('layouts.app')

@section('title', 'Create Transaksi')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Create New Transaksi</h4>
        </div>
        <div class="pb-20 px-3"> <!-- Menambahkan kelas px-3 di sini -->
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="barang_id">Barang</label>
                    <select class="form-control" id="barang_id" name="barang_id" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1">
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
