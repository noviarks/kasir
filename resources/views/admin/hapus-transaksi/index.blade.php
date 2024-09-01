@extends('layout.app')
@section('content')

<div class="content-body">

    <!-- row -->

    <div class="container-fluid mt-3">
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
                                        <th>Waktu</th>
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
                                            <td>{{ date('d/m/Y H:m',strtotime($row->tanggal)) }}</td>
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
