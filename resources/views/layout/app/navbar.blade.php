@php
    $altnav = in_array($info, array("konten", "kegiatan", "foto", "video", "audio", "kerjasama"));
@endphp

@include("layout.app.navbar.desktop")
@include("layout.app.navbar.mobile")
