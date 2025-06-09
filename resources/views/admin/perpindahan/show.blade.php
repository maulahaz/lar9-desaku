@extends('templates/adminlte/v_admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/perpindahan') }}">Perpindahan</a></li>
                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Opsi</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('admin/perpindahan') }}" class="btn btn-sm btn-outline-info"><i class="fa fa-chevron-left"></i>&nbsp;List Data</a>
                        <a href="{{ url('admin/perpindahan/'.$perpindahan->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit Data</a>
                        <button type="button" class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modal-delete-{{$perpindahan->id}}"><i class="fa fa-trash"></i>&nbsp;Hapus Data</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Detail</h3>
                    </div>
                    <div class="card-body">
                        <div class="record-details">
                            <dl class="row">
                                <dt class="col-sm-3">NIK</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->nik }}</dd>
                                <dt class="col-sm-3">Nama</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->nama }}</dd>
                                <dt class="col-sm-3">Alamat Asal</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->alamat_asal }}</dd>
                                <dt class="col-sm-3">Alamat Tujuan</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->alamat_tujuan }}</dd>
                                <dt class="col-sm-3">Tanggal Perpindahan</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->tanggal_perpindahan }}</dd>
                                <dt class="col-sm-3">Jenis Perpindahan</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->jenis_perpindahan }}</dd>
                                <dt class="col-sm-3">Sebab Perpindahan</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->sebab_perpindahan }}</dd>
                                <dt class="col-sm-3">Dibuat Oleh</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->created_by }}</dd>
                                <dt class="col-sm-3">Tanggal Dibuat</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->created_at }}</dd>
                                <dt class="col-sm-3">Diupdate Oleh</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->updated_by }}</dd>
                                <dt class="col-sm-3">Terakhir Update</dt>
                                <dd class="col-sm-9">: {{ $perpindahan->updated_at }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Delete -->
<div class="modal fade" id="modal-delete-{{$perpindahan->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <form action="{{ url('admin/perpindahan/'.$perpindahan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection