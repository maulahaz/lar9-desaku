@extends('templates/adminlte/v_admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('account/dashboard') }}">Beranda</a></li>
          <li class="breadcrumb-item active">{{ $pageTitle }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-sm-12">
        @include('shared.v_msgbox', ['errors' => $errors])
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ number_format($jumlahPenduduk, 0, ',', '.') }}</h3>
            <p>Total Penduduk</p>
          </div>
          <div class="icon"><i class="fas fa-users"></i></div>
          @if($canManage)
          <a href="{{ url('admin/penduduk') }}" class="small-box-footer">Lihat data <i
              class="fas fa-arrow-circle-right"></i></a>
          @else
          <span class="small-box-footer">&nbsp;</span>
          @endif
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ number_format($jumlahKeluarga, 0, ',', '.') }}</h3>
            <p>Total Keluarga</p>
          </div>
          <div class="icon"><i class="fas fa-home"></i></div>
          <span class="small-box-footer">&nbsp;</span>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ number_format($jumlahKelahiran, 0, ',', '.') }}</h3>
            <p>Data Kelahiran</p>
          </div>
          <div class="icon"><i class="fas fa-baby"></i></div>
          @if($canManage)
          <a href="{{ url('admin/kelahiran') }}" class="small-box-footer">Lihat data <i
              class="fas fa-arrow-circle-right"></i></a>
          @else
          <span class="small-box-footer">&nbsp;</span>
          @endif
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ number_format($jumlahKematian, 0, ',', '.') }}</h3>
            <p>Data Kematian</p>
          </div>
          <div class="icon"><i class="fas fa-user-slash"></i></div>
          @if($canManage)
          <a href="{{ url('admin/kematian') }}" class="small-box-footer">Lihat data <i
              class="fas fa-arrow-circle-right"></i></a>
          @else
          <span class="small-box-footer">&nbsp;</span>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
            <p>Total Pemasukan</p>
          </div>
          <div class="icon"><i class="fas fa-arrow-down"></i></div>
          @if($canManage)
          <a href="{{ url('admin/keuangan') }}" class="small-box-footer">Lihat data <i
              class="fas fa-arrow-circle-right"></i></a>
          @else
          <span class="small-box-footer">&nbsp;</span>
          @endif
        </div>
      </div>

      <div class="col-lg-4 col-12">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
            <p>Total Pengeluaran</p>
          </div>
          <div class="icon"><i class="fas fa-arrow-up"></i></div>
          @if($canManage)
          <a href="{{ url('admin/keuangan') }}" class="small-box-footer">Lihat data <i
              class="fas fa-arrow-circle-right"></i></a>
          @else
          <span class="small-box-footer">&nbsp;</span>
          @endif
        </div>
      </div>

      <div class="col-lg-4 col-12">
        <div class="small-box bg-dark">
          <div class="inner">
            <h3>Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
            <p>Saldo Kas Desa</p>
          </div>
          <div class="icon"><i class="fas fa-wallet"></i></div>
          <span class="small-box-footer">&nbsp;</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Penduduk Terbaru</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pendudukTerbaru as $row)
                <tr>
                  <td>{{ $row->nik }}</td>
                  <td>{{ $row->nama }}</td>
                  <td>{{ $row->jenis_kelamin }}</td>
                  <td>{{ \Illuminate\Support\Str::limit($row->alamat, 40) }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">Belum ada data penduduk.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title">Data Perpindahan</h3>
          </div>
          <div class="card-body">
            <h2 class="mb-1">{{ number_format($jumlahPerpindahan, 0, ',', '.') }}</h2>
            <p class="text-muted mb-3">Total data perpindahan penduduk.</p>
            @if($canManage)
            <a href="{{ url('admin/perpindahan') }}" class="btn btn-sm btn-info"><i class="fas fa-list"></i>&nbsp;Lihat
              Data</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
