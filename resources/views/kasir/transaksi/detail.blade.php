@extends('layout.app')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div> 
                        <hr>

                        <a href="/transaksi">
                            <button type="button" class="btn btn-danger btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-undo"></i>
                                Kembali
                            </button>
                        </a>
                        <a href="/transaksi/cetak/{{ $id }}" target="_blank">
                            <button type="button" class="btn btn-dark btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-print"></i>
                                Cetak
                            </button>
                        </a>
                        <hr>

                        @foreach($data_transaksi as $row)
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Id Transaksi : {{ $row->id }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Tgl Transaksi : {{ date('d/m/Y',strtotime($row->tanggal)) }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Kasir : {{ ucwords($row->user_kasir->name) }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Total Harga</th>
                                    <th>Total Diskon</th>
                                    
                                </tr>
                                @php 
                                    $no = 1;
                                @endphp
                                
                                @foreach($data_detail_transaksi as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $detail->nama }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rp {{ number_format($detail->harga) }}</td>
                                        <td>Rp {{ number_format($detail->diskon) }}</td>
                                        <td>Rp {{ number_format($detail->total_harga) }}</td>
                                        <td>Rp {{ number_format($detail->total_diskon) }}</td>
                                    </tr>
                                @endforeach
                               
                                <tr>
                                    <td colspan="6">Subtotal Harga</td>
                                    <td>Rp {{ number_format($row->subtotal_harga) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Subtotal Diskon</td>
                                    <td>Rp {{ number_format($row->subtotal_diskon) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Total Bayar</td>
                                    <td>Rp {{ number_format($row->total_bayar) }}</td>                                   
                                </tr>
                                <tr>
                                    <td colspan="6">Pembayaran</td>
                                    <td>Rp {{ number_format($row->pembayaran) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Kembalian</td>
                                    <td>Rp {{ number_format($row->kembalian) }}</td>                                   
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

@endsection