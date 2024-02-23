<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\masterBarang;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'terjual', 'tanggalTransaksi','master_barang_id'
    ];

    public function masterBarang()
    {
        return $this->belongsTo(masterBarang::class);
    }
}
