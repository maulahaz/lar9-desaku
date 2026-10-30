<footer class="footer-area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 single-footer-widget">
        <h4>Tentang Kami</h4>
        <p>Web Desa adalah aplikasi pengelolaan data dan pelayanan administrasi desa yang tertib, transparan, dan
          mudah diakses.</p>
      </div>
      <div class="col-lg-4 col-md-6 single-footer-widget">
        <h4>Menu</h4>
        <ul>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li><a href="{{ url('/#tentang') }}">Tentang Kami</a></li>
          <li><a href="{{ url('/#berita') }}">Berita</a></li>
          <li><a href="{{ url('/#kontak') }}">Hubungi Kami</a></li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-6 single-footer-widget">
        <h4>Alamat</h4>
        <p>{{ optional($alamat)->value ?? '-' }}</p>
        <p>{{ optional($telepon)->value ?? '' }}</p>
      </div>
    </div>
    <div class="row footer-bottom d-flex justify-content-between">
      <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> {{ optional($nmDesa)->value ?? 'Web Desa' }} | This template is made with <i class="ti-heart"
          aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
      <div class="col-lg-4 col-sm-12 footer-social">
        <a href="#"><i class="ti-facebook"></i></a>
        <a href="#"><i class="ti-twitter"></i></a>
        <a href="#"><i class="ti-dribbble"></i></a>
        <a href="#"><i class="ti-linkedin"></i></a>
      </div>
    </div>
  </div>
</footer>
