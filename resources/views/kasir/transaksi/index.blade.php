@extends('layout.app')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
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
                            <a href="/transaksi/create" class="btn btn-primary btn-round ml-auto">
                                Tambah Data
                            </a>
                        </div> 
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Subtotal Harga</th>
                                        <th>Subtotal Diskon</th>
                                        <th>Total Bayar</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach($data_transaksi as $row)
                                        <tr>
                                            <td>{{ $no++; }}</td>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ date('d/m/Y',strtotime($row->tanggal)) }}</td>
                                            <td>Rp {{ number_format($row->subtotal_harga) }}</td>
                                            <td>Rp {{ number_format($row->subtotal_diskon) }}</td>
                                            <td>Rp {{ number_format($row->total_bayar) }}</td>
                                            <td class="text-center">
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </a>
                                                <a href="/transaksi/detail/{{ $row->id }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-list"></i> Detail
                                                </a>
                                                <a href="/transaksi/cetak/{{ $row->id }}" target="_blank" class="btn btn-sm btn-dark">
                                                    <i class="fa fa-print"></i> Cetak
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

@foreach ($data_transaksi as $del_transaksi)
    <div class="modal fade" id="modalHapus{{ $del_transaksi->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="get" action="/transaksi/destroy/{{ $del_transaksi->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group">
                            <h7>Apakah Anda Ingin Menghapus Data Ini?</h7>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Tidak</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
