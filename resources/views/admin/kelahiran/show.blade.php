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
                        <h3 class="card-title">Detail Kelahiran</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $kelahiran->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $kelahiran->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $kelahiran->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Jam Lahir</th>
                                <td>{{ $kelahiran->jam_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $kelahiran->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Panjang (cm)</th>
                                <td>{{ $kelahiran->panjang }}</td>
                            </tr>
                            <tr>
                                <th>Berat (kg)</th>
                                <td>{{ $kelahiran->berat }}</td>
                            </tr>
                            <tr>
                                <th>Ayah</th>
                                <td>{{ $kelahiran->ayah }}</td>
                            </tr>
                            <tr>
                                <th>Ibu</th>
                                <td>{{ $kelahiran->ibu }}</td>
                            </tr>
                            <tr>
                                <th>Anak Ke-</th>
                                <td>{{ $kelahiran->anak_ke }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelahiran</th>
                                <td>{{ $kelahiran->jenis_kelahiran }}</td>
                            </tr>
                            <tr>
                                <th>Penolong Kelahiran</th>
                                <td>{{ $kelahiran->penolong_kelahiran }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.kelahiran.edit', $kelahiran->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.kelahiran.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection