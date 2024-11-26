@extends('layouts.app')
@section('title')
    Transaksi
@endsection
@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Transaksi Data Table</h4>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
            <!-- Tombol untuk menambahkan transaksi -->
        </div>
        <div class="pb-20 px-3">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">#</th>
                        <th>Pengguna</th>
                        <th>Barang</th>
                        <th>Jenis Transaksi</th>
                        <th>Jumlah</th>
                        <th>Tanggal Transaksi</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>{{ $transaksi->user->name }}</td>
                            <td>{{ $transaksi->barang->nama_barang }}</td>
                            <td>{{ ucfirst($transaksi->jenis_transaksi) }}</td>
                            <td>{{ $transaksi->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('transaksi.show', $transaksi) }}"><i
                                                class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="{{ route('transaksi.edit', $transaksi) }}"><i
                                                class="dw dw-edit2"></i> Edit</a>
                                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST"
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
