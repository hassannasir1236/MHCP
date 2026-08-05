<?php
$base = '';
$pageTitle = 'Affordable Homes for Sale in Southwest Michigan | MHP Communities';
$pageDescription = 'Own your home for less than rent. Manufactured homes for sale in our clean, well-kept communities in Sturgis and Plainwell, Michigan. Financing available.';
require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-video-bg">
  <video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="assets/img/hero.jpg" aria-hidden="true">
    <source src="assets/videos/Home.mp4" type="video/mp4">
  </video>
  <div class="hero-inner">
    <div class="eyebrow">Southwest Michigan &middot; 3 Communities</div>
    <h1>You could own a home. <em>For less than your rent.</em></h1>
    <p class="sub">Homes in Sturgis sell for around $190,000. A 3-bedroom apartment there runs $1,337 a month. Our homes start at $15,000 cash, and the second you're done paying, it's yours.</p>
    <p class="sub hero-punch">No landlord. No lease renewals. No rent increases.</p>
    <p class="sub hero-sub-note">Financing is available too, through established third-party lenders.</p>
    <div class="hero-ctas">
      <a class="btn btn-gold" href="#homes">View Available Homes</a>
      <a class="btn btn-ghost" href="communities.php">See Our Communities</a>
    </div>
  </div>
</section>
<div class="stat-bar">
  <div class="stat-item"><strong>$15,000</strong><span>That's our lowest-priced home.<br>Not a teaser - a move-in ready home in downtown Sturgis.</span></div>
  <div class="stat-item"><strong>$1,337/mo</strong><span>Average 3-bed apartment rent in Sturgis right now.<br>Some of our homes cost less than 12 months of that.</span></div>
  <div class="stat-item"><strong>Lot Rent from $515/month</strong><span>Homesite lease &middot; Utilities separate &middot; Garbage included</span></div>
  <div class="stat-item"><strong>3 communities</strong><span>Sweet Lake &middot; Sturgis Commons &middot; Pine Crest.<br>All-age, pet-friendly, well-kept.</span></div>
</div>
<section class="section" id="homes">
  <div class="section-head">
    <div class="eyebrow">Available now</div>
    <h2>Homes for sale</h2>
    <p>You buy the home. You lease the homesite. It's a straightforward approach designed to keep homeownership affordable.</p>
  </div>
  <div class="card-grid" id="homes-grid"></div>
</section>
<section class="section" id="communities" style="background:#fff;border-top:1px solid var(--rule);border-bottom:1px solid var(--rule)">
  <div class="section-head">
    <div class="eyebrow">Where we operate</div>
    <h2>Three communities. One standard.</h2>
    <p>Maintained grounds, responsive local management, and homes priced fairly - in every community, every time.</p>
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
<section class="section">
  <div class="section-head">
    <div class="eyebrow">Why buy here</div>
    <h2>Better than renting an apartment</h2>
  </div>
  <div class="why-grid">
    <div class="why-item"><div class="why-num">01</div><h4>Keep more of your money</h4>
      <p>Rent builds your landlord's wealth. Here, your money buys a home you own - one you can sell if you ever move, and walk away with something to show for it.</p></div>
    <div class="why-item"><div class="why-num">02</div><h4>No shared walls</h4>
      <p>No hallways, no neighbors overhead, no shared laundry. Your own yard, your own driveway, your own front door - for a similar monthly budget.</p></div>
    <div class="why-item"><div class="why-num">03</div><h4>You don't need $190,000</h4>
      <p>Or $100,000. Or even $50,000. Our homes start at $15,000 cash. If you need financing, we work with three established lenders who specialise in exactly this: Triad Financial, Vanderbilt Mortgage, and PEP Lending.</p></div>
  </div>
</section>
<div class="cta-band">
  <h2>Find the right home in the right community.</h2>
  <p>We're here to answer your questions and help you explore what's available.</p>
  <div class="cta-row">
    <a class="btn btn-navy" href="tel:+12696518149">Call (269) 651-8149</a>
    <a class="btn btn-gold" href="contact.php">Contact Us</a>
  </div>
</div>

<section class="section testimonials" id="reviews" aria-label="Testimonials">
  <div class="section-head">
    <div class="eyebrow">From our residents</div>
    <h2>Testimonials</h2>
    <p>Real feedback from people who live in our communities.</p>
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

<section class="section faq-section" id="faq" aria-label="Frequently asked questions">
  <div class="section-head faq-head">
    <h2>Frequently Asked Questions</h2>
  </div>
  <div class="faq-list">
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>What is the monthly lot rent?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Sturgis parks are $515.00. Pine Crest is $560.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Are utilities included in the lot rent?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, garbage is included.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Are there any move-in specials?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Depending on our ads, we sometimes waive the application fee through the month we are advertising in, and sometimes offer the first month of lot rent free.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Is there a lot deposit or application fee?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>The application fee is $40 per adult over 18 years old. The deposit is equal to one month’s lot rent.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Do you allow pets and are there restrictions?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, we are pet friendly, with conditions and restrictions.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Are there income guidelines?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, income guidelines apply - 3× the lot rent and home payment.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Is this an “All Age Community”?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, we are an All Age Community.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Are there vacant lots available?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, we have several vacant lots to choose from.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Can I bring my own home?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, we are happy to assist with moving your home to our community - conditions apply.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Is there public transportation?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, public transportation is available.</p></div>
    </div>
    <div class="faq-item">
      <button type="button" class="faq-q" aria-expanded="false">
        <span>Are there shopping and restaurants nearby?</span>
        <span class="faq-icon" aria-hidden="true"></span>
      </button>
      <div class="faq-a"><p>Yes, all communities have restaurants, shopping, and industrial areas within walking distance.</p></div>
    </div>
  </div>
</section>

<section class="section">
  <p class="fine">&#42;Average 3-bedroom apartment rent in Sturgis, MI as reported by Apartments.com rent market trends, 2026. Home prices shown are cash prices; monthly lot rent is separate and applies to all homes in our communities. Financing available through third-party lenders. All homes sold as-is unless otherwise noted.</p>
</section>

<?php
$extraScripts = '<script>renderHomes("homes-grid", null, "");</script>';
require __DIR__ . '/includes/footer.php';
