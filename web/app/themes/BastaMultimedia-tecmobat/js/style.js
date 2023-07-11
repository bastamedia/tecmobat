function splitWord(e, index) {
  let letters = e.eq(index).data("content").split("");
  //let letters_filtre = letters.filter( function(val){return val !== ' '} );
  letters.forEach(function (letter) {
    e.eq(index).append("<span>" + letter + "</span>");
  });
}

function titleEffect(e, index) {
  splitWord(e, index);
  e.eq(index).hover(function () {
    $(this).toggleClass("effect");
  });
}

function lpdcanyondm() {
  if ($(".main-title span.has-x-large-font-size:nth-of-type(1)").length) {
    let title = $(
      ".main-title span.has-x-large-font-size:nth-of-type(1)"
    ).html();
    let split = title.split("");

    $(".main-title span.has-x-large-font-size:nth-of-type(1)").empty();

    split.forEach(function (letter) {
      $(".main-title span.has-x-large-font-size:nth-of-type(1)").append(
        '<i class="' + letter + '_space">' + letter + "</i>"
      );
    });
  }

  if ($(".main-title span.has-x-large-font-size:nth-of-type(2)").length) {
    let title2 = $(
      ".main-title span.has-x-large-font-size:nth-of-type(2)"
    ).html();
    let split2 = title2.split("");

    $(".main-title span.has-x-large-font-size:nth-of-type(2)").empty();

    split2.forEach(function (letter) {
      $(".main-title span.has-x-large-font-size:nth-of-type(2)").append(
        '<i class="' + letter + '_space">' + letter + "</i>"
      );
    });
  }
}

function scrollTrigger(item, dist) {
  let windowWidth = window.innerWidth;

  $(window).on("scroll", function () {
    //haut de l'écran
    let scrollTopScreen = $(window).scrollTop();
    //milieu de l'écran
    let scrollMiddleScreen = scrollTopScreen + window.innerHeight / 2;

    item.each(function (index) {
      if (scrollMiddleScreen > item.eq(index).offset().top - dist) {
        item.eq(index).addClass("animate");
      }
    });
  });
}
function e_gallery() {
  let ga = $(".bs-expertises-gallery");
  let ec = $(".expertises-content");
  ga.find("figure.wp-block-image").on("click", function () {
    ga.find("figure.wp-block-image").toggleClass("is-click");
    ec.eq($(this).index() + 1).toggleClass("on");
    ec.toggleClass("is-click");
    $(this).toggleClass("active");
  });
}
function e_gallery2() {
  let ga = $(".bs-expertises-gallery");
  let ec = $(".expertises-content");
  ga.find("figure.wp-block-image").on("click", function () {
    window.scrollTo({
      top: ec.eq($(this).index() + 1).offset().top,
      behavior: "smooth",
    });
  });
}

function swiperInit() {
  const swiper = new Swiper(".swiper", {
    effect: "coverflow",
    grabCursor: false,
    allowTouchMove: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-scrollbar",
      type: "progressbar",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    loop: true,

    breakpoints: {
      782: {
        allowTouchMove: false,
      },
    },
  });
}

function referencesDisplay() {
  let button = $(".swiper-button-next, .swiper-button-prev");
  let bloc_cht = $(".wp-block-group.cht");
  let slide = $(".swiper-slide");

  let swiperSlider = $(".swiper");

  // swiperSlider.swipe({
  //   swipe: function (event, direction, distance, duration, fingerCount) {
  //     let swiper = $(".swiper-slide-active");
  //     let n = swiper.data("swiper-slide-index");
  //     bloc_cht.removeClass("visible");
  //     bloc_cht.eq(n).addClass("visible");
  //   },
  // });

  button.on("click", function () {
    //   let swiper = $(".swiper-slide-active");
    //   let n = swiper.data("swiper-slide-index");
    //   bloc_cht.removeClass("visible");
    //   bloc_cht.eq(n).addClass("visible");
    // });
    // slide.on("click", function () {
    //   window.scrollTo({
    //     top: bloc_cht.offset().top - 120,
    //     behavior: "smooth",
    //   });
  });
}

function scrollerA() {
  let scroller = $(".scrollerArticles span");
  scroller.on("click", function () {
    window.scrollTo({
      top: $(".bs-single-columns").offset().top - 100,
      behavior: "smooth",
    });
  });
}

function increase(max, time, e) {
  let cpt = 0;
  let node = document.getElementById(e);

  function countdown() {
    node.innerHTML = ++cpt;
    if (cpt < max) {
      setTimeout(countdown, time);
    }
  }

  setTimeout(countdown, time);
}

function launchIncrease() {
  let launchanimation = false;

  $(window).on("scroll", function () {
    let scrollTopScreen = $(window).scrollTop();
    let scrollMiddleScreen = scrollTopScreen + window.innerHeight / 2;
    if (!launchanimation && $(".up-fade-effect").length) {
      if (scrollMiddleScreen >= $("#section-count").offset().top - 200) {
        increase(150, 1, "count-1");
        increase(6, 100, "count-2");
        increase(25, 100, "count-3");
        increase(6, 100, "count-4");
        launchanimation = true;
      }
    }
  });
}

$(function () {
  let body = $("body");
  let menu = $(".menu-principal-container");
  menu.prepend('<span class="menu-burger">x</span>');
  let title = $(".title-effect");
  title.each(function (index) {
    titleEffect(title, index);
  });

  let slideFade = $(".slide-fade-effect");

  slideFade.closest(".wp-block-group").addClass("has-overflow-x-hidden");

  scrollTrigger(slideFade, 100);
  scrollTrigger($(".up-fade-effect"), 200);

  if (window.innerWidth > 782) {
    e_gallery();
  } else {
    e_gallery2();
  }
  $(window).resize(function () {
    if (window.innerWidth > 782) {
      e_gallery();
    } else {
      e_gallery2();
    }
  });

  swiperInit();

  referencesDisplay();

  scrollerA();

  launchIncrease();

  setTimeout(function () {
    $("h1.main-title").addClass("is-visible");
  }, 9200);

  if (window.innerWidth > 900) {
    lpdcanyondm();
  }
});

const slides = document.querySelectorAll(".swiper-slide");
slides.forEach((slide) => {
  slide.addEventListener("click", () => {
    const chtId = slide.getAttribute("aria-controls");
    const cht = document.getElementById(chtId);

    if (!cht.classList.contains("modal-visible")) {
      cht.classList.add("modal-visible");
    }
  });
});

const modalCloseButtons = document.querySelectorAll("#modal-close");
modalCloseButtons.forEach((btn, i) => {
  const cht = document.getElementById("cht" + (i + 1));

  btn.addEventListener("click", (evt) => {
    if (cht.classList.contains("modal-visible")) {
      cht.classList.remove("modal-visible");
    }
  });
});

const overlays = document.querySelectorAll(".overlay");
overlays.forEach((overlay) => {
  overlay.addEventListener("click", (evt) => {
    if (evt.target.parentElement.classList.contains("modal-visible")) {
      evt.target.parentElement.classList.remove("modal-visible");
    }
  });
});
