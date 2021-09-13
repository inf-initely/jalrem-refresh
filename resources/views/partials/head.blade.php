    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if( Session::get('lg') == 'en' )
        <meta name="language" content="en">

        @if( Request::segment(1) == null )
        <!-- HALAMAN HOME -->
        <meta name="title" content="Home - The Spice Routes Indonesia">
        <meta name="description" content="The Spice Routes program aims to respect the past through heritage, enlivening the future for the well-being of all. ">
        <meta name="keywords" content="spices,spice routes,spice routes map,the spice routes,spice routes globalization,spice trade,spice trade routes">
        <!-- END HALAMAN HOME -->

        @elseif(Request::segment(1) == "tentang-jalur")
        <!-- HALAMAN JALUR -->
        <meta name="title" content="Routes - The Spice Routes Indonesia">
        <meta name="description" content="The spice trade routes cover various cultural routes from one point to another that gave rise to global civilization">
        <meta name="keywords" content="trade routes,trade routes humankind,the trade routes,ancient routes,ancient trade routes">
        <!-- END HALAMAN JALUR -->

        @elseif(Request::segment(1) == "tentang-jejak")
        <!-- HALAMAN JEJAK -->
        <meta name="title" content="The Traces of Spice Routes - Indonesia">
        <meta name="description" content="The traces of spice routes display the cultural interactions in the past that still exist today in various mediums.">
        <meta name="keywords" content="ancient traces,ancient traces">
        <!-- END HALAMAN JEJAK -->

        @elseif(Request::segment(1) == "tentang-masa-depan")
        <!-- HALAMAN MASA DEPAN -->
        <meta name="title" content="Future - The Spice Routes Indonesia">
        <meta name="description" content="A means of reconstruction and revitalization through the sea as a symbol of wealth and prosperity.">
        <meta name="keywords" content="present future,past present future,global future">
        <!-- END HALAMAN MASA DEPAN -->

        @elseif(Request::segment(1) == "konten")
        <!-- HALAMAN KONTEN -->
        <meta name="title" content="Contents - The Spice Routes Indonesia">
        <meta name="description" content="Follow various exciting contents about the Spice Routes through the articles, photos, videos, and audio.">
        <meta name="keywords" content="contents articles,contents photos,contents videos">
        <!-- END HALAMAN KONTEN -->

        @elseif(Request::segment(1) == "informasi")
        <!-- HALAMAN INFORMASI -->
        <meta name="title" content="Information - The Spice Routes Indonesia">
        <meta name="description" content="Find out numerous information about the Spice Routes program from different areas in Indonesia, both online and offline.">
        <meta name="keywords" content="">
        <!-- END HALAMAN INFORMASI -->

        @endif
        @else
            <meta name="language" content="id">
            @if( Request::segment(1) == null )
            <!-- HALAMAN HOME -->
            <meta name="title" content="Beranda - Jalur Rempah Rempah Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Program yang bertujuan melihat warisan rempah rempah masa lalu, menghidupkan masa depan, demi kesejahteraan bersama.">
            <meta name="keywords" content="rempah rempah,rempah rempah indonesia,rempah rempah adalah,jenis rempah rempah,manfaat rempah rempah">
            <!-- END HALAMAN HOME -->
            @elseif(Request::segment(1) == "tentang-jalur")

            <!-- HALAMAN JALUR -->
            <meta name="title" content="Jalur Rempah Nusantara Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Jalur Rempah mencakup jalur budaya yang melahirkan peradaban global & menghidupkan kembali peran masyarakat Nusantara.">
            <meta name="keywords" content="jalur rempah nusantara,jalur rempah indonesia,jalur rempah kemdikbud">
            <!-- END HALAMAN JALUR -->

            @elseif(Request::segment(1) == "tentang-jejak")
            <!-- HALAMAN JEJAK -->
            <meta name="title" content="Jejak Jalur Rempah Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Jejak perdagangan rempah masa lalu memperlihatkan interaksi & peninggalan nilai budaya yang masih hidup hingga hari ini">
            <meta name="keywords" content="jejak peninggalan,peninggalan,warisan,warisan budaya">
            <!-- END HALAMAN JEJAK -->

            @elseif(Request::segment(1) == "tentang-masa-depan")
            <!-- HALAMAN MASA DEPAN -->
            <meta name="title" content="Masa Depan - Jalur Rempah Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Sebuah upaya rekontruksi dan revitalisasi jalur budaya bahari. Penggalian kembali potensi masa depan Indonesia.">
            <meta name="keywords" content="masa depan,masa depan indonesia,masa depan bangsa indonesia">
            <!-- END HALAMAN MASA DEPAN -->

            @elseif(Request::segment(1) == "konten")
            <!-- HALAMAN KONTEN -->
            <meta name="title" content="Konten - Jalur Rempah Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Simak berbagai konten menarik mengenai Jalur Rempah, seperti artikel, foto, video, audio, hingga publikasi.">
            <meta name="keywords" content="konten artikel,konten foto,konten video,konten menarik">
            <!-- END HALAMAN KONTEN -->

            @elseif(Request::segment(1) == "informasi")
            <!-- HALAMAN INFORMASI -->
            <meta name="title" content="Informasi - Jalur Rempah Kemdikbudristek Republik Indonesia">
            <meta name="description" content="Simak informasi lengkap mengenai Jalur Rempah di berbagai wilayah di Indonesia secara daring & luring.">
            <meta name="keywords" content="informasi indonesia,informasi indonesia saat ini">
            <!-- END HALAMAN INFORMASI -->

            @endif
    @endif

    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="Kemdikbudristek RI">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jalur Rempah Nusantara">
    <meta property="og:description" content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
    <meta property="og:image" content="{{ asset('assets/img/meta-img.jpg') }}">


    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Jalur Rempah Nusantara">
    <meta property="twitter:description" content="Jalur Rempah adalah jalur budaya untuk pengembangan budaya bahari & literasi maritim diinisiasi oleh Kemdikbudristek RI">
    <meta property="twitter:image" content="{{ asset('assets/img/meta-img.jpg') }}">


    

