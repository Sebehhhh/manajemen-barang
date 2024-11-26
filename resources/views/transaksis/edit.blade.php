@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Edit Transaksi</h4>
        </div>
        <div class="pb-20 px-3">
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="barang_id">Barang</label>
                    <select class="form-control" id="barang_id" name="barang_id" required>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                {{ $transaksi->barang_id == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama_barang }} <!-- Assuming 'name' is a field in the barang table -->
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_transaksi">Jenis Transaksi</label>
                    <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="masuk" {{ $transaksi->jenis_transaksi == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ $transaksi->jenis_transaksi == 'keluar' ? 'selected' : '' }}>Keluar
                        </option>
                        <option value="rusak" {{ $transaksi->jenis_transaksi == 'rusak' ? 'selected' : '' }}>Rusak
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                        value="{{ $transaksi->jumlah }}" required min="1">
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                        value="{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
