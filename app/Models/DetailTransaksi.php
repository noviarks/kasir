<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table        = 'detail_transaksi';
    protected $casts        = ['id','string'];
    public $incrementing    = false;
    
    protected $fillable = [
        'id',
        'id_transaksi',
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
