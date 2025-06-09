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
          @if (isset($perpindahan) && $perpindahan->id)
            <form action="{{ route('admin.perpindahan.update', $perpindahan->id) }}" class="form-horizontal" id="frm_update" name="frm_update" method="POST">
              @method('PATCH')
          @else
            <form id="frm_create" name="frm_create" action="{{ route('admin.perpindahan.store') }}" method="POST" class="form-horizontal">  
          @endif

          {{ csrf_field() }}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">NIK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nik" value="{{ old('nik', $perpindahan->nik ?? '') }}" placeholder="Masukkan NIK">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $perpindahan->nama ?? '') }}" placeholder="Masukkan Nama">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat Asal</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="alamat_asal" rows="3" placeholder="Masukkan Alamat Asal">{{ old('alamat_asal', $perpindahan->alamat_asal ?? '') }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat Tujuan</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="alamat_tujuan" rows="3" placeholder="Masukkan Alamat Tujuan">{{ old('alamat_tujuan', $perpindahan->alamat_tujuan ?? '') }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Perpindahan</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="tanggal_perpindahan" value="{{ old('tanggal_perpindahan', $perpindahan->tanggal_perpindahan ?? '') }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jenis Perpindahan</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="jenis_perpindahan">
                      <option value="Keluar" {{ (old('jenis_perpindahan', $perpindahan->jenis_perpindahan ?? '') == 'Keluar') ? 'selected' : '' }}>Keluar</option>
                      <option value="Masuk" {{ (old('jenis_perpindahan', $perpindahan->jenis_perpindahan ?? '') == 'Masuk') ? 'selected' : '' }}>Masuk</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sebab Perpindahan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="sebab_perpindahan" value="{{ old('sebab_perpindahan', $perpindahan->sebab_perpindahan ?? '') }}" placeholder="Masukkan Sebab Perpindahan">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-save"></i>&nbsp;Simpan</button>
            <a href="{{ route('admin.perpindahan.index') }}" class="btn btn-sm btn-default"><i class="fa fa-times"></i>&nbsp;Batal</a>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
@stop