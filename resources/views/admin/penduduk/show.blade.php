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
                    <li class="breadcrumb-item"><a href="{{ url('admin/penduduk') }}">Penduduk</a></li>
                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-sm-7">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Data Detail</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">NIK</th>
                                <td>{{ $penduduk->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $penduduk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $penduduk->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $penduduk->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $penduduk->agama }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $penduduk->pendidikan }}</td>
                            </tr>
                            <tr>
                                <th>Profesi</th>
                                <td>{{ $penduduk->profesi }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $penduduk->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $penduduk->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('admin/penduduk') }}" class="btn btn-outline-info">Kembali</a>
                        <a href="{{ url('admin/penduduk/'.$penduduk->id.'/edit') }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.penduduk.doc-suket-warga', $penduduk->id) }}" class="btn btn-primary" target="_blank">Lihat Dokumen</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5">
                <!-- CARD GAMBAR -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Gambar</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (empty($penduduk->picture))
                        <div class="text-center"><img class="profile-user-img img-fluid img-circle mb-3" src="{{ url('images/noimage.jpg') }}" alt="Gambar"></div>
                        <p class="text-center">Gambar belum ada.</p>
                        @else
                        <div class="text-center">
                            <p style="width:200px; text-align: center; display: inline-block;">
                                <img src="{{ url('uploads/user/'.$penduduk->picture) }}" alt="picture preview" class="img-fluid">
                            </p>
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection