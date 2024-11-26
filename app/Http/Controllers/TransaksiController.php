<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $transaksis = Transaksi::with(['user', 'barang'])->get();
        return view('transaksis.index', compact('transaksis'));
    }

    // Menampilkan form untuk membuat transaksi baru
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $barangs = Barang::all();
        return view('transaksis.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jenis_transaksi' => 'required|in:masuk,keluar,rusak', // Add 'rusak' to the validation
            'jumlah' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);
    
        // Create a new transaction
        $transaksi = new Transaksi();
        $transaksi->user_id = Auth::id(); // Get the current user's ID
        $transaksi->barang_id = $request->input('barang_id');
        $transaksi->jenis_transaksi = $request->input('jenis_transaksi');
        $transaksi->jumlah = $request->input('jumlah');
        $transaksi->tanggal_transaksi = $request->input('tanggal_transaksi');
        $transaksi->save();
    
        // Adjust the stock based on the transaction type
        $barang = Barang::find($transaksi->barang_id); // Find the item
        if ($transaksi->jenis_transaksi === 'masuk') {
            // Increase stock
            $barang->stok += $transaksi->jumlah;
        } elseif ($transaksi->jenis_transaksi === 'keluar') {
            // Decrease stock, ensuring stock doesn't go negative
            if ($barang->stok >= $transaksi->jumlah) {
                $barang->stok -= $transaksi->jumlah;
            } else {
                return redirect()->back()->with('error', 'Stok tidak cukup untuk transaksi keluar.');
            }
        } elseif ($transaksi->jenis_transaksi === 'rusak') {
            // Decrease stock for damaged items
            if ($barang->stok >= $transaksi->jumlah) {
                $barang->stok -= $transaksi->jumlah;
            } else {
                return redirect()->back()->with('error', 'Stok tidak cukup untuk transaksi rusak.');
            }
        }
        $barang->save(); // Save the updated stock
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all();
        return view('transaksis.edit', compact('transaksi', 'barangs'));
    }

    public function show($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $transaksi = Transaksi::with('barang')->findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    // Memperbarui transaksi
    public function update(Request $request, $id)
{
    if (!Auth::check() || !Auth::user()->isAdmin) {
        return redirect('/home')->with('error', 'You do not have access to this page.');
    }
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jenis_transaksi' => 'required|in:masuk,keluar,rusak', // Include 'rusak' in the validation
        'jumlah' => 'required|integer|min:1',
        'tanggal_transaksi' => 'required|date',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $barang = Barang::findOrFail($transaksi->barang_id); // Get the associated barang

    // If the transaction type is changing
    if ($transaksi->jenis_transaksi !== $request->jenis_transaksi) {
        // If it was 'masuk' and is being changed to 'keluar' or 'rusak'
        if ($transaksi->jenis_transaksi === 'masuk') {
            // Decrease stock by the amount of the original transaction
            $barang->stok -= $transaksi->jumlah;
        } else { // It was 'keluar' and is being changed to 'masuk' or 'rusak'
            // Increase stock by the amount of the original transaction
            $barang->stok += $transaksi->jumlah;
        }
    }

    // Now we can update the transaction
    $transaksi->update($request->all());

    // Adjust stock based on the new transaction type
    if ($request->jenis_transaksi === 'masuk') {
        $barang->stok += $request->jumlah; // Increase stock for 'masuk'
    } elseif ($request->jenis_transaksi === 'keluar') {
        // Check if there is enough stock before reducing
        if ($barang->stok >= $request->jumlah) {
            $barang->stok -= $request->jumlah; // Decrease stock for 'keluar'
        } else {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk transaksi keluar.');
        }
    } elseif ($request->jenis_transaksi === 'rusak') {
        // For damaged items, check if there is enough stock before reducing
        if ($barang->stok >= $request->jumlah) {
            $barang->stok -= $request->jumlah; // Decrease stock for 'rusak'
        } else {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk transaksi rusak.');
        }
    }

    $barang->save(); // Save the updated stock

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
}

    // Menghapus transaksi
    public function destroy($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}