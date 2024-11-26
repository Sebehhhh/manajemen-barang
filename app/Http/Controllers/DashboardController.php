<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total quantities for each item
        $barangMasuk = Transaksi::where('jenis_transaksi', 'masuk')
            ->select('barang_id', DB::raw('SUM(jumlah) as total_masuk'))
            ->groupBy('barang_id')
            ->get();

        $barangKeluar = Transaksi::where('jenis_transaksi', 'keluar')
            ->select('barang_id', DB::raw('SUM(jumlah) as total_keluar'))
            ->groupBy('barang_id')
            ->get();

        $barangRusak = Transaksi::where('jenis_transaksi', 'rusak')
            ->select('barang_id', DB::raw('SUM(jumlah) as total_rusak'))
            ->groupBy('barang_id')
            ->get();
        
            $barang = Barang::all();
            $barangCount = count($barang);
        // Pass the data to the view
        return view('dashboard', compact('barangCount','barangMasuk', 'barangKeluar', 'barangRusak'));
    }
}