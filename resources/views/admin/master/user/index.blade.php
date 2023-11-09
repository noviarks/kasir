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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach($data_user as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->role }}</td>
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
            <form method="post" action="/user/store">
                @csrf
                <div class="modal-body">
                    <div class="from-group mb-2">
                        <label for="name">Nama</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name..." required>
                    </div>
                    <div class="from-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Email..." required>
                    </div>
                    <div class="from-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password..." required>
                    </div>
                    <div class="from-group mb-2">
                        <label for="role">Role</label>
                        <select id="role" class="form-control" name="role" required>
                            <option value="" hidden>--Pilih Role--</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
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

@foreach ($data_user as $edit_user)
    <div class="modal fade" id="modalEdit{{ $edit_user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="post" action="/user/update/{{ $edit_user->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group mb-2">
                            <label for="name">Nama</label>
                            <input type="text" value="{{ $edit_user->name }}" id="name" class="form-control" name="name" placeholder="Name..." required>
                        </div>
                        <div class="from-group mb-2">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $edit_user->email }}" id="email" class="form-control" name="email" placeholder="Email..." required>
                        </div>
                        <div class="from-group mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
                        </div>
                        <div class="from-group mb-2">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option <?php if($edit_user->role == 'admin') echo 'selected'; ?> value="admin">Admin</option>
                                <option <?php if($edit_user->role == 'kasir') echo 'selected'; ?> value="kasir">Kasir</option>
                            </select>
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

@foreach ($data_user as $del_user)
    <div class="modal fade" id="modalHapus{{ $del_user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="get" action="/user/destroy/{{ $del_user->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="from-group">
                            <h5>Apakah Anda Ingin Menghapus Data Ini?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Tidak</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection