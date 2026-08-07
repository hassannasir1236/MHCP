<?php
$base = '';
$pageTitle = 'Contact Us | MHP Communities - Sturgis & Plainwell, MI';
$pageDescription = 'Call, text, or message MHP Communities about homes for sale in Sturgis and Plainwell, Michigan. We respond the same business day.';
require __DIR__ . '/includes/header.php';
?>
<section class="section" style="padding-top:64px">
  <div class="section-head">
    <div class="eyebrow">Get in touch</div>
    <h2>Talk to a real person</h2>
    <p>Call or text the community you're interested in, or send the form and we'll reach out the same business day.</p>
  </div>
  <div class="two-col">
    <div>
      <div class="card" style="margin-bottom:18px"><div class="card-body">
        <h3>Sweet Lake &amp; Sturgis Commons</h3>
        <p class="home-notes">31004 E US 12, Sturgis, MI 49091<br>960 W Chicago Ave, Sturgis, MI 49091</p>
        <a class="btn btn-gold btn-sm" href="tel:+12696518149">Call (269) 651-8149</a>
      </div></div>
      <div class="card"><div class="card-body">
        <h3>Pine Crest</h3>
        <p class="home-notes">1168 W Bridge St, Plainwell, MI 49080</p>
        <a class="btn btn-gold btn-sm" href="tel:+12696806022">Call (269) 680-6022</a>
      </div></div>
    </div>
    
<div class="form-wrap" id="inquire">
  <h3>Ask About a Home</h3>
  <p class="form-sub">Tell us what you're looking for - we'll call or text you back the same business day.</p>
  <form id="lead-form" name="lead-form" action="sendlead" method="post">
    <div class="field"><label for="lead-name">Name *</label><input id="lead-name" name="name" type="text" required autocomplete="name"></div>
    <div class="field"><label for="lead-phone">Phone *</label><input id="lead-phone" name="phone" type="tel" required placeholder="(555) 555-5555" autocomplete="tel"></div>
    <div class="field"><label for="lead-email">Email</label><input id="lead-email" name="email" type="email" autocomplete="email"></div>
    <div class="field"><label for="lead-community">Which community?</label><select id="lead-community" name="park"><option value="">- Choose a community -</option><option value="Sweet Lake">Sweet Lake - Sturgis, MI</option><option value="Sturgis Commons">Sturgis Commons - Sturgis, MI</option><option value="Pine Crest">Pine Crest - Plainwell, MI</option></select></div>
    <div class="field"><label for="lead-message">What are you looking for?</label><textarea id="lead-message" name="message" rows="4" placeholder="e.g. 2-3 bedrooms, move-in by fall, budget around $20k"></textarea></div>
    <button id="lead-form-submit" class="btn btn-gold" type="submit">Send - We'll Reach Out</button>
    <p class="form-note">No pressure. Just a straight conversation about what is available.</p>
  </form>
</div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
