@extends('layouts.app')

@section('title', 'Create Barang')

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Create New Barang</h4>
        </div>
        <div class="pb-20 px-3">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" required min="0">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Barang</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
