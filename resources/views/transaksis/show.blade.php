@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Transaction Details</h4>
        </div>
        <div class="pb-20 px-3">
            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <p>{{ $transaksi->barang->nama_barang }}</p> <!-- Assuming 'name' is a field in the barang table -->
            </div>
            <div class="form-group">
                <label for="jenis_transaksi">Jenis Transaksi:</label>
                <p>{{ ucfirst($transaksi->jenis_transaksi) }}</p> <!-- Capitalize the first letter -->
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <p>{{ $transaksi->jumlah }}</p>
            </div>
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                <p>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</p>
            </div>
            <div class="form-group">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Back to Transactions List</a>
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-primary">Edit Transaction</a>
            </div>
        </div>
    </div>
@endsection
