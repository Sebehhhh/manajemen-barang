@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Edit Barang</h4>
        </div>
        <div class="pb-20 px-3">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        value="{{ $barang->nama_barang }}" required>
                </div>
                <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                        value="{{ $barang->kode_barang }}" readonly>
                    <!-- Kode barang hanya bisa dibaca dan tidak bisa diubah -->
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $barang->stok }}"
                        required min="0>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Barang</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
