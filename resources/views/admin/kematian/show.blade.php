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
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Data Kematian</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">NIK</th>
                                <td>{{ $kematian->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $kematian->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $kematian->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $kematian->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $kematian->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $kematian->agama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $kematian->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kematian</th>
                                <td>{{ $kematian->tanggal_kematian }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Kematian</th>
                                <td>{{ $kematian->waktu_kematian }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Kematian</th>
                                <td>{{ $kematian->tempat_kematian }}</td>
                            </tr>
                            <tr>
                                <th>Sebab Kematian</th>
                                <td>{{ $kematian->sebab_kematian }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $kematian->pendidikan }}</td>
                            </tr>
                            <tr>
                                <th>Profesi</th>
                                <td>{{ $kematian->profesi }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td>{{ $kematian->ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $kematian->ibu }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.kematian.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('admin.kematian.edit', $kematian->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection