<div id="share" class="mt-4">
    <h3>{{__("Share")}}:</h3>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
            <a target="_blank" href="https://wa.me/?text={{ route($content["content_type"].'_detail', $content["slug"]) }}">
                <img src="{{ asset('assets/img/icon-media-sosial/icon-whatsapp.svg') }}" width="30px">
            </a>
        </li>
        <li class="list-group-item">
            <a target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u={{ route($content["content_type"].'_detail', $content["slug"]) }}">
                <img src="{{ asset('assets/img/icon-media-sosial/icon-facebook.svg') }}" width="30px">
            </a>
        </li>
        <li class="list-group-item">
            <a target="_blank"
                href="https://social-plugins.line.me/lineit/share?url={{ route($content["content_type"].'_detail', $content["slug"]) }}">
                <img src="{{ asset('assets/img/icon-media-sosial/icon-line.svg') }}" width="30px">
            </a>
        </li>
        <li class="list-group-item">
            <a target="_blank" blank=""
                href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route($content["content_type"].'_detail', $content["slug"]) }}&amp;title={{ $content["title"] }}">
                <img src="{{ asset('assets/img/icon-media-sosial/icon-linkedin.svg') }}" width="30px">
            </a>
        </li>
        <li class="list-group-item">
            <a target="_blank"
                href="https://twitter.com/intent/tweet?text={{ $content["title"] }}&amp;url={{ route($content["content_type"].'_detail', $content["slug"]) }}">
                <img src="{{ asset('assets/img/icon-media-sosial/icon-twitter.svg') }}" width="30px">
            </a>
        </li>
    </ul>
</div>
