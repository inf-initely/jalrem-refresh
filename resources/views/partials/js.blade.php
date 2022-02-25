
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/ytdefer.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="assets/js/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script src="http://platform.twitter.com/widgets.js"></script>
<script>
$(document).ready(function() {
  if ($(window).width() <= 1000) {
    $(".navbar").addClass("bg-nav");
    $(".navbar").removeClass("bg-trans");
  }
});
$(window).scroll(function() {

  if ($(window).width() >= 1000) {
    var scroll = $(window).scrollTop();
    //>=, not <=
    if (scroll >= 50) {
      //clearHeader, not clearheader - caps H
      $(".navbar").addClass("bg-nav");
      $(".navbar").removeClass("bg-trans");
    } else {
      $(".navbar").addClass("bg-trans");
      $(".navbar").removeClass("bg-nav");
    }
  } else {
    $(".navbar").addClass("bg-nav");
    $(".navbar").removeClass("bg-trans");
  }

}); //missing );
</script>
<script>
$(function() {

  var minimized_elements = $('p.minimize');

  minimized_elements.each(function() {
    var t = $(this).text();
    if (t.length < 90) return;

    $(this).html(
      t.slice(0, 90) + '<span>...' +
      '<span style="display:none;">' + t.slice(90, t.length)
    );

  });

});
</script>


<script>
AOS.init({ disable: 'mobile' });
</script>
<script>
$(document).ready(function() {
  $('#selectLanguage').change(function() {
    var language = $("#selectLanguage option:selected").text();
    // console.log(language);
    if (language == "INA") {
      $("#languageFlag").attr("src", "assets/img/bendera/flag-indonesia.png");
    } else {
      $("#languageFlag").attr("src", "assets/img/bendera/flag-english.png");
    }
  });
});
</script>
<script>
var options = {
  autoPlay: 7000,
  pauseAutoPlayOnHover: false,
  accessibility: true,
  prevNextButtons: true,
  pageDots: true,
  setGallerySize: false,
  arrowShape: {
    x0: 10,
    x1: 60,
    y1: 50,
    x2: 60,
    y2: 45,
    x3: 15
  }
};

var $carousel = $('[data-carousel]').flickity(options);
var $slideContent = $('.slide-content');
var flkty = $carousel.data('flickity');
var selectedSlide = flkty.selectedElement;

flkty.on('settle', function(index) {
  selectedSlide = flkty.selectedElement;
});

flkty.on('change', function(index) {
  $slideContent.eq(index).removeClass('mask');

  setTimeout(function() {
    $slideContent.addClass('mask');
  }, 500);
});

flkty.on('dragStart', function(event) {
  var index = 0;
  selectedSlide = flkty.selectedElement;

  if (event.layerX > 0) { // direction right
    index = $(selectedSlide).index() + 1;
  } else { // direction left
    index = $(selectedSlide).index() - 1;
  }

  $slideContent.eq(index).removeClass('mask');
});

setTimeout(function() {
  $slideContent.addClass('mask');
}, 500);
</script>
<script>
$(".page-scroll").on('click', function(e) {
  var tujuan = $(this).attr('href');
  var elemenTujuan = $(tujuan);
  // console.log(tujuan);

  $('html,body').animate({
    scrollTop: elemenTujuan.offset().top - 67

  }, 500);
  e.preventDefault();
})
</script>
<script>
// HERO SLIDER
var menu = [];
jQuery('.swiper-slide').each(function(index) {
  menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
});
var interleaveOffset = 0.5;
var swiperOptions = {
  loop: true,
  speed: 1000,
  parallax: true,
  autoplay: {
    delay: 6500,
    disableOnInteraction: false,
  },
  watchSlidesProgress: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  on: {
    progress: function() {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        var slideProgress = swiper.slides[i].progress;
        var innerOffset = swiper.width * interleaveOffset;
        var innerTranslate = slideProgress * innerOffset;
        swiper.slides[i].querySelector(".slide-inner").style.transform =
          "translate3d(" + innerTranslate + "px, 0, 0)";
      }
    },

    touchStart: function() {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = "";
      }
    },

    setTransition: function(speed) {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = speed + "ms";
        swiper.slides[i].querySelector(".slide-inner").style.transition =
          speed + "ms";
      }
    }
  }
};

var swiper = new Swiper(".swiper-container", swiperOptions);

// DATA BACKGROUND IMAGE
var sliderBgSetting = $(".slide-bg-image");
sliderBgSetting.each(function(indx) {
  if ($(this).attr("data-background")) {
    $(this).css("background-image", "url(" + $(this).data("background") + ")");
  }
});
</script>

<script>
  $('iframe').attr('allowfullscreen', '');
</script>
