<!--================ Start Beranda Banner Area =================-->
<section class="home_banner_area">
  <div class="banner_inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner_content text-center">
            <p class="text-uppercase">Selamat Datang di</p>
            <h2 class="text-uppercase mt-4 mb-5">
              {{ optional($nmDesa)->value ?? 'Web Desa' }}
            </h2>
            <div>
              <a href="#tentang" class="primary-btn2 mb-3 mb-sm-0">Profil Desa</a>
              @auth
              <a href="{{ url('account/dashboard') }}" class="primary-btn ml-sm-3 ml-0">Dashboard</a>
              @else
              <a href="{{ url('login') }}" class="primary-btn ml-sm-3 ml-0">Login Pengelola</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Beranda Banner Area =================-->

@if(session('error'))
<section class="container mt-3">
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</section>
@endif

<!--================ Start Statistik Area =================-->
<section class="feature_area section_gap_top">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="main_title">
          <h2 class="mb-3">Sekilas Desa</h2>
          <p>Data ringkas kependudukan dan wilayah desa.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="single_feature text-center">
          <div class="icon"><span class="flaticon-student"></span></div>
          <div class="desc">
            <h4 class="mt-3 mb-2">{{ number_format($jumlahPenduduk ?? 0, 0, ',', '.') }}</h4>
            <p>Penduduk</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single_feature text-center">
          <div class="icon"><span class="flaticon-home"></span></div>
          <div class="desc">
            <h4 class="mt-3 mb-2">{{ number_format($jumlahKeluarga ?? 0, 0, ',', '.') }}</h4>
            <p>Keluarga</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single_feature text-center">
          <div class="icon"><span class="flaticon-earth"></span></div>
          <div class="desc">
            <h4 class="mt-3 mb-2">{{ number_format($jumlahDusun ?? 0, 0, ',', '.') }}</h4>
            <p>Dusun</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single_feature text-center">
          <div class="icon"><span class="flaticon-book"></span></div>
          <div class="desc">
            <h4 class="mt-3 mb-2">{{ number_format($luasDesa ?? 0, 0, ',', '.') }} Ha</h4>
            <p>Luas Wilayah</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Statistik Area =================-->

<!--================ Start Tentang Kami Area =================-->
<section class="section_gap" id="tentang">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="main_title">
          <h2 class="mb-3">Tentang Kami</h2>
          <p>Sejarah dan gambaran umum desa.</p>
        </div>
        <div class="text-justify">
          @if(!empty($sejarah))
          {!! $sejarah->content !!}
          @else
          <p>Desa kami merupakan tempat tinggal yang nyaman, aman, dan tertib, di mana masyarakat hidup
            harmonis dalam suasana yang bersih dan tertata rapi.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Tentang Kami Area =================-->

<!--================ Start Visi Misi Area =================-->
<section class="section_gap_top" id="visi-misi">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="main_title">
          <h2 class="mb-3">Visi &amp; Misi</h2>
          <p>Arah pembangunan dan pelayanan desa.</p>
        </div>
        <div class="text-justify">
          @if(!empty($visiMisi))
          {!! $visiMisi->content !!}
          @else
          <p>Visi dan misi desa belum diisi.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Visi Misi Area =================-->

<!--================ Start Berita Area =================-->
<section class="popular_courses" id="berita">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="main_title">
          <h2 class="mb-3">Berita Desa</h2>
          <p>Kabar terbaru dari desa kami.</p>
        </div>
      </div>
    </div>
    <div class="row">
      @forelse($dtBerita as $berita)
      <div class="col-lg-4 col-md-6">
        <div class="single_course">
          <div class="course_head">
            <img class="img-fluid" src="{{ url($berita->gambar) }}" alt="{{ $berita->judul_berita }}"
              onerror="this.src='{{ url('images/noimage.jpg') }}'" style="height:200px;object-fit:cover;width:100%" />
          </div>
          <div class="course_content">
            <span class="tag mb-3 d-inline-block">{{ date('d M Y', strtotime($berita->waktu)) }}</span>
            <h4 class="mb-3">{{ $berita->judul_berita }}</h4>
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 120) }}</p>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <p class="text-center">Belum ada berita.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
<!--================ End Berita Area =================-->

<!--================ Start Kontak Area =================-->
<section class="section_gap" id="kontak">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="main_title">
          <h2 class="mb-3">Hubungi Kami</h2>
          <p>Kirimkan pertanyaan atau pengaduan Anda.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5">
        <div class="single_feature">
          <div class="desc">
            <h4 class="mb-3">Kantor Desa</h4>
            <p><i class="ti-location-pin mr-2"></i>{{ optional($alamat)->value ?? '-' }}</p>
            <p><i class="ti-mobile mr-2"></i>{{ optional($telepon)->value ?? '-' }}</p>
            <p><i class="ti-email mr-2"></i>{{ optional($email)->value ?? '-' }}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form class="form_area" action="{{ route('kontak.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-lg-6 form_group">
              <input name="nama" placeholder="Nama kamu" value="{{ old('nama') }}" required type="text" />
            </div>
            <div class="col-lg-6 form_group">
              <input name="email" placeholder="Alamat Email" value="{{ old('email') }}" type="email" />
            </div>
            <div class="col-lg-12 form_group">
              <textarea name="pesan" rows="4" placeholder="Tulis pesan Anda..." required>{{ old('pesan') }}</textarea>
            </div>
            <div class="col-lg-12 text-center">
              <button class="primary-btn" type="submit">Kirim Pesan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!--================ End Kontak Area =================-->
