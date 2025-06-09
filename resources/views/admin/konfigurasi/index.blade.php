@extends('templates/adminlte/v_admin')

@section('content')
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
            {{-- <h3 class="card-title">{{ $pageTitle }}</h3> --}}
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Cari..">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($configs as $index => $config)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $config->description }}</td>
                  <td>{{ $config->value }}</td>
                  <td>{{ $config->type }}</td>
                  <td>
                    <a href="{{ route('admin.config.edit', $config->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a>
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