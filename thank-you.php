<?php
$base = '';
$pageTitle = 'Thank You | MHP Communities';
$pageDescription = 'Thanks for reaching out - we\'ll contact you the same business day.';
$bodyAttrs = 'data-fbevent="lead"';
$sentOk = isset($_GET['sent']) && $_GET['sent'] === '1';
require __DIR__ . '/includes/header.php';
?>
<section class="ty">
  <div>
    <div class="eyebrow" style="margin-bottom:14px"><?php echo $sentOk ? 'Email sent' : 'Message received'; ?></div>
    <h1><?php echo $sentOk ? 'Thank you — your email was sent.' : "Thank you - we're on it."; ?></h1>
    <p><?php if ($sentOk) { ?>
      Your inquiry was emailed to our team successfully. We'll call or text you back the same business day.
    <?php } else { ?>
      Your inquiry just landed with our team. We'll call or text you back the same business day.
    <?php } ?> Want to talk sooner? Call us directly:</p>
    <div class="cta-row">
      <a class="btn btn-gold" href="tel:+12696518149">Sturgis: (269) 651-8149</a>
      <a class="btn btn-navy" href="tel:+12696806022">Plainwell: (269) 680-6022</a>
    </div>
    <p style="margin-top:30px"><a href="./#homes" style="color:var(--sky);font-weight:600">&larr; Keep browsing available homes</a></p>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
