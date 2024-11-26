<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal, $tanggalAkhir)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function collection()
    {
        $barang = Barang::with([
            'transaksiMasuk' => function ($query) {
                $query->whereBetween('created_at', [$this->tanggalAwal, $this->tanggalAkhir]);
            },
            'transaksiKeluar' => function ($query) {
                $query->whereBetween('created_at', [$this->tanggalAwal, $this->tanggalAkhir]);
            },
            'transaksiRusak' => function ($query) {
                $query->whereBetween('created_at', [$this->tanggalAwal, $this->tanggalAkhir]);
            }
        ])->get();

        $data = [];

        foreach ($barang as $b) {
            $data[] = [
                'nama_barang' => $b->nama_barang,
                'total_masuk' => $b->transaksiMasuk->sum('jumlah'),
                'total_keluar' => $b->transaksiKeluar->sum('jumlah'),
                'total_rusak' => $b->transaksiRusak->sum('jumlah'),
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Total Masuk',
            'Total Keluar',
            'Total Rusak',
        ];
    }

    public function styles($sheet)
    {
        // Styling untuk header
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFF']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '4CAF50']],
        ]);

        // Styling untuk isi tabel
        $sheet->getStyle('A2:D' . (count($this->collection()) + 1))->applyFromArray([
            'font' => ['size' => 10],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'border' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30, // Nama Barang
            'B' => 20, // Total Masuk
            'C' => 20, // Total Keluar
            'D' => 20, // Total Rusak
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menambahkan border pada seluruh sheet
                $event->sheet->getDelegate()->getStyle('A1:D' . (count($this->collection()) + 1))
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            },
        ];
    }
}
