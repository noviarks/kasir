<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Home',
            'transaksi_hari_ini' => Transaksi::where('tanggal',date('Y-m-d'))->count(),
            'pendapatan_hari_ini' => Transaksi::whereDate('tanggal',date('Y-m-d'))->sum('total_bayar'),
            'transaksi_bulan_ini' => Transaksi::whereYear('tanggal', '=', date('Y'))
                                                ->whereMonth('tanggal', '=', date('m'))
                                                ->count(),

            'pendapatan_bulan_ini' => Transaksi::whereYear('tanggal', '=', date('Y'))
                                            ->whereMonth('tanggal', '=', date('m'))
                                            ->sum('total_bayar')
            
        ];  
        
        return view('home',$data);
    }
}
