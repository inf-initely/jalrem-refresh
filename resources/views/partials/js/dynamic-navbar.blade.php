@php
    if(!isset($altnav)) {
        $altnav = false;
    }
@endphp

<script>
    $(document).ready(function() {
        if ($(window).width() <= 1000) {
            $(".navbar").addClass({!! $altnav ? "'bg-nav-baru'" : "'bg-nav'" !!});
            $(".navbar").removeClass("bg-trans");
        }
    });
    $(window).scroll(function() {

        if ($(window).width() >= 1000) {
            var scroll = $(window).scrollTop();
            //>=, not <=
            if (scroll >= 50) {
                //clearHeader, not clearheader - caps H
                $(".navbar").addClass({!! $altnav ? "'bg-nav-baru'" : "'bg-nav'" !!});
                $(".navbar").removeClass("bg-trans");
            } else {
                $(".navbar").addClass("bg-trans");
                $(".navbar").removeClass({!! $altnav ? "'bg-nav-baru'" : "'bg-nav'" !!});
            }
        } else {
            $(".navbar").addClass({!! $altnav ? "'bg-nav-baru'" : "'bg-nav'" !!});
            $(".navbar").removeClass("bg-trans");
        }

    }); //missing );
</script>
