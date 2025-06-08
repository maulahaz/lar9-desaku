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
                        <h3 class="card-title">{{ isset($kelahiran->id) ? 'Edit' : 'Tambah' }} Data Kelahiran</h3>
                    </div>
                    <form action="{{ isset($kelahiran->id) ? route('admin.kelahiran.update', $kelahiran->id) : route('admin.kelahiran.store') }}" method="POST">
                        @csrf
                        @if(isset($kelahiran->id))
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kelahiran->nama ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $kelahiran->tempat_lahir ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $kelahiran->tanggal_lahir ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jam_lahir">Jam Lahir</label>
                                <input type="time" class="form-control" id="jam_lahir" name="jam_lahir" value="{{ old('jam_lahir', $kelahiran->jam_lahir ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" {{ (old('jenis_kelamin', $kelahiran->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ (old('jenis_kelamin', $kelahiran->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="panjang">Panjang (cm)</label>
                                <input type="number" step="0.1" class="form-control" id="panjang" name="panjang" value="{{ old('panjang', $kelahiran->panjang ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="berat">Berat (kg)</label>
                                <input type="number" step="0.1" class="form-control" id="berat" name="berat" value="{{ old('berat', $kelahiran->berat ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ayah">Ayah</label>
                                <input type="text" class="form-control" id="ayah" name="ayah" value="{{ old('ayah', $kelahiran->ayah ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ibu">Ibu</label>
                                <input type="text" class="form-control" id="ibu" name="ibu" value="{{ old('ibu', $kelahiran->ibu ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="anak_ke">Anak Ke-</label>
                                <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $kelahiran->anak_ke ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelahiran">Jenis Kelahiran</label>
                                <select class="form-control" id="jenis_kelahiran" name="jenis_kelahiran" required>
                                    <option value="Normal" {{ (old('jenis_kelahiran', $kelahiran->jenis_kelahiran ?? '') == 'Normal') ? 'selected' : '' }}>Normal</option>
                                    <option value="Caesar" {{ (old('jenis_kelahiran', $kelahiran->jenis_kelahiran ?? '') == 'Caesar') ? 'selected' : '' }}>Caesar</option>
                                    <option value="Lainnya" {{ (old('jenis_kelahiran', $kelahiran->jenis_kelahiran ?? '') == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="penolong_kelahiran">Penolong Kelahiran</label>
                                <select class="form-control" id="penolong_kelahiran" name="penolong_kelahiran" required>
                                    <option value="Dokter" {{ (old('penolong_kelahiran', $kelahiran->penolong_kelahiran ?? '') == 'Dokter') ? 'selected' : '' }}>Dokter</option>
                                    <option value="Bidan" {{ (old('penolong_kelahiran', $kelahiran->penolong_kelahiran ?? '') == 'Bidan') ? 'selected' : '' }}>Bidan</option>
                                    <option value="Dukun" {{ (old('penolong_kelahiran', $kelahiran->penolong_kelahiran ?? '') == 'Dukun') ? 'selected' : '' }}>Dukun</option>
                                    <option value="Lainnya" {{ (old('penolong_kelahiran', $kelahiran->penolong_kelahiran ?? '') == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ isset($kelahiran->id) ? 'Update' : 'Simpan' }}</button>
                            <a href="{{ route('admin.kelahiran.index') }}" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection