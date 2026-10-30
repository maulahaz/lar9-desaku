<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    @php
    $navLogo = \App\Models\Config::where('key', 'logo')->first();
    $navLogoPath = $navLogo ? 'images/' . $navLogo->value : 'images/logo.png';
    @endphp
    <a class="navbar-brand logo_h" href="{{ url('/') }}">
      <img src="{{ url($navLogoPath) }}" style="width:200px" alt="Logo Desa" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar"></span> <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
      <ul class="nav navbar-nav menu_nav ml-auto">
        <li class="nav-item {{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/#tentang') }}">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/#visi-misi') }}">Visi &amp; Misi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/#berita') }}">Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/#kontak') }}">Hubungi Kami</a>
        </li>
        @if(!Auth::check())
        <li class="nav-item">
          <a href="{{ url('login') }}" class="nav-link">
            <i class="ti-user"></i>&nbsp;&nbsp;Login
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('register') }}" class="nav-link">
            <i class="ti-pencil-alt"></i>&nbsp;&nbsp;Daftar
          </a>
        </li>
        @else
        <li class="nav-item submenu dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false"><i class="ti-user"></i>&nbsp;&nbsp;{{ Auth::user()->name ?? Auth::user()->username }}</a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('account/dashboard') }}"><i class="ti-dashboard"></i>&nbsp;&nbsp;Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('account/profile') }}"><i class="ti-heart"></i>&nbsp;&nbsp;Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('logout') }}"><i class="ti-direction"></i>&nbsp;&nbsp;Keluar</a>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
