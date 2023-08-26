<section id="cardInfo">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-lg-4 mb-2">
                        <div class="card no-border card-media">
                            <div class="card-body row">
                                <div class="col-3 mt-3 text-center">
                                    <img src="{{ asset('assets/img/icon/jalur_1.svg') }}" height="40px">
                                </div>
                                <div class="col-9 ">
                                    <h3 class="judul-card-info">{{__("common.the_route")}}</h3>
                                    <p class="des-card-info-id">{{__("wall.the_route_card_desc")}}</p>
                                </div>
                            </div>
                            <a href="{{ route('the-route.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card no-border card-media">
                            <div class="card-body row">
                                <div class="col-3 mt-3 text-center">
                                    <img src="{{ asset('assets/img/icon/jejak_1.svg') }}" height="32px">
                                </div>
                                <div class="col-9 ">
                                    <h3 class="judul-card-info">{{__("common.the_trail")}}</h3>
                                    <p class="des-card-info-id">{{__("wall.the_trail_card_desc")}}</p>
                                </div>
                            </div>
                            <a href="{{ route('the-trail.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <div class="card no-border card-media">
                            <div class="card-body row">
                                <div class="col-3 mt-3 text-center">
                                    <img src="{{ asset('assets/img/icon/masa-depan_1.svg') }}" height="40px">
                                </div>
                                <div class="col-9 ">
                                    <h3 class="judul-card-info">{{__("common.the_future")}}</h3>
                                    <p class="des-card-info-id">{{__("wall.the_future_card_desc")}}</p>
                                </div>
                            </div>
                            <a href="{{ route('the-future.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
