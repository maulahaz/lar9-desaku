@php
$icon = \App\Models\Config::where('key', 'icon')->first();
$iconPath = $icon ? "images/".$icon->value : 'images/icon.png';

$nmDesa = \App\Models\Config::where('key', 'nama')->first();
$namaDesa = $nmDesa ? "Web ".$nmDesa->value : 'Web Manajemen Desa';

@endphp
<link rel="icon" href="{{ url($iconPath) }}" type="image/png" />

<title>{{ $namaDesa }}</title>
<link rel="stylesheet" href="{{ url('t_edustage') }}/css/bootstrap.css" />
<link rel="stylesheet" href="{{ url('t_edustage') }}/css/flaticon.css" />
<link rel="stylesheet" href="{{ url('t_edustage') }}/css/themify-icons.css" />
<link rel="stylesheet" href="{{ url('t_edustage') }}/vendors/owl-carousel/owl.carousel.min.css" />
<link rel="stylesheet" href="{{ url('t_edustage') }}/vendors/nice-select/css/nice-select.css" />
<link rel="stylesheet" href="{{ url('t_edustage') }}/css/style.css" />