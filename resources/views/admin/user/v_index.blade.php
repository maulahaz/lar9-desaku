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
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            @if($loggedinInfo->role_id == 88)
            <a href="{{ url('/admin/user/create') }}" class="btn btn-sm btn-primary"><i
                class="fa fa-plus"></i>&nbsp;Tambah Data</a>
            @endif
            <div class="card-tools">
              <form action="{{ route('admin.user.index') }}" method="GET" class="form-inline">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="search" class="form-control float-right" placeholder="Cari.."
                    value="{{ request('search') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                <a href="{{ route('admin.user.index', ['reset' => true]) }}" class="btn btn-sm btn-default">Reset</a>
              </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Foto</th>
                  <th><a
                      href="{{ route('admin.user.index', ['sort' => 'nama_pengguna', 'direction' => ($sort === 'nama_pengguna' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">User
                      ID
                      @if($sort === 'nama_pengguna')<i
                        class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>@endif</a></th>
                  <th>NIK</th>
                  <th><a
                      href="{{ route('admin.user.index', ['sort' => 'nama', 'direction' => ($sort === 'nama' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">Nama
                      @if($sort === 'nama')<i class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>@endif</a>
                  </th>
                  <th><a
                      href="{{ route('admin.user.index', ['sort' => 'role_id', 'direction' => ($sort === 'role_id' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">Role
                      @if($sort === 'role_id')<i
                        class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>@endif</a></th>
                  <th><a
                      href="{{ route('admin.user.index', ['sort' => 'is_delete', 'direction' => ($sort === 'is_delete' && $direction === 'asc') ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">Status
                      @if($sort === 'is_delete')<i
                        class="fas fa-sort-{{ $direction === 'asc' ? 'up' : 'down' }}"></i>@endif</a></th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($dtUser as $row)
                <tr>
                  <td>{{ $dtUser->firstItem() + $loop->index }}</td>
                  <td>
                    @if(!empty($row->foto))
                    <img class="profile-user-img img-fluid img-circle" src="{{ url('uploads/user/' . $row->foto) }}"
                      alt="Foto" style="width:40px;height:40px;object-fit:cover">
                    @else
                    <img class="profile-user-img img-fluid img-circle" src="{{ url('images/noimage.jpg') }}" alt="Foto"
                      style="width:40px;height:40px;object-fit:cover">
                    @endif
                  </td>
                  <td>{{ $row->nama_pengguna }}</td>
                  <td>{{ $row->nik }}</td>
                  <td>{{ $row->nama }}</td>
                  <td>{{ $row->role }}</td>
                  <td>
                    <a class="updateStatusUser" id="user-{{ $row->id_pengguna }}" user_id="{{ $row->id_pengguna }}"
                      href="javascript:void(0)">
                      {{ $row->is_delete === 'Y' ? 'Inactive' : 'Active' }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="{{ url('/admin/user/' . $row->id_pengguna) }}" class="btn btn-sm btn-info"><i
                        class="fa fa-eye"></i></a>
                    <a href="{{ url('/admin/user/' . $row->id_pengguna . '/edit') }}" class="btn btn-sm btn-warning"><i
                        class="fa fa-edit"></i></a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8" class="text-center">Belum ada data pengguna.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            {{ $dtUser->links() }}
          </div>
        </div><!-- /.card -->
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script src="{{ url('js/mhz_script.js') }}"></script>
@endpush

@endsection
