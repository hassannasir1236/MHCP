// ============================================================
// TRACKING — EDIT THE TWO IDs BELOW, NOTHING ELSE
// ============================================================
const META_PIXEL_ID = "PASTE_PIXEL_ID_HERE";   // from Meta Events Manager
const GA4_ID = "PASTE_GA4_ID_HERE";            // e.g. "G-XXXXXXXXXX" (optional)

// ---- Meta Pixel (do not edit below) ----
if (META_PIXEL_ID && META_PIXEL_ID.indexOf("PASTE") === -1) {
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
  document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', META_PIXEL_ID);
  fbq('track', 'PageView');
  if (document.body && document.body.dataset.fbevent === 'lead') {
    fbq('track', 'Lead');
  }
}
// ---- GA4 ----
if (GA4_ID && GA4_ID.indexOf("PASTE") === -1) {
  var s = document.createElement('script'); s.async = true;
  s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA4_ID;
  document.head.appendChild(s);
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date()); gtag('config', GA4_ID);
}
