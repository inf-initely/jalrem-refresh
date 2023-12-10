@php
    $timelineSlide = array(
        ["year" => "2017", "content" => __("timeline.slide-1"), "image" => asset("assets/timeline/2017.jpg")],
        ["year" => "2020-2021", "content" => __("timeline.slide-2"), "image" => asset("assets/timeline/2020-2021.jpeg")],
        ["year" => "2020-2022", "content" => __("timeline.slide-3"), "image" => asset("assets/timeline/2020-2022.webp")],
        ["year" => "2020-2021", "content" => __("timeline.slide-4"), "image" => asset("assets/timeline/2020-2021.jpg")],
        ["year" => "2022-2023", "content" => __("timeline.slide-5"), "image" => asset("assets/timeline/2022-2023.webp")],
        ["year" => "2023", "content" => __("timeline.slide-6"), "image" => asset("assets/timeline/2023-2024.jpg")],
        ["year" => "2024", "content" => __("timeline.slide-7"), "image" => asset("assets/timeline/2023-2024.jpg")],
    );
@endphp

<!--Timeline carousel-->
<div class="timeline-carousel">
    <h2>{{ __("timeline.title") }}</h2>
    <div class="timeline-carousel__item-wrapper timeline-carousel-slick" data-js="timeline-carousel">
        @foreach ($timelineSlide as $slide)
            <div class="timeline-carousel__item">
                <div class="timeline-carousel__image">
                    <div class="media-wrapper media-wrapper--overlay"
                        style="background: url({{$slide["image"]}}) center center; background-size:cover;">
                    </div>
                </div>
                <div class="timeline-carousel__item-inner">
                    <span class="year">{{$slide["year"]}}</span>
                    {{-- <span class="month">June 28</span> --}}
                    <p>{{$slide["content"]}}</p>
                    {{-- <a href="#" class="read-more">Read more</a> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
<!--Timeline carousel-->
<style>
    .timeline-carousel {
        padding: 86px 6.9444% 90px 6.9444%;
        position: relative;
        overflow: hidden;
    }

    .timeline-carousel:after,
    .timeline-carousel:before {
        content: "";
        position: absolute;
        display: block;
        top: 0;
        height: 100%;
        width: 6.9444%;
        background-color: #1d1d1e;
        z-index: 3;
        width: 6.9444%;
    }

    .timeline-carousel:after {
        display: none;
    }

    .timeline-carousel:before {
        right: 0;
        opacity: 0;
    }

    .timeline-carousel .slick-list {
        overflow: visible;
    }

    .timeline-carousel .slick-dots {
        bottom: -73px;
    }

    .timeline-carousel h2 {
        color: black;
        font-size: 38px;
        line-height: 50pd;
        margin-bottom: 40px;
        font-weight: 900;
    }

    .timeline-carousel__image {
        padding-right: 30px;
    }

    .timeline-carousel__item {
        cursor: pointer;
    }

    .timeline-carousel__item .media-wrapper {
        opacity: 0.4;
        padding-bottom: 71.4%;
        -webkit-transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        -o-transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }

    .timeline-carousel__item:last-child .timeline-carousel__item-inner:after {
        width: calc(100% - 30px);
    }

    .timeline-carousel__item-inner {
        position: relative;
        padding-top: 45px;
    }

    .timeline-carousel__item-inner:after {
        position: absolute;
        width: 100%;
        top: 45px;
        left: 0;
        content: "";
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }

    .timeline-carousel__item-inner .year {
        font-size: 32px;
        line-height: 36px;
        text-align: center;
        color: white;
        display: table;
        letter-spacing: -1px;
        padding-right: 10px;
        background-color: #dc3646;
        z-index: 1;
        position: relative;
        margin: -15px 0 20px;
        font-weight: 900;
    }

    .timeline-carousel__item-inner .year:after {
        content: "";
        position: absolute;
        display: block;
        left: -10px;
        top: 0;
        height: 100%;
        width: 10px;
        background-color: #dc3646;
        z-index: 3;
    }

    .timeline-carousel__item-inner .month {
        font-size: 12px;
        text-transform: uppercase;
        color: #9d7e59;
        display: block;
        margin-bottom: 10px;
        font-weight: 900;
    }

    .timeline-carousel__item-inner p {
        font-size: 14px;
        line-height: 1.5em;
        color: black;
        width: 60%;
        font-weight: 400;
        margin-bottom: 15px;
    }

    .timeline-carousel__item-inner .read-more {
        font-size: 12px;
        color: #9d7e59;
        display: table;
        margin-bottom: 10px;
        font-weight: 900;
        text-decoration: none;
        position: relative;
    }

    .timeline-carousel__item-inner .read-more:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 0;
        border-bottom: 2px solid #9d7e59;
        -webkit-transition: all 0.2s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        -o-transition: all 0.2s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        transition: all 0.2s cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }

    .timeline-carousel__item-inner .read-more:hover:after {
        width: 100%;
    }

    .timeline-carousel__item-inner .pointer {
        height: 29px;
        position: relative;
        z-index: 1;
        margin: -4px 0 16px;
    }

    .timeline-carousel__item-inner .pointer:after,
    .timeline-carousel__item-inner .pointer:before {
        position: absolute;
        content: "";
    }

    .timeline-carousel__item-inner .pointer:after {
        width: 9px;
        height: 9px;
        border-radius: 100%;
        top: 0;
        left: 0;
        background-color: #9d7e59;
    }

    .timeline-carousel__item-inner .pointer:before {
        width: 1px;
        height: 100%;
        top: 0;
        left: 4px;
        background-color: #9d7e59;
    }

    .timeline-carousel .slick-active .media-wrapper {
        opacity: 1 !important;
    }

    .slick-dots {
        bottom: 60px;
        list-style: none;
        position: absolute;
        width: 100%;
        left: 0;
        text-align: center;
        z-index: 2;
    }

    .slick-dots li {
        cursor: pointer;
        display: inline-block;
        margin: 0 6px;
        position: relative;
        width: 10px;
        height: 10px;
    }

    .slick-dots li:last-child {
        margin-right: 0;
    }

    .slick-dots li.slick-active button {
        background: #9d7e59;
        border-color: #9d7e59;
    }

    .slick-dots li button {
        display: block;
        font-size: 0;
        width: 10px;
        height: 10px;
        padding: 0;
        background-color: rgba(0, 0, 0, 0.6);
        border-color: rgba(0, 0, 0, 0.6);
        cursor: pointer;
        -webkit-transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        -o-transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        transition: all 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }

    .slick-dots li button:hover {
        background: #9d7e59;
        border-color: #9d7e59;
    }

    .link {
        position: absolute;
        left: 0;
        bottom: 0;
        padding: 20px;
        z-index: 9999;
    }

    .link a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #fff;
    }

    .link .fa {
        font-size: 28px;
        margin-right: 8px;
        color: #fff;
    }
</style>
