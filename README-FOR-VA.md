# MHP Communities Website — VA Launch Guide

**Goal: live in under 1 hour.** This is a complete, finished website. You are uploading it, connecting tracking, and testing — not building anything.

## What's in this package

| File / folder | What it is | Do you edit it? |
|---|---|---|
| `index.html`, `about.html`, `contact.html`, `thank-you.html` | Main pages | No |
| `communities/*.html` | One page per park | No |
| `sendlead.php` | Form handler — emails leads to Melissa + Aqsa | Only to change recipients |
| `assets/js/homes-data.js` | **THE INVENTORY FILE** — the only file you edit regularly | **Yes** |
| `assets/js/pixel.js` | Meta Pixel + GA4 — paste IDs at the top | **Yes, once** |
| `assets/img/homes/` | Drop home photos here | Yes |
| `docs/triad-credit-application.pdf` | Lender credit app (linked from About page) | No |

## Launch steps (~55 min)

### 1. Back up the old site (10 min)
Log in to the mhpcommunities.com hosting control panel (cPanel or FTP — Chad has credentials). Download or rename the current `public_html` contents to `old-site-backup/`. **Do not delete anything.**

### 2. Upload this package (10 min)
Upload everything in this folder to `public_html` (the web root). The homepage must be reachable at `https://www.mhpcommunities.com/index.html`. If the old `index.php` is still present, remove it from the web root (it's in your backup) so `index.html` loads by default.

### 3. Connect tracking (10 min)
Open `assets/js/pixel.js`. Replace `PASTE_PIXEL_ID_HERE` with the Meta Pixel ID from **Meta Events Manager → Data Sources**. Optionally replace `PASTE_GA4_ID_HERE` with a GA4 measurement ID. Re-upload the file. Verify with the **Meta Pixel Helper** Chrome extension: PageView should fire on every page.

### 4. Test the lead form end-to-end (10 min) — MOST IMPORTANT STEP
Submit the form on the Contact page with test data. Confirm ALL of the following:
- You land on the thank-you page
- Pixel Helper shows a **Lead** event on the thank-you page
- The lead email arrives at **Melissa.Wing@sweetlake.net** AND **aqsa.sadiq0@gmail.com** (check spam folders)

If the email doesn't arrive: the host's PHP `mail()` may be disabled. Fix: in the hosting panel, create the mailbox `leads@mhpcommunities.com` (the From address), or ask hosting support to enable mail(). Do not launch ads until this test passes.

### 5. Mobile + calls check (5 min)
On your phone: every phone number must be tap-to-call, park pages must show their Google Map, and the homepage must look right.

### 6. Home photos (10 min, can be after launch)
Get 5–8 photos per home from Melissa. Name them like `sweetlake-lot20-1.jpg`, upload to `assets/img/homes/`, then list the filename in that home's `photos: []` array in `homes-data.js`. Until then, park photos display automatically.

## Updating inventory (ongoing, 2 min per change)
Open `assets/js/homes-data.js` — instructions are at the top of the file. Sold home → `available: false`. New home → copy a block. Price set → replace `null` with the number and set `comingSoon: false`. Re-upload the one file.

## Facebook ads — non-negotiables
- Every campaign runs as **Special Ad Category: Housing**
- Landing pages: send each ad to its park page (e.g. `/communities/sweet-lake.html`), not the homepage
- Do NOT state specific monthly payment amounts in ads until Chad confirms the financing language is approved
- The rent-comparison stat ($1,337/mo Sturgis 3BR) is sourced from Apartments.com 2026 — keep a screenshot of the source with your ad files

## Rules
- Never remove the Equal Housing Opportunity statement in the footer
- Never add investor/investment content to this site (that lives on mhpinvestors.com only)
- Copy stays neutral: "residents," "neighbors," "you" — no wording that favors any type of buyer
- Questions → Chad on Slack
