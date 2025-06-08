@extends('templates/adminlte/v_admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
          <li class="breadcrumb-item active">{{ $pageTitle }}</li>
        </ol>
      </div><!-- /.col -->

    </div><!-- /.row -->

    @include('shared.v_msgbox', ['errors'=>$errors])    

  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Form {{ $pageTitle }}</h3>
          </div>
          <!-- /.card-header -->
          @if (isset($penduduk) && $penduduk->id)
            <form action="{{ route('admin.penduduk.update', $penduduk->id) }}" class="form-horizontal" id="frm_update" name="frm_update" method="POST">
              @method('PATCH')
          @else
            <form id="frm_create" name="frm_create" action="{{ route('admin.penduduk.store') }}" method="POST" class="form-horizontal">  
          @endif

          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" value="{{ old('nik', $penduduk->nik ?? '') }}" placeholder="Masukkan NIK">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" value="{{ old('nama', $penduduk->nama ?? '') }}" placeholder="Masukkan Nama">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tempat Lahir</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}" placeholder="Masukkan Tempat Lahir">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ?? '') }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jenis_kelamin">
                  <option value="L" {{ (old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ (old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat">{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-save"></i>&nbsp;Simpan</button>
            <a href="{{ route('admin.penduduk.index') }}" class="btn btn-sm btn-default"><i class="fa fa-times"></i>&nbsp;Batal</a>
          </div>
          <!-- /.card-footer -->
        </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>
@stop