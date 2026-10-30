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
          <li class="breadcrumb-item"><a href="{{ url('admin/user') }}">Pengguna</a></li>
          <li class="breadcrumb-item active">{{ $dtUser ? 'Edit' : 'Tambah' }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->

    @include('shared.v_msgbox', ['errors' => $errors])

  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Form {{ $pageTitle }}</h3>
          </div>
          <!-- /.card-header -->

          @if($dtUser)
          <form class="form-horizontal myform" action="{{ url('admin/user/' . $dtUser->id_pengguna) }}" method="POST">
            @method('PUT')
            @else
            <form class="form-horizontal myform" action="{{ url('admin/user') }}" method="POST">
              @endif
              @csrf

              <div class="card-body">
                <div class="form-group row">
                  <label for="nik" class="col-sm-2 col-form-label">NIK <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nik" name="nik" maxlength="20"
                      value="{{ old('nik', $dtUser->nik ?? '') }}" placeholder="Nomor Induk Kependudukan"
                      {{ $dtUser ? 'readonly' : 'required' }}>
                    @if($dtUser)
                    <small class="text-muted">NIK tidak dapat diubah.</small>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" maxlength="50"
                      value="{{ old('nama', $dtUser->nama ?? '') }}" placeholder="Nama lengkap" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="nama_pengguna" class="col-sm-2 col-form-label">User ID <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" maxlength="50"
                      value="{{ old('nama_pengguna', $dtUser->nama_pengguna ?? '') }}" placeholder="User ID untuk login"
                      required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" maxlength="20"
                      value="{{ old('no_telepon', $dtUser->no_telepon ?? '') }}" placeholder="No. Telepon">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="role_id" class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="role_id" name="role_id" required>
                      <option value="">-- Pilih Role --</option>
                      @foreach([1 => 'Staf', 2 => 'Supervisor', 3 => 'Warga', 88 => 'Administrator'] as $idRole => $nmRole)
                      <option value="{{ $idRole }}" {{ (string) old('role_id', $dtUser->role_id ?? '') === (string) $idRole ? 'selected' : '' }}>
                        {{ $nmRole }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                @if(!$dtUser)
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" minlength="6"
                      placeholder="Minimal 6 karakter" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password_confirmation" class="col-sm-2 col-form-label">Ulangi Password <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                      minlength="6" placeholder="Ulangi password" required>
                  </div>
                </div>
                @else
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <a href="{{ url('admin/user/reset-password/' . $dtUser->id_pengguna) }}"
                      class="btn btn-sm btn-outline-danger confirmReset"><i class="fa fa-key"></i>&nbsp;Reset Password ke
                      "pass123"</a>
                  </div>
                </div>
                @endif
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{ url('admin/user') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
                <button type="submit" class="btn btn-info float-right"><i class="fa fa-save"></i>&nbsp;Simpan</button>
              </div>
              <!-- /.card-footer -->
            </form>
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
