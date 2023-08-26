@php
    function notEmpty($c) {
        return $c !== null && $c !== "" && is_string($c);
    }
@endphp

@include('layout.app.head.gtag')
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="language" content="{{ $lang }}">

@if (isset($metadata))
    @if (isset($metadata["description"]) && notEmpty($metadata["description"]))
        <meta name="description" content="{{$metadata["description"]}}">
    @endif

    @if (isset($metadata["keywords"]) && notEmpty($metadata["keywords"]))
        <meta name="keywords" content="{{$metadata["keywords"]}}">
    @endif

    @if (isset($metadata["meta:title"]) && $metadata["meta:title"] === false)

    @elseif (isset($metadata["meta:title"]) && notEmpty($metadata["meta:title"]))
        <meta name="title" content="{{$metadata["meta:title"]}}">
    @elseif (isset($metadata["title"]) && notEmpty($metadata["title"]))
        <meta name="title" content="{{$metadata["title"]}}">
    @else
        <meta name="title" content="{{__("common.title")}}">
    @endif
@endif

@yield('meta')

<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="revisit-after" content="2 days">
<meta name="author" content="{{__("Ministry of Education, Culture, Research, and Technology of the Republic of Indonesia")}}">

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
