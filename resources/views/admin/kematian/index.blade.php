@extends('templates/adminlte/v_admin')
@section('content')

@php
use Carbon\Carbon;
@endphp

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
                <div class="card card-primary card-outline">

                    <div class="card-header">
                        <a href="{{ route('admin.kematian.create') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                        <div class="card-tools">
                            <form action="{{ route('admin.kematian.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari.." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <a href="{{ route('admin.kematian.index', ['reset' => true]) }}"
                                    class="btn btn-sm btn-default">Reset</a>
                            </form>
                        </div>
                    </div>



                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kematian.index', ['sort' => 'nik', 'direction' => ($sort === 'nik' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            NIK
                                            @if ($sort === 'nik')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kematian.index', ['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Nama
                                            @if ($sort === 'nama')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kematian.index', ['sort' => 'tanggal_kematian', 'direction' => ($sort === 'tanggal_kematian' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Tanggal Kematian
                                            @if ($sort === 'tanggal_kematian')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kematians as $kematian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kematian->nik }}</td>
                                    <td>{{ $kematian->nama }}</td>
                                    <td>{{ Carbon::parse($kematian->tanggal_kematian)->format('d-M-y').'
                                        '.Carbon::parse($kematian->waktu_kematian)->format('H:m')}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.kematian.show', $kematian->id) }}"
                                            class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.kematian.edit', $kematian->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin.kematian.destroy', $kematian->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data kematian.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $kematians->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection