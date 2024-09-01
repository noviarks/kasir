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
                    @foreach($data_profile as $profile)
                    <form method="post" action="/profile/update/{{ $profile->id }}">
                        @csrf
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                            <div class="from-group mb-2">
                                <label for="name">Nama</label>
                                <input type="text" value="{{ $profile->name }}" id="name" class="form-control" name="name" placeholder="Nama..." required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label for="email">Email</label>
                                        <input type="text" value="{{ $profile->email }}" id="email" class="form-control" name="email" placeholder="Email..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="from-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

@endsection