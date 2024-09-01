<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTransaksi;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function transaksi(){
        $tgl1= date('Y-m-d');
        $tgl2= date('Y-m-d');
        $data = [
            'title'             => 'Transaksi',
            'data_transaksi'    => Transaksi::all(),
            'tgl1'              => $tgl1,
            'tgl2'              => $tgl2,
        ];

        return view('admin.laporan.transaksi',$data);
    }

    public function exportTransaksi(Request $request) 
    {
        if(isset($request->tgl1) && isset($request->tgl2)){
            $tgl1 = str_replace('/', '-', $request->tgl1);
            $tgl1 = date('Y-m-d',strtotime($tgl1));

            $tgl2 = str_replace('/', '-', $request->tgl2);
            $tgl2 = date('Y-m-d',strtotime($tgl2));
        }
        
        return Excel::download(new ExportTransaksi($tgl1,$tgl2), 'Laporan_Transaksi_'.date('d-m-Y').'.xlsx');
    }
}
