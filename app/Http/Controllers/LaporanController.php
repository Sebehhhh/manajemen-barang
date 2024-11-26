<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function downloadExcel(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        // Ekspor file Excel
        return Excel::download(new LaporanExport($tanggalAwal, $tanggalAkhir), "laporan_barang_{$tanggalAwal}_to_{$tanggalAkhir}.xlsx");
    }
}
