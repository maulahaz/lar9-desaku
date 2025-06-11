@extends('templates/adminlte/v_admin')

@section('content')

@php
$loggedinInfo = auth()->user();
@endphp

<!-- Content Header -->
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

            <div class="card-tools">
              <form action="{{ route('admin.config') }}" method="GET" class="form-inline">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="search" class="form-control float-right" placeholder="Cari.."
                    value="{{ request('search') }}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                <a href="{{ route('admin.config', ['reset' => true]) }}" class="btn btn-sm btn-default">Reset</a>
              </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Key</th>
                  <th>Value</th>
                  <th>Type</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($configs as $index => $config)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $config->description }}</td>
                  <td>{{ $config->value }}</td>
                  <td>{{ ucfirst(strtolower($config->type)) }}</td>
                  <td class="text-center">
                    <a href="{{ route('admin.config.edit', $config->id) }}" class="btn btn-sm btn-warning"><i
                        class="fa fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
@endsection

@push('css')
<style>
  .card-primary.card-outline {
    border-top: 3px solid #007bff;
  }
</style>
@endpush

@push('scripts')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endpush