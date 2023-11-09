@extends('layout.app')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Master</a></li>
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
                                            <td>{{ $row->id_transaksi }}</td>
                                            <td>{{ date('d/m/Y',strtotime($row->tanggal)) }}</td>
                                            <td>Rp {{ number_format($row->subtotal_harga) }}</td>
                                            <td>Rp {{ number_format($row->subtotal_diskon) }}</td>
                                            <td>Rp {{ number_format($row->total_bayar) }}</td>
                                            <td class="text-center">
                                                <a href="/hapus-transaksi/detail/{{ $row->id }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-list"></i> Detail
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

@endsection
