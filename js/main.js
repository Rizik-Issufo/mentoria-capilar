document.addEventListener('DOMContentLoaded', function () {
  var nav = document.getElementById('navbarPrincipal');
  if (nav) {
    var onScroll = function () {
      nav.classList.toggle('scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', onScroll);
    onScroll();
  }
});
