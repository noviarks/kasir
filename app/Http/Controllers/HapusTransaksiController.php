<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HapusTransaksi;
use App\Models\DetailTransaksi;
use App\Models\HapusDetailTransaksi;

class HapusTransaksiController extends Controller
{
    public function index(){
        $data = [
            'title'             => 'Hapus Transaksi',
            'data_transaksi'    => HapusTransaksi::orderBy('id','desc')->get()
        ];

        return view('admin.hapus-transaksi.index',$data);
    }

    public function detail($id){
        $data = [
            'title'                 => 'Hapus Detail Transaksi',
            'id'                    => $id,
            'data_transaksi'        => HapusTransaksi::where('id',$id)->get(),
            'data_detail_transaksi' => HapusTransaksi::join('hapus_detail_transaksi','hapus_transaksi.id','=','hapus_detail_transaksi.id_hapus_transaksi')
                                                ->join('barang','barang.id','=','hapus_detail_transaksi.id_barang')
                                                ->select('hapus_transaksi.id','hapus_transaksi.tanggal','hapus_detail_transaksi.qty','barang.nama','hapus_detail_transaksi.harga',
                                                        'hapus_detail_transaksi.diskon','hapus_detail_transaksi.total_diskon','hapus_detail_transaksi.total_harga',
                                                        'hapus_transaksi.subtotal_diskon','hapus_transaksi.subtotal_harga','hapus_transaksi.total_bayar','hapus_transaksi.pembayaran',
                                                        'hapus_transaksi.kembalian')
                                                ->where('hapus_transaksi.id',$id)
                                                ->get()
        ];
        
        return view('admin.hapus-transaksi.detail',$data);
    }
}
