@extends('templates/adminlte/v_admin')
@section('content')

<?php $loggedinInfo = auth()->user(); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/user')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                </ol>
            </div><!-- /.col -->

        </div><!-- /.row -->

        <div class="row">
            <div class="col-sm-12">
                @include('shared.v_msgbox', ['errors'=>$errors])
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        @if($loggedinInfo->role_id == 88)
                        <!-- 4 Code for Secretary, a person who can add data Penduduk -->
                        <a href="{{ url('/admin/penduduk/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                        <a href="{{ route('admin.penduduk.doc-data-warga') }}" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-file-pdf"></i>&nbsp;Download Data</a>
                        @endif
                        <div class="card-tools">
                            <form action="{{ route('admin.penduduk.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Cari.." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <a href="{{ route('admin.penduduk.index', ['reset' => true]) }}" class="btn btn-sm btn-default">Reset</a>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'nik', 'direction' => ($sort === 'nik' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            NIK
                                            @if ($sort === 'nik')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Nama
                                            @if ($sort === 'nama')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'tempat_lahir', 'direction' => ($sort === 'tempat_lahir' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Tempat Lahir
                                            @if ($sort === 'tempat_lahir')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'tanggal_lahir', 'direction' => ($sort === 'tanggal_lahir' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Tanggal Lahir
                                            @if ($sort === 'tanggal_lahir')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'jenis_kelamin', 'direction' => ($sort === 'jenis_kelamin' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Jenis Kelamin
                                            @if ($sort === 'jenis_kelamin')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'agama', 'direction' => ($sort === 'agama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Agama
                                            @if ($sort === 'agama')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'pendidikan', 'direction' => ($sort === 'pendidikan' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Pendidikan
                                            @if ($sort === 'pendidikan')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.penduduk.index', ['sort' => 'profesi', 'direction' => ($sort === 'profesi' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Profesi
                                            @if ($sort === 'profesi')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @php
                                $perPage = $penduduks->perPage();
                                $currentPage = $penduduks->currentPage();
                                $no = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                @foreach($penduduks as $penduduk)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $penduduk->nik }}</td>
                                    <td>{{ $penduduk->nama }}</td>
                                    <td>{{ $penduduk->tempat_lahir }}</td>
                                    <td>{{ $penduduk->tanggal_lahir }}</td>
                                    <td>{{ $penduduk->jenis_kelamin }}</td>
                                    <td>{{ $penduduk->agama }}</td>
                                    <td>{{ $penduduk->pendidikan }}</td>
                                    <td>{{ $penduduk->profesi }}</td>
                                    <td>
                                        <a href="{{ route('admin.penduduk.show', $penduduk->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                        <form action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this penduduk?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            <!-- {{ $penduduks->links() }} -->
                            {{ $penduduks->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script src="{{url('js/mhz_script.js')}}"></script>
@endpush

@endsection