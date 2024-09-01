<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HapusDetailTransaksi extends Model
{
    use HasFactory;

    protected $table        = 'hapus_detail_transaksi';
    protected $casts        = ['id','string'];
    public $incrementing    = false;
    
    protected $fillable = [
        'id',
        'id_hapus_transaksi',
        'id_barang',
        'qty',
        'diskon',
        'harga',
        'total_diskon',
        'total_harga'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
