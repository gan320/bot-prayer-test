$(document).ready(function () {
  /* Sticky menu */
  $(".navbar").sticky({
    topSpacing: 0,
  });

  /* Scroll spy and scroll filter */
  $("#main-menu").onePageNav({
    currentClass: "active",
    changeHash: false,
    scrollThreshold: 0.5,
    scrollSpeed: 750,
    filter: "",
    easing: "swing",
  });

  var carousel = document.getElementById("quote-carousel");
  var mobile = false;

  // test if mobile device
  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    mobile = true;
  }

  const resizeObserver = new ResizeObserver(() => {
    // for web page
    let x = carousel.offsetWidth;
    var newHeight = (12376 / x) * 26;

    if (mobile) {
      newHeight = (12376 / x) * 22;
    }

    carousel.style.height = "" + newHeight + "px";
  });
  resizeObserver.observe(document.getElementById("page-welcome"));

  $("#quote-carousel").carousel({
    pause: true,
    interval: 10000,
  });
});
