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
                    <li class="breadcrumb-item"><a href="{{ url('admin/keuangan') }}">Keuangan</a></li>
                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
            </div>
        </div>

        @include('shared.v_msgbox', ['errors'=>$errors])

    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form {{ $pageTitle }}</h3>
                    </div>
                    @if (isset($keuangan) && $keuangan->id)
                    <form action="{{ route('admin.keuangan.update', $keuangan->id) }}" class="form-horizontal"
                        id="frm_update" name="frm_update" method="POST">
                        @method('PATCH')
                        @else
                        <form id="frm_create" name="frm_create" action="{{ route('admin.keuangan.store') }}"
                            method="POST" class="form-horizontal">
                            @endif

                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tanggal</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal"
                                                    value="{{ old('tanggal', $keuangan->tanggal ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jenis</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="jenis">
                                                    <option value="Pemasukan" {{ (old('jenis', $keuangan->jenis ?? '')
                                                        == 'Pemasukan') ? 'selected' : '' }}>Pemasukan</option>
                                                    <option value="Pengeluaran" {{ (old('jenis', $keuangan->jenis ?? '')
                                                        == 'Pengeluaran') ? 'selected' : '' }}>Pengeluaran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kategori</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="kategori"
                                                    value="{{ old('kategori', $keuangan->kategori ?? '') }}"
                                                    placeholder="Masukkan Kategori">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="jumlah"
                                                    value="{{ old('jumlah', $keuangan->jumlah ?? '') }}"
                                                    placeholder="Masukkan Jumlah">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="keterangan" rows="3"
                                                    placeholder="Masukkan Keterangan">{{ old('keterangan', $keuangan->keterangan ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">

                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-info"><i
                                        class="fa fa-save"></i>&nbsp;Simpan</button>
                                <a href="{{ route('admin.keuangan.index') }}" class="btn btn-sm btn-default"><i
                                        class="fa fa-times"></i>&nbsp;Batal</a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop