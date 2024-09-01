@extends('layout.app')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="/transaksi/store">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div> 
                            <hr>

                            <button type="button" class="btn btn-success btn-round ml-auto" data-toggle="modal" 
                                data-target="#modalCreate" style="color:white;">
                                <i class="fa fa-plus"></i>
                                Tambah Barang
                            </button>
                            <hr>
                            
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
                                        <th>Action</th>
                                    </tr>
                                @php 
                                    $no = 1;
                                    $subtotal_diskon = 0;
                                    $subtotal_harga = 0;
                                @endphp

                                @if(session('cart'))
                                    @foreach(session('cart') as $item)
                                    @php
                                        $row    = (int)filter_var($item['id_barang'], FILTER_SANITIZE_NUMBER_INT);
                                        $diskon = ($item['diskon']/100) * $item['harga'];
                                        $total_diskon = $diskon * $item['qty'];
                                        $subtotal_diskon+= $total_diskon;

                                        $total_harga  = $item['harga'] * $item['qty'];
                                        $subtotal_harga+= $total_harga;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item['nama_barang'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>Rp {{ number_format($item['harga']) }}</td>
                                        <td>Rp {{ number_format($diskon) }}</td>
                                        <td>Rp {{ number_format($total_harga) }}</td>
                                        <td>Rp {{ number_format($total_diskon) }}</td>
                                        <td>
                                            <a href="#modalEdit{{ $item['id_barang'] }}" data-toggle="modal" class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a onclick="return confirm('Hapus Data Ini?')" href="/transaksi/delete-cart/{{ $row }}" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                    <tr>
                                        <td colspan="6">Subtotal Harga</td>
                                        <td>Rp {{ number_format($subtotal_harga) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Subtotal Diskon</td>
                                        <td>Rp {{ number_format($subtotal_diskon) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Total Bayar</td>
                                        <td>
                                            Rp {{ number_format($subtotal_harga - $subtotal_diskon) }}
                                            <input type="hidden" id="total_bayar" name="total_bayar" value="{{ ($subtotal_harga - $subtotal_diskon) }}">
                                        </td> 
                                        <td></td>                                     
                                    </tr>
                                </table>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_transaksi">Id Transaksi</label>
                                        <input type="text" value="{{ $id_transaksi }}" id="id_transaksi" class="form-control" name="id_transaksi" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_transaksi">Tgl Transaksi</label>
                                        <input type="text" value="{{ date('d/m/Y') }}" id="tgl_transaksi" class="form-control" name="tgl_transaksi" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pembayaran">Pembayaran</label>
                                        <input type="number" id="pembayaran" class="form-control" name="pembayaran" placeholder="Rp..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kembalian">Kembalian</label>
                                        <input type="number" id="kembalian" class="form-control" name="kembalian" placeholder="Rp..." readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="/transaksi" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="post" action="/transaksi/add-to-cart">
                @csrf
                <div class="modal-body">
                    <div class="from-group mb-3">
                        <label for="id_barang">Barang</label>
                        <select id="id_barang" class="form-control select-barang select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" name="id_barang" required>
                            <option value="" hidden>-- Pilih Nama Barang --</option>
                            @foreach($data_barang as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="tampil_barang"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('cart'))
    @foreach(session('cart') as $item)
    <div class="modal fade" id="modalEdit{{ $item['id_barang'] }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>

                <form method="post" action="/transaksi/update-cart">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group mb-3">
                            <label for="id_barang">Barang</label>
                            <select id="id_barang" class="form-control" name="id_barang" readonly required>
                                <option value="{{ $item['id_barang'] }}">{{ $item['nama_barang'] }}</option>
                            </select>
                        </div>

                        <label for="harga">Harga</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" value="{{ number_format($item['harga']) }}" min="0" id="harga" name="harga" class="form-control" readonly required>
                        </div>

                        <label for="diskon">Diskon</label>
                        <div class="input-group mb-3">
                            <input type="text" value="{{ $item['diskon'] }}" min="0" id="diskon" class="form-control" name="diskon" readonly required>
                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                        </div>

                        <label for="Stok">Stok</label>    
                        <div class="input-group mb-3">
                            <input type="text" value="{{ $item['stok'] }}" min="0" id="stok" class="form-control" name="stok" readonly required>
                            <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
                        </div>

                        <label for="qty">Qty</label>
                        <div class="input-group mb-3">
                            <input type="number" value="{{ $item['qty'] }}" min="0" id="stok" class="form-control" name="qty" placeholder="Qty..." required>
                            <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>
    @endforeach
@endif
@endsection

@push('transaksi_script')
<script type="text/javascript">    
    $(document).ready(function(){
        $(".select-barang").select2({
            dropdownParent: $('#modalCreate'),
            placeholder: '--Pilih Barang--'
        });
        $("#id_barang").change(function(){
            var id_barang = $("#id_barang").val();

            $.ajax({
                headers : {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                type    : "POST",
                url     : "/transaksi/get-detail-barang",
                data    : "id_barang="+id_barang,
                cache   : false,
                success : function(data){
                    $("#tampil_barang").html(data);
                }
            });

        });

        $("#total_bayar, #pembayaran, #kembalian").keyup(function(){
            var total_bayar = $("#total_bayar").val();
            var pembayaran  = $("#pembayaran").val();
            var kembalian   = parseInt(pembayaran) - parseInt(total_bayar);
            $("#kembalian").val(kembalian);
        });
    });
</script>
@endpush