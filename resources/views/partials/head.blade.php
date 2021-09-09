    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Jalur Rempah Nusantara">

    @if( Request::segment(1) == null )
    <!-- HALAMAN HOME -->
    <meta name="description" content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI.">
    <meta name="keywords" content="rempah, kemdikbud, kemendikbud">
    <!-- END HALAMAN HOME -->
    @elseif(Request::segment(1) == "tentang-jalur")

    <!-- HALAMAN JALUR -->
    <meta name="description" content="Memperkuat jejaring interaksi budaya antar daerah yang telah diikat dengan jalur budaya rempah sejak ribuan tahun lalu.">
    <meta name="keywords" content="jalur">
    <!-- END HALAMAN JALUR -->

    @elseif(Request::segment(1) == "tentang-jejak")
    <!-- HALAMAN JEJAK -->
    <meta name="description" content="Meningkatkan kesadaran masyarakat dalam melestarikan, mengembangkan & memanfaatkan jejak warisan budaya Jalur Rempah.">
    <meta name="keywords" content="jejak">
    <!-- END HALAMAN JEJAK -->

    @elseif(Request::segment(1) == "tentang-masa-depan")
    <!-- HALAMAN MASA DEPAN -->
    <meta name="description" content="Melihat Jalur Rempah dalam persepsi masyarakat terkait peran Indonesia di masa lalu dan potensinya di masa depan.">
    <meta name="keywords" content="masa depan">
    <!-- END HALAMAN MASA DEPAN -->

    @elseif(Request::segment(1) == "konten")
    <!-- HALAMAN KONTEN -->
    <meta name="description" content="Dapatkan berbagai konten menarik mengenai Program Jalur Rempah seperti artikel, foto, video, audio, hinggap publikasi">
    <meta name="keywords" content="">
    <!-- END HALAMAN KONTEN -->

    @elseif(Request::segment(1) == "informasi")
    <!-- HALAMAN INFORMASI -->
    <meta name="description" content="Dapatkan informasi lengkap mengenai Program Jalur Rempah di berbagai wilayah di Indonesia secara daring & luring.">
    <meta name="keywords" content="">
    <!-- END HALAMAN INFORMASI -->

    @endif

    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="id">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="Kemdikbudristek RI">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://metatags.io/">
    <meta property="og:title" content="Jalur Rempah Nusantara">
    <meta property="og:description" content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
    <meta property="og:image" content="{{ asset('assets/img/meta-img.jpg') }}">


    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://metatags.io/">
    <meta property="twitter:title" content="Jalur Rempah Nusantara">
    <meta property="twitter:description" content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
    <meta property="twitter:image" content="{{ asset('assets/img/meta-img.jpg') }}">


    

