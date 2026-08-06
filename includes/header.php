<?php
if (!isset($base)) { $base = ''; }
if (!isset($pageTitle)) { $pageTitle = 'MHP Communities'; }
if (!isset($pageDescription)) { $pageDescription = 'Affordable manufactured homes for sale in southwest Michigan.'; }
if (!isset($bodyAttrs)) { $bodyAttrs = ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
<link rel="icon" type="image/png" href="<?php echo $base; ?>assets/img/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body<?php echo $bodyAttrs ? ' ' . $bodyAttrs : ''; ?>>

<header>
  <a class="logo" href="<?php echo $base; ?>"><img src="<?php echo $base; ?>assets/img/logo.png" alt="MHP Communities"><span class="logo-text">MHP Communities</span></a>
  <button type="button" class="nav-toggle" aria-label="Open menu" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>
  <div class="header-panel">
  <nav>
    <a href="<?php echo $base; ?>#homes">Home</a>
    <div class="nav-drop">
      <a href="<?php echo $base; ?>communities" class="nav-drop-toggle">Communities</a>
      <div class="nav-drop-menu">
        <a href="<?php echo $base; ?>communities/sweet-lake">Sweet Lake</a>
        <a href="<?php echo $base; ?>communities/sturgis-commons">Sturgis Commons</a>
        <a href="<?php echo $base; ?>communities/pine-crest">Pine Crest</a>
      </div>
    </div>
    <a href="<?php echo $base; ?>about">About</a>
    <a href="<?php echo $base; ?>contact">Contact</a>
  </nav>
  <div class="header-actions">
    <div class="nav-phone">
      <button type="button" class="nav-phone-btn" aria-label="Call us" aria-expanded="false" aria-haspopup="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      </button>
      <div class="nav-phone-menu" role="menu">
        <div class="nav-phone-label">Call Us</div>
        <a href="tel:+12696518149" role="menuitem"><span>Sweet Lake &amp; Sturgis Commons</span><strong>(269) 651-8149</strong></a>
        <a href="tel:+12696806022" role="menuitem"><span>Pine Crest</span><strong>(269) 680-6022</strong></a>
      </div>
    </div>
    <a class="btn btn-gold btn-sm" href="<?php echo $base; ?>#homes">Available Homes</a>
  </div>
  </div>
</header>
