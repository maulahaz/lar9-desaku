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
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($kematian->id) ? 'Edit' : 'Tambah' }} Data Kematian</h3>
                    </div>
                    <form action="{{ isset($kematian->id) ? route('admin.kematian.update', $kematian->id) : route('admin.kematian.store') }}" method="POST">
                        @csrf
                        @if(isset($kematian->id))
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $kematian->nik ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kematian->nama ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" {{ (old('jenis_kelamin', $kematian->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ (old('jenis_kelamin', $kematian->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $kematian->tanggal_lahir ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $kematian->tempat_lahir ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="agama">Agama</label>
                                                                    <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $kematian->agama ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $kematian->alamat ?? '') }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_kematian">Tanggal Kematian</label>
                                                                    <input type="date" class="form-control" id="tanggal_kematian" name="tanggal_kematian" value="{{ old('tanggal_kematian', $kematian->tanggal_kematian ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="waktu_kematian">Waktu Kematian</label>
                                                                    <input type="time" class="form-control" id="waktu_kematian" name="waktu_kematian" value="{{ old('waktu_kematian', $kematian->waktu_kematian ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tempat_kematian">Tempat Kematian</label>
                                                                    <input type="text" class="form-control" id="tempat_kematian" name="tempat_kematian" value="{{ old('tempat_kematian', $kematian->tempat_kematian ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="sebab_kematian">Sebab Kematian</label>
                                                                    <input type="text" class="form-control" id="sebab_kematian" name="sebab_kematian" value="{{ old('sebab_kematian', $kematian->sebab_kematian ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pendidikan">Pendidikan</label>
                                                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $kematian->pendidikan ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="profesi">Profesi</label>
                                                                    <input type="text" class="form-control" id="profesi" name="profesi" value="{{ old('profesi', $kematian->profesi ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ayah">Nama Ayah</label>
                                                                    <input type="text" class="form-control" id="ayah" name="ayah" value="{{ old('ayah', $kematian->ayah ?? '') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ibu">Nama Ibu</label>
                                                                    <input type="text" class="form-control" id="ibu" name="ibu" value="{{ old('ibu', $kematian->ibu ?? '') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                <a href="{{ route('admin.kematian.index') }}" class="btn btn-secondary">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    
                                    @endsection