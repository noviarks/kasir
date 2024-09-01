<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportTransaksi implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $tgl1;
    private $tgl2;

    function __construct($tgl1,$tgl2) {
            $this->tgl1 = $tgl1;
            $this->tgl2 = $tgl2;
    }

    public function view(): View
    {
        $data = [
            'title'             => 'Transaksi',
            'data_transaksi'    => Transaksi::whereBetween('tanggal', [$this->tgl1, $this->tgl2])->get(),
        ];
        return view('admin.laporan.export-transaksi',$data);
    }
}
