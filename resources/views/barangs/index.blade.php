@extends('layouts.app')
@section('title')
    Barang
@endsection
@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Data Barang</h4>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Add Barang</a>
            <!-- Tombol untuk menambahkan barang -->
        </div>
        <div class="pb-20 px-3">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">#</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Stok</th>
                        <th>Created at</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>{{ $barang->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('barang.show', $barang) }}"><i
                                                class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="{{ route('barang.edit', $barang) }}"><i
                                                class="dw dw-edit2"></i> Edit</a>
                                        <form action="{{ route('barang.destroy', $barang) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure?')"><i class="dw dw-delete-3"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
