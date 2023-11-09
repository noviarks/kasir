@extends('layout.app')
@section('content')
<div class="content-body">

    <div class="container-fluid mt-3">
        
        <div class="row">
            <div class="col-lg-3 col-sm-6 px-1">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Transaksi Hari Ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $transaksi_hari_ini }}</h2>
                            <p class="text-white mb-0">{{ date('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 px-1">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Pendapatan Hari Ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">Rp {{ number_format($pendapatan_hari_ini) }}</h2>
                            <p class="text-white mb-0">{{ date('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 px-1">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Transaksi Bulan Ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $transaksi_bulan_ini }}</h2>
                            <p class="text-white mb-0">{{ date('F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 px-1">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Pendapatan Bulan Ini</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">Rp {{ number_format($pendapatan_bulan_ini) }}</h2>
                            <p class="text-white mb-0">{{ date('F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>

</div>
@endsection
