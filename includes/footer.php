<?php
require_once __DIR__ . '/paths.php';
if (!isset($extraScripts)) { $extraScripts = ''; }
?>
<footer>
  <div class="foot-top">
    <div class="foot-brand">
      <a class="logo" href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>"><img src="<?php echo $base; ?>assets/img/logo.png" alt="MHP Communities"><span class="logo-text">MHP Communities</span></a>
      <p class="foot-tagline">Affordable, well-kept manufactured home communities across southwest Michigan. You own the home; the homesite is leased.</p>
    </div>
    <div class="foot-col">
      <h5>Communities</h5>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>communities/sweet-lake">Sweet Lake - Sturgis</a>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>communities/sturgis-commons">Sturgis Commons - Sturgis</a>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>communities/pine-crest">Pine Crest - Plainwell</a>
    </div>
    <div class="foot-col">
      <h5>Call Us</h5>
      <a href="tel:+12696518149">Sweet Lake &amp; Sturgis Commons: (269) 651-8149</a>
      <a href="tel:+12696806022">Pine Crest: (269) 680-6022</a>
    </div>
    <div class="foot-col">
      <h5>Company</h5>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>about">About Us</a>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>contact">Contact</a>
      <a href="<?php echo htmlspecialchars($home, ENT_QUOTES, 'UTF-8'); ?>#homes">Available Homes</a>
    </div>
  </div>
  <div class="eho"><svg width="26" height="26" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-label="Equal Housing Opportunity"><rect width="64" height="64" fill="none"/><path d="M32 6 L60 28 H52 V56 H12 V28 H4 Z" fill="none" stroke="currentColor" stroke-width="3"/><rect x="22" y="34" width="20" height="4" fill="currentColor"/><rect x="22" y="42" width="20" height="4" fill="currentColor"/></svg><span>We are pledged to the letter and spirit of U.S. policy for the achievement of equal housing opportunity throughout the nation. We encourage and support an affirmative advertising and marketing program in which there are no barriers to obtaining housing because of race, color, religion, sex, handicap, familial status, or national origin.</span></div>
  <div class="foot-bottom">
    <span>&copy; 2026 MHP Communities &middot; mhpcommunities.com</span>
    <span>Homes for sale &middot; homesites leased &middot; financing available through third-party lenders</span>
  </div>
</footer>
<script src="<?php echo $base; ?>assets/js/homes-data.js"></script>
<script src="<?php echo $base; ?>assets/js/main.js"></script>
<script>window.PARKS_META = {"sweet-lake": {"name": "Sweet Lake", "city": "Sturgis", "img": "sweet-lake.jpg"}, "sturgis-commons": {"name": "Sturgis Commons", "city": "Sturgis", "img": "sturgis-commons.jpg"}, "pine-crest": {"name": "Pine Crest", "city": "Plainwell", "img": "pine-crest.jpg"}};</script>
<script src="<?php echo $base; ?>assets/js/pixel.js"></script>
<?php echo $extraScripts; ?>
</body>
</html>
