function prefetch(e) {
  if (e.target.tagName != "A") {
    return;
  }
  if (e.target.origin != location.origin) {
    return;
  }
  var l = document.createElement("link");
  l.rel = "prefetch";
  l.href = e.target.href;
  document.head.appendChild(l);
}
window.onload = function () {
  document.documentElement.addEventListener("mouseover", prefetch, {
    capture: true,
    passive: true,
  });
  document.documentElement.addEventListener("touchstart", prefetch, {
    capture: true,
    passive: true,
  });
};

function kopidev_show_menu() {
  var x = document.querySelector(".menu-primary-container");
  if (x.style.display === "none" || !x.style.display) {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
