<div class="col-lg-6 mb-1">
    <div class="card no-border no-background">
        <div class="card-body row">
            <div class="col-5 center-v">
                @php
                    $content_type = $content['content_type'];
                    $video_url = $content_type == 'video' ? $content['youtube_key'] : $content['cloud_key'];
                @endphp
                @if ($content_type == 'video' || $content_type == 'audio')
                    <div class="video media-video" style="height: 170px;" data-video-id="{{ $video_url }}">
                        <div class="video-layer">
                            <div class="video-placeholder">
                            </div>
                        </div>
                        <div class="video-preview"
                            style="background: url('https://img.youtube.com/vi/{{ $video_url }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                            <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                            <svg viewBox="0 0 74 74">
                                <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5">
                                </circle>
                                <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5">
                                </circle>
                                <polygon fill="#fff" points="33,22 33,52 48,37">
                                </polygon>
                            </svg>
                        </div>
                    </div>
                @else
                    <img class="tentang-thumbnail"
                        src="{{ asset(get_asset_path($content['table_name'], $content['thumbnail'])) }}" width="100%">
                @endif
            </div>
            <div class="col-7 center-v">
                <a href="#"
                    class="text-danger m-0 p-0 text-decoration-none wilayah">
                    <small>{{ $content['location'] ? Common::Locations[$content['location']]['name'] : "" }}</small>
                </a>
                <h3 class="judul-artikel judul-artikel-tentang">
                    <a href="{{ route(generate_route_content($content['table_name']) . '_detail.' . $lang, $content['slug']) }}"
                        class="text-decoration-none clr-black">{{ $content['title'] }}</a>
                </h3>
                <div class="wrap-tag-rempah">
                    @foreach ($content['spices'] as $spice)
                        <a href="{{ route('rempah_detail.'.$lang, $spice['type']) }}"
                            class="text-danger text-decoration-none">{{ $spice['type'] }}</a>
                        @if (!$loop->last)
                            |
                        @endif
                    @endforeach
                </div>
                @foreach ($content['categories'] as $category)
                    @include('partials.category-badge')
                @endforeach
            </div>
        </div>
    </div>
</div>
