@extends('templates/adminlte/v_admin')
@section('content')

<?php $loggedinInfo = auth()->user(); ?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('account/dashboard') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a href="{{ url('admin/user') }}">Pengguna</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        @include('shared.v_msgbox', ['errors' => $errors])
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              @if(!empty($dtUser->foto))
              <img class="profile-user-img img-fluid img-circle" src="{{ url('uploads/user/' . $dtUser->foto) }}"
                alt="Foto Pengguna">
              @else
              <img class="profile-user-img img-fluid img-circle" src="{{ url('images/noimage.jpg') }}"
                alt="Foto Pengguna">
              @endif
            </div>
            <h3 class="profile-username text-center mt-3">{{ $dtUser->nama }}</h3>
            <p class="text-muted text-center">{{ $dtUser->role }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Status</b>
                <span class="float-right">
                  @if($dtUser->is_delete === 'Y')
                  <span class="badge badge-danger">Tidak Aktif</span>
                  @else
                  <span class="badge badge-success">Aktif</span>
                  @endif
                </span>
              </li>
              <li class="list-group-item">
                <b>Bergabung</b>
                <span class="float-right">{{ $dtUser->created_at }}</span>
              </li>
            </ul>
            <a href="{{ url('admin/user/' . $dtUser->id_pengguna . '/edit') }}" class="btn btn-warning btn-block"><i
                class="fa fa-edit"></i>&nbsp;Edit Data</a>
            <a href="{{ url('admin/user/reset-password/' . $dtUser->id_pengguna) }}"
              class="btn btn-outline-danger btn-block confirmReset"><i class="fa fa-key"></i>&nbsp;Reset Password</a>
            <a href="{{ url('admin/user') }}" class="btn btn-default btn-block"><i
                class="fa fa-arrow-left"></i>&nbsp;Kembali ke List</a>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Data Pengguna</h3>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th style="width: 200px;">NIK</th>
                  <td>{{ $dtUser->nik }}</td>
                </tr>
                <tr>
                  <th>Nama Lengkap</th>
                  <td>{{ $dtUser->nama }}</td>
                </tr>
                <tr>
                  <th>User ID</th>
                  <td>{{ $dtUser->nama_pengguna }}</td>
                </tr>
                <tr>
                  <th>No. Telepon</th>
                  <td>{{ $dtUser->no_telepon ?: '-' }}</td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>{{ $dtUser->role }} ({{ $dtUser->role_id }})</td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>{{ $dtUser->is_delete === 'Y' ? 'Tidak Aktif' : 'Aktif' }}</td>
                </tr>
                <tr>
                  <th>Terakhir Diupdate</th>
                  <td>{{ $dtUser->updated_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  $('.confirmReset').click(function(e){
      if(!confirm('Reset password pengguna ini menjadi "pass123"?')){
          e.preventDefault();
      }
  });
</script>
@endpush

@endsection
