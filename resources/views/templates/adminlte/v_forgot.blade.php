<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $webTitle }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('t_adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('t_adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('t_adminlte3/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt="Beranda" width="200px"></a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Lupa Password</p>

        <div class="alert alert-info">
          Untuk mereset password, silakan hubungi Administrator desa dengan membawa identitas (KTP). Administrator akan
          mereset password Anda ke password sementara.
        </div>

        <a href="{{ route('login') }}" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i>&nbsp;Kembali
          ke Login</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="{{ url('t_adminlte3/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('t_adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('t_adminlte3/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
