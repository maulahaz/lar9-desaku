@extends('templates/adminlte/v_admin')
@section('content')

@php
use Carbon\Carbon;
use Illuminate\Support\Str;

$loggedinInfo = auth()->user();
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $pageTitle ?? 'Data Perpindahan' }}</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('account/dashboard')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Perpindahan</li>
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
                        <a href="{{ url('/admin/perpindahan/create') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                        @endif
                        <div class="card-tools">
                            <form action="{{ route('admin.perpindahan.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari.." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <a href="{{ route('admin.perpindahan.index', ['reset' => true]) }}"
                                    class="btn btn-sm btn-default">Reset</a>
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
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'nik', 'direction' => ($sort === 'nik' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            NIK
                                            @if ($sort === 'nik')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Nama
                                            @if ($sort === 'nama')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'tanggal_perpindahan', 'direction' => ($sort === 'tanggal_perpindahan' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Tanggal Pindah
                                            @if ($sort === 'tanggal_perpindahan')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'jenis_perpindahan', 'direction' => ($sort === 'jenis_perpindahan' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Jenis Pindah
                                            @if ($sort === 'jenis_perpindahan')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'alamat_asal', 'direction' => ($sort === 'alamat_asal' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Alamat Asal
                                            @if ($sort === 'alamat_asal')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.perpindahan.index', ['sort' => 'alamat_tujuan', 'direction' => ($sort === 'alamat_tujuan' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Alamat Tujuan
                                            @if ($sort === 'alamat_tujuan')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>

                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $perPage = $perpindahans->perPage();
                                $currentPage = $perpindahans->currentPage();
                                $no = ($currentPage - 1) * $perPage + 1;
                                @endphp
                                @foreach($perpindahans as $perpindahan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $perpindahan->nik }}</td>
                                    <td>{{ $perpindahan->nama }}</td>
                                    <td>{{ Carbon::parse($perpindahan->tanggal_perpindahan)->format('d-M-y') }}</td>
                                    <td>{{ $perpindahan->jenis_perpindahan }}</td>
                                    <td>{{ Str::limit($perpindahan->alamat_asal, 50) }}</td>
                                    <td>{{ Str::limit($perpindahan->alamat_tujuan, 50) }}</td>

                                    <td class="text-center">
                                        <a href="{{ url('/admin/perpindahan/'.$perpindahan->id) }}"
                                            class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.perpindahan.edit', $perpindahan->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.perpindahan.destroy', $perpindahan->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this perpindahan data?')">
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
                            {{ $perpindahans->appends(request()->query())->links() }}
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