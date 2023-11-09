<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table        = 'jenis_barang';
    protected $casts        = ['id','string'];
    public $incrementing    = false;
    
    protected $fillable = [
        'id',
        'nama'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function barang(){
        return $this->hasMany(Barang::class);
    }
}
