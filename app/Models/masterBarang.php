<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\transaksi;


class masterBarang extends Model
{
    use HasFactory;
    protected $table = 'master_barang';
    protected $fillable = [
        'namaBarang', 'jenisBarang', 'stok',
    ];

    public function kurangiStok($jumlah)
    {
        $this->stok -= $jumlah;
        $this->save();
    }

    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }

}
