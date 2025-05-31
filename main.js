window.addEventListener("load", function() {
  jQuery(function($) {
    // プレローダー
    $("#preloader").delay(1000).fadeOut(1000, function() {
      $(this).remove();
      $(".fv-overlay").addClass("start-animation");
    });

    // ハンバーガーメニュー
    var menuToggle = document.getElementById("menu-toggle");
    var primaryMenu = document.getElementById("primary-menu");
    if (menuToggle && primaryMenu) {
      menuToggle.addEventListener("click", function() {
        primaryMenu.classList.toggle("open");
        menuToggle.classList.toggle("open");
      });
    }

    // スクロールボタン
    var skipButton = document.getElementById("skip-button");
    if (skipButton) {
      skipButton.addEventListener("click", function() {
        var target = document.getElementById("information-posts") || document.querySelector("main");
        if (target) {
          target.scrollIntoView({ behavior: "smooth" });
        }
      });
    }

    // 最新記事スライダー
    function unifyPostCardHeights() {
      var maxHeight = 0;
      $('.posts-slider .post-card').css('height', 'auto');
      $('.posts-slider .post-card').each(function() {
        var cardHeight = $(this).outerHeight();
        if (cardHeight > maxHeight) {
          maxHeight = cardHeight;
        }
      });
      $('.posts-slider .post-card').css('height', maxHeight + 'px');
    }
    $(window).on('load', function() {
      setTimeout(function() { unifyPostCardHeights(); }, 500);
    });
    $('.posts-slider')
      .on('init reInit setPosition afterChange', function() {
        setTimeout(function() { unifyPostCardHeights(); }, 300);
      })
      .slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        adaptiveHeight: false,
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 800,
        prevArrow: '<button type="button" class="slick-prev">＜</button>',
        nextArrow: '<button type="button" class="slick-next">＞</button>',
        responsive: [
          { breakpoint: 768, settings: { slidesToShow: 1 } }
        ]
      });

    // ギャラリースライダー
    $('.gallery-slider').slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      infinite: true,
      adaptiveHeight: false,
      arrows: true,
      dots: true,
      autoplay: true,
      autoplaySpeed: 5000,
      speed: 1500,
      prevArrow: '<button type="button" class="slick-prev">＜</button>',
      nextArrow: '<button type="button" class="slick-next">＞</button>',
      responsive: [
        { breakpoint: 1024, settings: { slidesToShow: 4, slidesToScroll: 1 }},
        { breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 1 }}
      ]
    });

    $(window).on('resize', function() {
      $('.gallery-slider').slick('setPosition');
    });

    // 横長画像判定
    document.querySelectorAll('.post-thumbnail img, .gallery-image-container img').forEach(function(img) {
      img.addEventListener('load', function() {
        if (img.naturalWidth / img.naturalHeight > 1.3) {
          img.classList.add('horizontal-image');
          if (img.parentElement) img.parentElement.classList.add('horizontal');
        } else {
          img.classList.remove('horizontal-image');
          if (img.parentElement) img.parentElement.classList.remove('horizontal');
        }
      });
    });

    // メッセージエリア（続きを読む/閉じる）
    var part1  = document.querySelector('#message-area .part-1');
    var part2  = document.querySelector('#message-area .part-2');
    var btnMore= document.querySelector('#message-area .btn-more');
    var btnBack= document.querySelector('#message-area .btn-back');

    if (part1 && part2 && btnMore && btnBack) {
      part2.style.display = 'none';
      btnBack.style.display = 'none';
      btnMore.addEventListener('click', function() {
        part2.style.display = 'block';
        btnMore.style.display = 'none';
        btnBack.style.display = 'inline-block';
      });
      btnBack.addEventListener('click', function() {
        part2.style.display = 'none';
        btnMore.style.display = 'inline-block';
        btnBack.style.display = 'none';
      });
    }

    // IntersectionObserver for fade‑in effect
    setTimeout(function() {
      var observer = new IntersectionObserver(function(entries, observerInstance) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
          }
        });
      }, { threshold: 0.1 });
      document.querySelectorAll('.animate').forEach(function(elem) {
        observer.observe(elem);
      });
    }, 500);
  });
});