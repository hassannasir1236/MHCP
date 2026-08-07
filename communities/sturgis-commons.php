<?php
$base = '../';
$pageTitle = 'Sturgis Commons - Homes for Sale in Sturgis, MI | MHP Communities';
$pageDescription = 'Manufactured homes for sale at Sturgis Commons in Sturgis, Michigan. A small community in the heart of downtown Sturgis - steps from shops, restaurants, parks, and everything downtown has to offer.';
require __DIR__ . '/../includes/header.php';
?>
<section class="hero park-hero hero-video-bg">
  <video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="../assets/img/sturgis-commons.jpg" aria-hidden="true">
    <source src="../assets/videos/sturgis.mp4" type="video/mp4">
  </video>
  <div class="hero-inner">
    <div class="eyebrow">Sturgis, Michigan</div>
    <h1>Sturgis Commons</h1>
    <p class="sub">A small community in the heart of downtown Sturgis - steps from shops, restaurants, parks, and everything downtown has to offer.</p>
    <p class="park-meta">960 W Chicago Ave, Sturgis, MI 49091 &nbsp;&middot;&nbsp; <a href="tel:+12696518149">(269) 651-8149</a></p>
    <div class="hero-ctas" style="margin-top:22px">
      <a class="btn btn-gold" href="#park-homes">Homes Available Here</a>
      <a class="btn btn-ghost" href="#inquire">Ask a Question</a>
    </div>
  </div>
</section>
<section class="section" id="park-homes">
  <div class="section-head">
    <div class="eyebrow">Available now</div>
    <h2>Homes at Sturgis Commons</h2>
    <p>Buy the home, lease the homesite. Move in and stay right here in the community.</p>
  </div>
  <div class="card-grid" id="homes-grid"></div>
</section>
<section class="section" style="background:#fff;border-top:1px solid var(--rule);border-bottom:1px solid var(--rule)">
  <div class="two-col">
    <div class="prose">
      <div class="eyebrow" style="margin-bottom:10px">About this community</div>
      <p>Sturgis Commons puts you right in the middle of things. This small community sits in downtown Sturgis, with local shops, restaurants, and city parks within walking distance.</p><p>Whether you're running errands, grabbing dinner, or heading to a community event, downtown is at your doorstep. It's affordable living with a genuinely convenient location.</p><p>Like all of our communities, Sturgis Commons is held to one standard: clean grounds, responsive local management, and homes priced fairly.</p>
    </div>
    <div>
      <iframe class="map-embed" loading="lazy" title="Map of Sturgis Commons"
        src="https://www.google.com/maps?q=960+W+Chicago+Ave,+Sturgis,+MI+49091&output=embed"></iframe>
      <p class="fine" style="text-align:left;margin-top:10px">960 W Chicago Ave, Sturgis, MI 49091 &middot; <a href="https://www.google.com/maps?q=960+W+Chicago+Ave,+Sturgis,+MI+49091" target="_blank" rel="noopener" style="color:var(--sky)">Get directions</a></p>
    </div>
  </div>
</section>
<section class="section">
  
<div class="form-wrap" id="inquire">
  <h3>Ask About a Home</h3>
  <p class="form-sub">Tell us what you're looking for - we'll call or text you back the same business day.</p>
  <form id="lead-form" name="lead-form" action="../sendlead" method="post">
    <div class="field"><label for="lead-name">Name *</label><input id="lead-name" name="name" type="text" required autocomplete="name"></div>
    <div class="field"><label for="lead-phone">Phone *</label><input id="lead-phone" name="phone" type="tel" required placeholder="(555) 555-5555" autocomplete="tel"></div>
    <div class="field"><label for="lead-email">Email</label><input id="lead-email" name="email" type="email" autocomplete="email"></div>
    <div class="field"><label for="lead-community">Which community?</label><select id="lead-community" name="park"><option value="">- Choose a community -</option><option value="Sweet Lake">Sweet Lake - Sturgis, MI</option><option value="Sturgis Commons" selected>Sturgis Commons - Sturgis, MI</option><option value="Pine Crest">Pine Crest - Plainwell, MI</option></select></div>
    <div class="field"><label for="lead-message">What are you looking for?</label><textarea id="lead-message" name="message" rows="4" placeholder="e.g. 2-3 bedrooms, move-in by fall, budget around $20k"></textarea></div>
    <button id="lead-form-submit" class="btn btn-gold" type="submit">Send - We'll Reach Out</button>
    <p class="form-note">No pressure, no spam. Just a straight conversation about what's available.</p>
  </form>
</div>
</section>

<section class="section testimonials" id="reviews" data-park="Sturgis Commons" aria-label="Testimonials">
  <div class="section-head">
    <div class="eyebrow">From our residents</div>
    <h2>Testimonials</h2>
    <p>Real feedback from people who live at Sturgis Commons.</p>
  </div>
  <div class="testimonials-wrap">
    <div class="t-slider">
      <div class="t-track" id="t-track"></div>
    </div>
    <div class="t-nav">
      <button type="button" class="t-btn" id="t-prev" aria-label="Previous reviews">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <button type="button" class="t-btn" id="t-next" aria-label="Next reviews">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
    <div class="t-dots" id="t-dots" aria-hidden="true"></div>
    <p class="t-hint">Swipe left or right to see more</p>
  </div>
</section>

<?php
$extraScripts = '<script>renderHomes("homes-grid", "sturgis-commons", "../");</script>';
require __DIR__ . '/../includes/footer.php';
