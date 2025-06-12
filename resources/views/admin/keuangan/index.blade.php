@extends('templates/adminlte/v_admin')
@section('content')

@php
use Carbon\Carbon;
use Illuminate\Support\Str;

$loggedinInfo = auth()->user();
@endphp

<!-- content-header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('account/dashboard')}}">Beranda</a></li>
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        @if($loggedinInfo->role_id == 88)
                        <!-- 4 Code for Secretary, a person who can add data keuangan -->
                        <a href="{{ url('/admin/keuangan/create') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                        @endif
                        <div class="card-tools">
                            <form action="{{ route('admin.keuangan.index') }}" method="GET" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari.." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <a href="{{ route('admin.keuangan.index', ['reset' => true]) }}"
                                    class="btn btn-sm btn-default">Reset</a>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>
                                            <a
                                                href="{{ route('admin.keuangan.index', ['sort' => 'tanggal', 'direction' => $direction == 'asc' && $sort == 'tanggal' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                                Tanggal
                                                @if($sort == 'tanggal')
                                                <i class="fas fa-sort-{{ $direction == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a
                                                href="{{ route('admin.keuangan.index', ['sort' => 'jenis', 'direction' => $direction == 'asc' && $sort == 'jenis' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                                Jenis
                                                @if($sort == 'jenis')
                                                <i class="fas fa-sort-{{ $direction == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a
                                                href="{{ route('admin.keuangan.index', ['sort' => 'kategori', 'direction' => $direction == 'asc' && $sort == 'kategori' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                                Kategori
                                                @if($sort == 'kategori')
                                                <i class="fas fa-sort-{{ $direction == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a
                                                href="{{ route('admin.keuangan.index', ['sort' => 'jumlah', 'direction' => $direction == 'asc' && $sort == 'jumlah' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                                Jumlah
                                                @if($sort == 'jumlah')
                                                <i class="fas fa-sort-{{ $direction == 'asc' ? 'up' : 'down' }}"></i>
                                                @else
                                                <i class="fas fa-sort"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @php
                                    $perPage = $keuangans->perPage();
                                    $currentPage = $keuangans->currentPage();
                                    $no = ($currentPage - 1) * $perPage + 1;
                                    @endphp
                                    @forelse($keuangans as $keuangan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ Carbon::parse($keuangan->tanggal)->format('d-M-y') }}</td>
                                        <td>{{ $keuangan->jenis }}</td>
                                        <td>{{ $keuangan->kategori }}</td>
                                        <td>{{ number_format($keuangan->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ Str::limit($keuangan->keterangan, 50) }}</td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('admin.keuangan.show', $keuangan->id) }}"
                                                class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> --}}
                                            <a href="{{ route('admin.keuangan.edit', $keuangan) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.keuangan.destroy', $keuangan) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                {{-- {{ $keuangans->links() }} --}}
                                {{-- {{ $keuangans->appends(request()->except('page'))->links() }} --}}
                                {{ $keuangans->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection