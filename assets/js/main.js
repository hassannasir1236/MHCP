// Renders home cards from HOMES (assets/js/homes-data.js)
function money(n){return "$" + n.toLocaleString("en-US");}
function homeCard(h, parkMeta, root){
  const img = (h.photos && h.photos.length)
    ? root + "assets/img/homes/" + h.photos[0]
    : root + "assets/img/" + parkMeta.img;
  const bb = (h.beds ? h.beds + " bed" : "") + (h.beds && h.baths ? " · " : "") + (h.baths ? h.baths + " bath" : "");
  const badge = h.comingSoon ? "Coming Soon" : "For Sale";
  const specLine = h.specLine || h.title;
  const headerHtml = h.comingSoon
    ? '<div class="home-card-header"><div class="home-status-label">Coming Soon</div><h3>' + h.title + '</h3><div class="home-spec">' + specLine + (bb ? '<br>' + bb : '') + '</div></div>'
    : '<div class="home-card-header"><div class="home-card-price-row"><span class="home-community">' + parkMeta.name + '</span><strong>' + money(h.price) + '</strong></div><div class="home-spec">' + specLine + '</div></div>';
  const financingHtml = h.financingNote
    ? '<p class="home-financing">' + h.financingNote + '</p>'
    : '';
  return '<div class="card home-card' + (h.comingSoon ? ' home-card-soon' : '') + '">' +
    '<div class="card-photo" style="background-image:url(\'' + img + '\')">' +
      '<div class="card-badge' + (h.comingSoon ? ' badge-soon' : '') + '">' + badge + '</div></div>' +
    '<div class="card-body">' +
      headerHtml +
      '<p class="home-notes">' + (h.notes || "") + '</p>' +
      financingHtml +
      '<a class="btn btn-gold btn-sm" href="' + root + 'communities/' + h.park + '.html#inquire">Ask About This Home</a>' +
    '</div></div>';
}
function renderHomes(elId, parkFilter, root){
  const el = document.getElementById(elId);
  if (!el || typeof HOMES === "undefined") return;
  const parks = window.PARKS_META;
  let list = HOMES.filter(h => h.available && (!parkFilter || h.park === parkFilter));
  list.sort((a,b) => (a.comingSoon?1:0) - (b.comingSoon?1:0) || (a.price||0) - (b.price||0));
  if (!list.length){
    el.innerHTML = '<p class="no-homes">No homes listed right now - call us, new homes are added often.</p>';
    return;
  }
  const hasComingSoon = list.some(h => h.comingSoon);
  el.innerHTML = list.map(h => homeCard(h, parks[h.park], root)).join("") +
    (hasComingSoon && !parkFilter ? '<p class="homes-notice">Get First Notice on These Homes</p>' : '');
}

const TESTIMONIALS = [
  {
    name: "Ana Ramos",
    property: "Sweet Lake",
    stars: 5,
    quote: "Melissa Wing is a serious hard working devoted woman who cares about Sweet Lake and tenants. Warm hearted, kind, caring. Sweet Lake is very well clean, maintained and organized. Maintenance is always on the go keeping Sweet Lake nice and clean no matter the weather or storm! Sweet Lake is a nice, calm, quiet place - tenants are very respectful. If you’re looking to become a first-time homeowner and start small with children, I highly truly recommend Sweet Lake!!",
    link: "https://maps.app.goo.gl/B4YZAawLqGGLiLDZA"
  },
  {
    name: "Shelbi Wing",
    property: "Sweet Lake",
    stars: 5,
    quote: "I’ve lived here for almost 9 years and have not had a single problem. Quiet, clean community where you are either overlooking Sweet Lake or observing wildlife grazing the open fields. There have been a lot of very important improvements here which have positively impacted all tenants. They’re reasonable to work with when things come up as well. They have monthly drawings, holiday festivities, and other random acts of kindness throughout the year. You won’t find a nicer place in the area for the price that is clean and quiet.",
    link: "https://maps.app.goo.gl/tH4PaeE3C748YkN76"
  },
  {
    name: "Lori Coburn",
    property: "Sweet Lake",
    stars: 5,
    quote: "Melissa is awesome to work with. She made the process so easy.",
    link: "https://maps.app.goo.gl/pqSasUdgFnS31gTQ6"
  },
  {
    name: "Abby Benac",
    property: "Sweet Lake",
    stars: 5,
    quote: "Melissa is great on helping you get into your new home fast. I definitely recommend people looking for a new home that are not bad on prices and clean places - these are it.",
    link: "https://maps.app.goo.gl/WijiWD5qHzLCEbaT8"
  },
  {
    name: "Ronnie Jo",
    property: "Sweet Lake",
    stars: 5,
    quote: "Love my home here.",
    link: "https://maps.app.goo.gl/qoywqeRunkYdLaNs5"
  },
  {
    name: "Cindy Voelzke",
    property: "Sturgis Commons",
    stars: 5,
    quote: "Melissa is very prompt with issues. She is very kind, and easy to work with. Everyone seems to keep to themselves. Quiet, nice place to live.",
    link: "https://maps.app.goo.gl/fUL8sNDajMyfVtvo9"
  },
  {
    name: "BJ C",
    property: "Pine Crest",
    stars: 5,
    quote: "I moved into Pine Crest back in June. Melissa made my buying experience very easy. Couldn’t ask for a better park manager. Everyone that I have met here has made me feel very welcome. I love my home. It is just a huge peace of mind living here.",
    link: "https://maps.app.goo.gl/7ouhMZxtdDXHePcAA"
  },
  {
    name: "Macey Westerhoff",
    property: "Pine Crest",
    stars: 5,
    quote: "Just bought our home here at Pine Crest! The process was super quick, thanks to Melissa and 21st. Melissa is great!! She is super friendly, responds to my questions right away, and is very proficient at what she does!! So far we’re loving it here - a nice, quiet neighborhood. If you’re looking for a home/community to start or raise your family in, this is the one!!!",
    link: "https://maps.app.goo.gl/wDvptHyJojyK9aW38"
  },
  {
    name: "Aub",
    property: "Pine Crest",
    stars: 5,
    quote: "Melissa Wing has been, and is, very helpful, straight-forward, and nice through the whole process of applying to moving in from start to finish! She’s there if you have any questions or concerns. Very excited to call Pine Crest home!",
    link: "https://maps.app.goo.gl/dSugGL4iydaY1EP38"
  },
  {
    name: "Cindi Patrick",
    property: "Pine Crest",
    stars: 5,
    quote: "Very quiet and clean park. I lived there years ago when I was younger and I must say that they have kept it up well. The residents seem very nice. It’s a quiet, pretty setting.",
    link: "https://maps.app.goo.gl/NC74GyaZEh8LB93x7"
  }
];

function starIcons(n){
  let html = "";
  for (let i = 1; i <= 5; i++){
    if (i <= n){
      html += '<svg class="star-full" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5l2.9 5.88 6.5.95-4.7 4.58 1.11 6.47L12 17.77l-5.81 3.06 1.11-6.47-4.7-4.58 6.5-.95L12 2.5z"/></svg>';
    } else {
      html += '<svg class="star-empty" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5l2.9 5.88 6.5.95-4.7 4.58 1.11 6.47L12 17.77l-5.81 3.06 1.11-6.47-4.7-4.58 6.5-.95L12 2.5z"/></svg>';
    }
  }
  return html;
}

function escapeHtml(str){
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
}

function initTestimonials(){
  const section = document.getElementById("reviews");
  const track = document.getElementById("t-track");
  const slider = track && track.parentElement;
  const prevBtn = document.getElementById("t-prev");
  const nextBtn = document.getElementById("t-next");
  const dotsEl = document.getElementById("t-dots");
  if (!track || !slider || !prevBtn || !nextBtn) return;

  const parkFilter = (window.TESTIMONIALS_PARK || (section && section.getAttribute("data-park")) || "").trim();
  const list = parkFilter
    ? TESTIMONIALS.filter(t => t.property.toLowerCase() === parkFilter.toLowerCase())
    : TESTIMONIALS.slice();

  if (!list.length){
    if (section) section.style.display = "none";
    return;
  }

  const COLLAPSE_LEN = 140;
  const GAP_DESKTOP = 24;
  const GAP_MOBILE = 16;
  const showSlider = list.length >= 4;

  const navEl = document.querySelector(".t-nav");
  const hintEl = document.querySelector(".t-hint");
  if (!showSlider){
    if (navEl) navEl.style.display = "none";
    if (dotsEl) dotsEl.style.display = "none";
    if (hintEl) hintEl.style.display = "none";
    slider.style.cursor = "default";
    slider.classList.add("t-static");
    track.classList.add("t-static-track");
  }

  track.innerHTML = list.map((t, i) => {
    const long = t.quote.length > COLLAPSE_LEN;
    return '<article class="t-card">' +
      '<div class="t-reviewer">' + escapeHtml(t.name) + '</div>' +
      '<div class="t-quote-wrap">' +
        '<p class="t-quote' + (long ? ' is-collapsed' : '') + '" id="t-quote-' + i + '">“' + escapeHtml(t.quote) + '”</p>' +
        (long ? '<button type="button" class="t-more" data-i="' + i + '" aria-expanded="false">Read more</button>' : '') +
      '</div>' +
      '<div class="t-stars" aria-label="' + t.stars + ' out of 5 stars">' + starIcons(t.stars) + '</div>' +
    '</article>';
  }).join("");

  let index = 0;
  let perView = 3;
  let dragStartX = 0;
  let dragDelta = 0;
  let dragging = false;
  let baseX = 0;

  function currentGap(){
    return window.innerWidth <= 640 ? GAP_MOBILE : GAP_DESKTOP;
  }

  function updatePerView(){
    if (window.innerWidth <= 640) perView = 1;
    else if (window.innerWidth <= 900) perView = 2;
    else perView = 3;
  }

  function maxIndex(){
    return Math.max(0, list.length - perView);
  }

  function stepSize(){
    const card = track.children[0];
    if (!card) return 0;
    return card.getBoundingClientRect().width + currentGap();
  }

  function offsetFor(i){
    return -(i * stepSize());
  }

  function renderDots(){
    if (!dotsEl) return;
    const pages = maxIndex() + 1;
    dotsEl.innerHTML = Array.from({length: pages}, (_, i) =>
      '<button type="button" class="t-dot' + (i === index ? ' active' : '') + '" aria-label="Go to slide ' + (i + 1) + '" data-i="' + i + '"></button>'
    ).join("");
  }

  function goTo(i, animate){
    if (!showSlider){
      track.style.transform = "none";
      return;
    }
    updatePerView();
    index = Math.max(0, Math.min(i, maxIndex()));
    if (animate === false) track.classList.add("is-dragging");
    else track.classList.remove("is-dragging");
    track.style.transform = "translate3d(" + offsetFor(index) + "px,0,0)";
    prevBtn.disabled = index === 0;
    nextBtn.disabled = index >= maxIndex();
    renderDots();
  }

  track.addEventListener("click", (e) => {
    if (Math.abs(dragDelta) > 8) {
      e.preventDefault();
      e.stopPropagation();
      return;
    }
    const btn = e.target.closest(".t-more");
    if (!btn) return;
    const quote = document.getElementById("t-quote-" + btn.dataset.i);
    const card = btn.closest(".t-card");
    if (!quote || !card) return;
    const open = btn.getAttribute("aria-expanded") === "true";
    if (open){
      quote.classList.add("is-collapsed");
      card.classList.remove("is-expanded");
      btn.setAttribute("aria-expanded", "false");
      btn.textContent = "Read more";
    } else {
      quote.classList.remove("is-collapsed");
      card.classList.add("is-expanded");
      btn.setAttribute("aria-expanded", "true");
      btn.textContent = "Show less";
    }
  });

  prevBtn.addEventListener("click", () => goTo(index - 1));
  nextBtn.addEventListener("click", () => goTo(index + 1));
  if (dotsEl){
    dotsEl.addEventListener("click", (e) => {
      const btn = e.target.closest(".t-dot");
      if (!btn) return;
      goTo(Number(btn.dataset.i));
    });
  }

  function onPointerDown(clientX){
    if (!showSlider) return;
    dragging = true;
    dragStartX = clientX;
    dragDelta = 0;
    baseX = offsetFor(index);
    track.classList.add("is-dragging");
    slider.classList.add("is-dragging");
  }

  function onPointerMove(clientX){
    if (!dragging) return;
    dragDelta = clientX - dragStartX;
    track.style.transform = "translate3d(" + (baseX + dragDelta) + "px,0,0)";
  }

  function onPointerUp(){
    if (!dragging) return;
    dragging = false;
    track.classList.remove("is-dragging");
    slider.classList.remove("is-dragging");
    const threshold = Math.min(60, stepSize() * 0.2);
    if (dragDelta < -threshold) goTo(index + 1);
    else if (dragDelta > threshold) goTo(index - 1);
    else goTo(index);
    setTimeout(function(){ dragDelta = 0; }, 50);
  }

  if (showSlider){
    slider.addEventListener("touchstart", function(e){
      if (e.touches.length !== 1) return;
      onPointerDown(e.touches[0].clientX);
    }, {passive: true});

    slider.addEventListener("touchmove", function(e){
      if (!dragging || e.touches.length !== 1) return;
      onPointerMove(e.touches[0].clientX);
    }, {passive: true});

    slider.addEventListener("touchend", onPointerUp, {passive: true});
    slider.addEventListener("touchcancel", onPointerUp, {passive: true});

    slider.addEventListener("mousedown", function(e){
      if (e.button !== 0) return;
      if (e.target.closest("a,button")) return;
      e.preventDefault();
      onPointerDown(e.clientX);
    });
    window.addEventListener("mousemove", function(e){
      if (!dragging) return;
      onPointerMove(e.clientX);
    });
    window.addEventListener("mouseup", function(){
      if (!dragging) return;
      onPointerUp();
    });
  }

  let resizeTimer;
  window.addEventListener("resize", function(){
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function(){ goTo(index); }, 120);
  });

  goTo(0);
}

document.addEventListener("DOMContentLoaded", function(){
  initTestimonials();
  initPhoneMenu();
  initFaq();
  initMobileNav();
});

function initMobileNav(){
  const header = document.querySelector("header");
  const toggle = document.querySelector(".nav-toggle");
  const panel = document.querySelector(".header-panel");
  if (!header || !toggle || !panel) return;

  function closeMenu(){
    header.classList.remove("is-menu-open");
    toggle.setAttribute("aria-expanded", "false");
    toggle.setAttribute("aria-label", "Open menu");
    document.querySelectorAll(".nav-drop.is-open").forEach(function(el){
      el.classList.remove("is-open");
    });
  }

  function openMenu(){
    header.classList.add("is-menu-open");
    toggle.setAttribute("aria-expanded", "true");
    toggle.setAttribute("aria-label", "Close menu");
  }

  toggle.addEventListener("click", function(e){
    e.stopPropagation();
    if (header.classList.contains("is-menu-open")) closeMenu();
    else openMenu();
  });

  // Communities accordion on mobile
  panel.querySelectorAll(".nav-drop-toggle").forEach(function(btn){
    btn.addEventListener("click", function(e){
      if (window.innerWidth > 900) return;
      e.preventDefault();
      const drop = btn.closest(".nav-drop");
      if (!drop) return;
      const open = drop.classList.contains("is-open");
      panel.querySelectorAll(".nav-drop.is-open").forEach(function(el){
        el.classList.remove("is-open");
      });
      if (!open) drop.classList.add("is-open");
    });
  });

  panel.querySelectorAll("a").forEach(function(link){
    link.addEventListener("click", function(){
      if (window.innerWidth <= 900 && !link.classList.contains("nav-drop-toggle")){
        closeMenu();
      }
    });
  });

  document.addEventListener("click", function(e){
    if (!header.contains(e.target)) closeMenu();
  });

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape") closeMenu();
  });

  window.addEventListener("resize", function(){
    if (window.innerWidth > 900) closeMenu();
  });
}

function initFaq(){
  const list = document.querySelector(".faq-list");
  if (!list) return;
  list.addEventListener("click", function(e){
    const btn = e.target.closest(".faq-q");
    if (!btn) return;
    const item = btn.closest(".faq-item");
    if (!item) return;
    const open = item.classList.contains("is-open");
    list.querySelectorAll(".faq-item.is-open").forEach(function(el){
      el.classList.remove("is-open");
      const b = el.querySelector(".faq-q");
      if (b) b.setAttribute("aria-expanded", "false");
    });
    if (!open){
      item.classList.add("is-open");
      btn.setAttribute("aria-expanded", "true");
    }
  });
}

function initPhoneMenu(){
  const wrap = document.querySelector(".nav-phone");
  if (!wrap) return;
  const btn = wrap.querySelector(".nav-phone-btn");
  const menu = wrap.querySelector(".nav-phone-menu");
  if (!btn || !menu) return;

  btn.addEventListener("click", function(e){
    e.preventDefault();
    e.stopPropagation();
    const open = wrap.classList.toggle("is-open");
    btn.setAttribute("aria-expanded", open ? "true" : "false");
  });

  menu.addEventListener("click", function(e){
    e.stopPropagation();
  });

  document.addEventListener("click", function(e){
    if (!wrap.contains(e.target)){
      wrap.classList.remove("is-open");
      btn.setAttribute("aria-expanded", "false");
    }
  });

  document.addEventListener("keydown", function(e){
    if (e.key === "Escape"){
      wrap.classList.remove("is-open");
      btn.setAttribute("aria-expanded", "false");
    }
  });
}
