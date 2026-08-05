<?php
$base = '';
$pageTitle = 'Our Communities | MHP Communities - Southwest Michigan';
$pageDescription = 'Three well-kept manufactured home communities in Sturgis and Plainwell, Michigan - Sweet Lake, Sturgis Commons, and Pine Crest.';
require __DIR__ . '/includes/header.php';
?>

<section class="hero hero-page hero-video-bg">
  <video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="assets/img/hero.jpg" aria-hidden="true">
    <source src="assets/videos/Pine-Crest.mp4" type="video/mp4">
  </video>
  <div class="hero-inner">
    <div class="eyebrow">Where we operate</div>
    <h1>Three communities. <em>One standard.</em></h1>
    <p class="sub">Maintained grounds, responsive local management, and homes priced fairly - in every community, every time.</p>
  </div>
</section>

<section class="section" id="communities" style="background:#fff;border-top:1px solid var(--rule);border-bottom:1px solid var(--rule)">
  <div class="section-head">
    <div class="eyebrow">Our communities</div>
    <h2>Find your place</h2>
    <p>Choose a community to see available homes, location details, and how to get in touch.</p>
  </div>
  <div class="card-grid">
    <div class="card">
      <div class="card-photo" style="background-image:url('assets/img/sweet-lake.jpg')"></div>
      <div class="card-body">
        <div class="card-location">Sturgis, Michigan</div>
        <h3>Sweet Lake</h3>
        <p class="home-notes">A quiet, wooded community with lake views on the edge of Sturgis - peaceful surroundings with shops, dining, and everyday essentials just minutes away.</p>
        <a class="btn btn-navy btn-sm" href="communities/sweet-lake.php">See This Community</a>
      </div>
    </div>
    <div class="card">
      <div class="card-photo" style="background-image:url('assets/img/sturgis-commons.jpg')"></div>
      <div class="card-body">
        <div class="card-location">Sturgis, Michigan</div>
        <h3>Sturgis Commons</h3>
        <p class="home-notes">A small community in the heart of downtown Sturgis - steps from shops, restaurants, parks, and everything downtown has to offer.</p>
        <a class="btn btn-navy btn-sm" href="communities/sturgis-commons.php">See This Community</a>
      </div>
    </div>
    <div class="card">
      <div class="card-photo" style="background-image:url('assets/img/pine-crest.jpg')"></div>
      <div class="card-body">
        <div class="card-location">Plainwell, Michigan</div>
        <h3>Pine Crest</h3>
        <p class="home-notes">A clean, quiet community in Plainwell - minutes from Kalamazoo with easy highway access to Grand Rapids and beyond.</p>
        <a class="btn btn-navy btn-sm" href="communities/pine-crest.php">See This Community</a>
      </div>
    </div>
  </div>
</section>

<section class="section video-section" id="stories" aria-label="Resident stories">
  <div class="section-head">
    <div class="eyebrow">Hear from residents</div>
    <h2>Stories from our communities</h2>
    <p>Real people sharing what life is like in our parks - in their own words.</p>
  </div>
  <div class="video-grid">
    <article class="video-card">
      <div class="video-frame">
        <video controls preload="metadata" playsinline poster="assets/img/sweet-lake.jpg">
          <source src="assets/videos/marty-testimonial.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="video-body">
        <div class="eyebrow">Resident story</div>
        <h3>Marty</h3>
        <p>Hear Marty talk about living in one of our communities - what stood out, and why he recommends it.</p>
      </div>
    </article>
    <article class="video-card">
      <div class="video-frame">
        <video controls preload="metadata" playsinline poster="assets/img/pine-crest.jpg">
          <source src="assets/videos/michelle-testimonial.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="video-body">
        <div class="eyebrow">Resident story</div>
        <h3>Michelle</h3>
        <p>Michelle shares her experience buying a home and settling into community life with her family.</p>
      </div>
    </article>
  </div>
</section>

<div class="cta-band">
  <h2>Ready to see a home in person?</h2>
  <p>Call, text, or send us a note - no pressure, no scripts, just a straight conversation about what's available.</p>
  <div class="cta-row">
    <a class="btn btn-gold" href="contact.php">Contact Us</a>
    <a class="btn btn-navy" href="tel:+12696518149">Call (269) 651-8149</a>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
