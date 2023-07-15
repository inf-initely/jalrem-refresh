<!doctype html>
<html lang="en" id="home">

<head>
    @include('partials.head')
    @include('partials.style')
    @if (Session::get('lg') == 'en')
        @if (Request::segment(1) == null)
            <title>Home - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-jalur')
            <title>Routes - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-jejak')
            <title>The Traces of Spice Routes - Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-masa-depan')
            <title>Future - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == 'konten')
            <title>Contents - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == 'informasi')
            <title>Information - The Spice Routes Indonesia</title>
        @endif
    @else
        @if (Request::segment(1) == null)
            <title>Beranda - Jalur Rempah Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-jalur')
            <title>Jalur Rempah Nusantara Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-jejak')
            <title>Jejak Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == 'tentang-masa-depan')
            <title>Masa Depan - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == 'konten')
            <title>Konten - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == 'informasi')
            <title>Informasi - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @endif
    @endif
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
</head>

<body>
    @include('partials.navbar')
    @include('sweetalert::alert')
    @yield('content')
    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true"
        style="background-color: rgba(0,0,0,.6);">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-search">
            <div class="modal-content modal-body-search">
                <div class="modal-body">
                    <div class="mb-3">
                        <form class="input-group" action="{{ url('/cari') }}">
                            <input type="text" name="search" class="form-control form-control-lg"
                                placeholder="Cari disini...." aria-describedby="btnCari">
                            <button type="submit" class="btn btn-lg btn-danger" type="button" id="btnCari"> <i
                                    class="fa fa-search mr-2"></i> Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
    @include('partials.footer')
</body>
@yield('js')

</html>
