<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Barang extends Model
{
    use HasFactory, Notifiable;

  protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'stok',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function transaksiMasuk()
    {
        return $this->hasMany(Transaksi::class, 'barang_id')->where('jenis_transaksi', 'masuk');
    }

    // Menambahkan relasi untuk transaksi keluar
    public function transaksiKeluar()
    {
        return $this->hasMany(Transaksi::class, 'barang_id')->where('jenis_transaksi', 'keluar');
    }

    // Menambahkan relasi untuk transaksi rusak
    public function transaksiRusak()
    {
        return $this->hasMany(Transaksi::class, 'barang_id')->where('jenis_transaksi', 'rusak');
    }
    
}
