@extends('layout.app')
@section('content')

<div class="content-body">

    <!-- row -->

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div> 
                        
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <form class="form-inline" method="post" action="/laporan/export-transaksi" id="filter">
                                    @csrf
                                    <div class="form-group mx-sm-3">
                                        <label for="tgl1" class="sr-only">Dari</label>
                                        <input type="text" class="form-control" id="min" placeholder="Min Tanggal" name="tgl1" required>
                                    </div>
                                        <div class="from-group mx-sm-3">
                                        <label for="tgl2" class="sr-only">Hingga</label>
                                        <input type="text" class="form-control" id="max" placeholder="Max Tanggal" name="tgl2" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa fa-file-excel"></i> Export
                                    </button>

                                </form>
                            </div>
                        </div>
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration" id="my-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Subtotal Harga</th>
                                        <th>Subtotal Diskon</th>
                                        <th>Total Bayar</th>
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

@push('laporan_script')
<script>
    table = $('#my-table').DataTable();

    $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = $('#min').val();
        var max = $('#max').val();
        var date = data[2] || 0;
        
        var part_min = min.split('/');
        var part_max = max.split('/');
        var part_date = date.split('/');

        var newMin = new Date(part_min[2]+'-'+part_min[1]+'-'+part_min[0]);
        var newMax = new Date(part_max[2]+'-'+part_max[1]+'-'+part_max[0]);
        var newDate = new Date(part_date[2]+'-'+part_date[1]+'-'+part_date[0]);

            console.log(newMax >= newDate);
            if (
                (min.length == 0 && max.length == 0) ||
                (min.length == 0 && newDate <= newMax) ||
                (newMin <= newDate && max.length == 0) ||
                (newMin <= newDate && newDate <= newMax)
            ) {
                return true;
            }
            return false;
    }
    );

    $('#min').datepicker({ 
        onChangeMonthYear: function () {
                table.draw(); 
        }, 
        format: "dd/mm/yyyy",
        changeMonth: true, 
        changeYear: true,
        autoclose: true
    });

    $('#max').datepicker({ 
        onChangeMonthYear: function () { 
            table.draw(); 
        },
        format: "dd/mm/yyyy",
        changeMonth: true, 
        changeYear: true,
        autoclose: true
    });

    $('#min,#max').change(function() {
        table.draw();
    });

</script>
@endpush