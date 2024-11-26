<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
       
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
      
        return view('barangs.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // Validasi input dari form
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0', // Validasi untuk stok
        ]);
    
        // Menghasilkan kode barang unik
        do {
            $kode_barang = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (Barang::where('kode_barang', $kode_barang)->exists());
    
        // Membuat barang baru
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $kode_barang, // Menyimpan kode barang yang dihasilkan
            'stok' => $request->stok,
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }

    public function show(Barang $barang)
    {
      
        return view('barangs.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
      
        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
      

        // Validasi input dari form
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id, // Validasi kode_barang unik kecuali untuk barang ini
            'stok' => 'required|integer|min:0', // Validasi untuk stok
        ]);

        // Ambil barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Update data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'stok' => $request->stok,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang updated successfully.');
    }

    public function destroy(Barang $barang)
    {
      
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }
}