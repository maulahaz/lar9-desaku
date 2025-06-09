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
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
            <li class="breadcrumb-item active">{{ $pageTitle }}</li>
          </ol>
        </div><!-- /.col -->
  
      </div><!-- /.row -->
  
      @include('shared.v_msgbox', ['errors'=>$errors])    
  
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <!-- Horizontal Form -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Form {{ $pageTitle }}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('admin.config.update', $config->id) }}" class="form-horizontal" id="frm_update" name="frm_update" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group row">
                <label for="key" class="col-sm-2 col-form-label">Key</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="key" value="{{ $config->key }}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="value" class="col-sm-2 col-form-label">Value</label>
                <div class="col-sm-10">
                  @if($config->type == 'text')
                    <input type="text" class="form-control" id="value" name="value" value="{{ $config->value }}">
                  @elseif($config->type == 'textarea')
                    <textarea class="form-control" id="value" name="value" rows="3">{{ $config->value }}</textarea>
                  @elseif($config->type == 'file')
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="value" name="value">
                        <label class="custom-file-label" for="value">Choose file</label>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="type" value="{{ $config->type }}" readonly>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp;Simpan</button>
              <a href="{{ route('admin.config') }}" class="btn btn-sm btn-default"><i class="fa fa-times"></i>&nbsp;Batal</a>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('t_adminlte3/plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('t_adminlte3/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
@endpush