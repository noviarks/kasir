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
                            <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div> 
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Diskon</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach($data_barang as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->jenis_barang->nama }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>Rp {{ number_format($row->harga) }}</td>
                                            <td>{{ $row->stok }} Pcs</td>
                                            <td>{{ $row->diskon }} %</td>
                                            <td class="text-center">
                                                <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                               
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

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="post" action="/barang/store">
                @csrf
                <div class="modal-body">
                    <div class="from-group mb-2">
                        <label for="id_jenis_barang">Jenis Barang</label>
                        <select id="id_jenis_barang" class="form-control" name="id_jenis_barang" required>
                            <option value="" hidden>-- Pilih Jenis Barang --</option>
                            @foreach($data_jenis_barang as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="from-group mb-3">
                        <label for="nama">Nama Barang</label>
                        <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Barang..." required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" id="harga" name="harga" class="form-control" placeholder="Harga..." required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" min="0" id="stok" class="form-control" name="stok" placeholder="Stok..." required>
                        <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" min="0" id="diskon" class="form-control" name="diskon" placeholder="Diskon..." required>
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
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

@foreach ($data_barang as $edit_barang)
    <div class="modal fade" id="modalEdit{{ $edit_barang->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="post" action="/barang/update/{{ $edit_barang->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group mb-2">
                            <label for="id_jenis_barang">Jenis Barang</label>
                            <select id="id_jenis_barang" class="form-control" name="id_jenis_barang" required>
                                @foreach($data_jenis_barang as $data)
                                <option  <?php if($data->id == $edit_barang->jenis_barang->id) echo 'selected'; ?> value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="from-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" value="{{ $edit_barang->nama }}" id="nama" class="form-control" name="nama" placeholder="Nama Barang..." required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" value="{{ $edit_barang->harga }}" min="0" id="harga" name="harga" class="form-control" placeholder="Harga..." required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" value="{{ $edit_barang->stok }}" min="0" id="stok" class="form-control" name="stok" placeholder="Stok..." required>
                            <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" value="{{ $edit_barang->diskon }}" min="0" id="diskon" class="form-control" name="diskon" placeholder="Diskon..." required>
                            <div class="input-group-append"><span class="input-group-text">%</span></div>
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

@foreach ($data_barang as $del_barang)
    <div class="modal fade" id="modalHapus{{ $del_barang->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="get" action="/barang/destroy/{{ $del_barang->id }}">
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
