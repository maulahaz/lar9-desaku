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
                        <a href="{{ route('admin.kelahiran.create') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                        <div class="card-tools">
                            <form action="{{ route('admin.kelahiran.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari.." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <a href="{{ route('admin.kelahiran.index', ['reset' => true]) }}"
                                    class="btn btn-sm btn-default">Reset</a>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kelahiran.index', ['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Nama
                                            @if ($sort === 'nama')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kelahiran.index', ['sort' => 'tanggal_lahir', 'direction' => ($sort === 'tanggal_lahir' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Tanggal Lahir
                                            @if ($sort === 'tanggal_lahir')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kelahiran.index', ['sort' => 'jenis_kelamin', 'direction' => ($sort === 'jenis_kelamin' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Jenis Kelamin
                                            @if ($sort === 'jenis_kelamin')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kelahiran.index', ['sort' => 'ayah', 'direction' => ($sort === 'ayah' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Ayah
                                            @if ($sort === 'ayah')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            href="{{ route('admin.kelahiran.index', ['sort' => 'ibu', 'direction' => ($sort === 'ibu' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Ibu
                                            @if ($sort === 'ibu')
                                            <i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = ($kelahirans->currentPage() - 1) * $kelahirans->perPage() + 1;
                                @endphp
                                @foreach($kelahirans as $kelahiran)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kelahiran->nama }}</td>
                                    <td>{{ Carbon::parse($kelahiran->tanggal_lahir)->format('d-M-y') }}</td>
                                    <td>{{ $kelahiran->jenis_kelamin }}</td>
                                    <td>{{ $kelahiran->ayah }}</td>
                                    <td>{{ $kelahiran->ibu }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.kelahiran.show', $kelahiran->id) }}"
                                            class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.kelahiran.edit', $kelahiran->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin.kelahiran.destroy', $kelahiran->id) }}"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $kelahirans->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop