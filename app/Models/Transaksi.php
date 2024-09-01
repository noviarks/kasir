<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table        = 'transaksi';
    protected $casts        = ['id','string'];
    public $incrementing    = false;
    
    protected $fillable = [
        'id',
        'tanggal',
        'subtotal_diskon',
        'subtotal_harga',
        'total_bayar',
        'pembayaran',
        'kembalian',
        'user_id'
    ];

    public function user_kasir()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
