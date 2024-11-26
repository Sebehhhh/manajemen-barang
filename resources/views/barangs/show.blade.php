@extends('layouts.app')

@section('title', 'Barang Details')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Barang Details</h4>
        </div>
        <div class="pb-20 px-3">
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <p>{{ $barang->nama_barang }}</p>
            </div>
            <div class="form-group">
                <label for="kode_barang">Kode Barang:</label>
                <p>{{ $barang->kode_barang }}</p>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <p>{{ $barang->stok }}</p>
            </div>
            <div class="form-group">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Back to Barang List</a>
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-primary">Edit Barang</a>
            </div>
        </div>
    </div>
@endsection
