<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $table        = 'barang';
    protected $casts        = ['id','string'];
    public $incrementing    = false;
    
    protected $fillable = [
        'id',
        'id_jenis_barang',
        'nama',
        'harga',
        'stok',
        'diskon'
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class,'id_jenis_barang');
    }
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
