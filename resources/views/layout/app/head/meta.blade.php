@include('layout.app.head.gtag')
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="language" content="{{ $lang }}">

@hasSection("meta_info")
    <meta name="title" content="{{ __('meta.' . $info . '.title') }}">
    <meta name="description" content="{{ __('meta.' . $info . '.description') }}">
    <meta name="keywords" content="{{ __('meta.' . $info . '.keywords') }}">
@endif

@yield('meta')

<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="revisit-after" content="2 days">
<meta name="author" content="Kemdikbudristek RI">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:title" content="Jalur Rempah Nusantara">
<meta property="og:description"
    content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
<meta property="og:image" content="{{ asset('assets/img/meta-img.jpg') }}">


<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:title" content="Jalur Rempah Nusantara">
<meta property="twitter:description"
    content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
<meta property="twitter:image" content="{{ asset('assets/img/meta-img.jpg') }}">
