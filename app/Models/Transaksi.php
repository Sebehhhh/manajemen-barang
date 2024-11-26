<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'barang_id',
        'jenis_transaksi',
        'jumlah',
        'tanggal_transaksi',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
