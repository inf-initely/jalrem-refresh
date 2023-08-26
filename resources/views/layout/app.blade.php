@php
    $lang = App::getLocale();
    $info = trim(View::getSection('meta_info', 'default'));
    if(!isset($altnav)) {
        $altnav = false;
    }

    $overrideParameters = isset($parameters) ? $parameters : [
        "id" => Route::current()->parameters(),
        "en" => Route::current()->parameters()
    ];
    $isStub = function ($lang) use ($overrideParameters) {
        if(isset($overrideParameters["stub"])) {
            if(isset($overrideParameters["stub"][$lang])) {
                return true;
            }
        }
        return false;
    };

    $langRoute = function ($old, $new = "id") use ($overrideParameters, $isStub) {
        if($isStub($new)) {
            return route("home.".$new);
        }
        return route(str_replace(".".$old, ".".$new, Route::currentRouteName()), $overrideParameters[$new]);
    };
@endphp

<!doctype html>
<html lang="{{$lang}}" id="home">

<head>
    @include('layout.app.head.meta')
    @include('layout.app.head.style')
    @yield("head")
    @if(isset($metadata) && isset($metadata["title"]))
        <title>{{$metadata["title"]}} | {{__("common.title")}}</title>
    @else
        <title>{{__("common.title")}}</title>
    @endif
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
    @foreach (["id", "en"] as $l)
        @if (!$isStub($l))
            <link rel="alternate" hreflang="{{$l}}" href="{{$langRoute($lang, $l)}}" />
        @endif
    @endforeach
</head>

<body>
    @include('layout.app.navbar')
    @include('sweetalert::alert')
    @yield('content')
    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true"
        style="background-color: rgba(0,0,0,.6);">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-search">
            <div class="modal-content modal-body-search">
                <div class="modal-body">
                    <div class="mb-3">
                        <form class="input-group" action="{{ route('search.'.$lang) }}">
                            <input type="text" name="query" class="form-control form-control-lg"
                                placeholder="{{__("Search")}}" aria-describedby="btnCari">
                            <button type="submit" class="btn btn-lg btn-danger" type="button" id="btnCari"> <i
                                    class="fa fa-search mr-2"></i> {{__("placeholder.search_for")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
    @include('layout.app.footer')
</body>
@yield('js')

</html>
